<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

//install mpdf and phpmailer to make function work

class PaymentController extends Controller
{
    private string $amount;
    private string $phone;
    private string $price;
    private ?string $coupon = null;
    private string $name;
    private string $email;
    private string $address;
    private string $city;
    private string $state;
    private string $zip;
    private string $store_id = 'movie63a3c8fcb2c61';
    private string $store_password = 'movie63a3c8fcb2c61@ssl';
    private string $success_url;
    private string $cancel_url;
    private string $fail_url;
    private string $api_endpoint = 'https://sandbox.sslcommerz.com/gwprocess/v3/api.php';
    private string $transection_id ;
    private string $currency        = "BDT";
    private string $country         = "Bangladesh";
    private ?string $discount         = null;

    // send email service
    private static string $email_password;
    private static string $admin_email;
    private static string $admin_name;
    private static string $contact;


    public function __construct() {

        $this->success_url  = \route('success');
        $this->cancel_url   = \route('cancel');
        $this->fail_url     = \route('fail');

        self::$admin_email    = '';//admin email;
        self::$contact        = '';//admin contact;
        self::$admin_name     = '';//admin name;
        self::$email_password = '';//google gmail verification code;
    }

    public function create_memeber(Request $request) 
    {

        $validation = Validator::make($request->all(), [

            'first_name'  => 'required|min:3',
            'email'  => 'required|email|unique:members,email',
            'mobile_no'         => 'required|string|max:50',
            'address'           => 'required|string',
            'zip'               => 'required|string',
            'password'     => [
                'required',
                password::min(8)
                ->letters()
                ->symbols()
            ],
            'confirm_password'  => 'required|same:password',
            'package'           => 'required',
            'price'             => 'required'

        ]);

        if ( $validation->fails() ) {
            return \redirect()->back()->withErrors($validation->errors()->all())->withInput();
        }

        // generate transection id for creating member
        $this->transection_id = \md5(\uniqid());

        $create_status = Member::create([
            'user_name'             => $request->first_name . " " . $request->last_name,
            'email'                 => $request->email,
            'password'              => password_hash($request->password,PASSWORD_BCRYPT),
            'payment_id'            => $this->transection_id,
            'payment_gateway'       => '',
            'membership_code'       => '',
            'invoice_code'          => '',
            'package'               => $request->package,
            'price'                 => $request->price,
            'total'                 => '0.0000',
            'coupon'                => $request->coupon,
            'discount'              => $request->discount,
            'address'               => $request->address,
            'city'                  => $request->city,
            'zip'                   => $request->zip,
            'state'                 => $request->state,
            'mobile_no'             => $request->mobile_no,
            'status_paid'           => 'Unpaid',
            'status'                => '1',
            'transection_doc'       => '',
            'user_image'            => '',
        ]);

        if ( ! $create_status )  return \redirect()->back()->with("Something went wrong when processing");
        

        $this->amount = $request->price;
        $this->phone = $request->mobile_no;
        $this->price = $request->price;
        $this->coupon = $request->coupon;
        $this->name = $request->first_name . ' ' . $request->last_name;
        $this->discount = $request->discount;
        $this->email = $request->email;
        $this->address = $request->address;
        $this->city = $request->city;
        $this->state = $request->state;
        $this->zip = $request->zip;
        $this->password = $request->password;

        // get ssl commerze session id;

        $sslcommerzeResponse = $this->GetSSLCommerzeSessionID();
        
        if ( isset($sslcommerzeResponse['status']) && $sslcommerzeResponse['status'] == 'SUCCESS') {
            return \redirect($sslcommerzeResponse['redirectGatewayURL']);
        } else {
            return \redirect()->back()->with("Something went wrong with transection");
        }
    }

    protected function GetSSLCommerzeSessionID( )
    {
        $post_data['store_id']            = $this->store_id;
        $post_data['store_passwd']        = $this->store_password;
        $post_data['success_url']         = $this->success_url;
        $post_data['fail_url']            = $this->fail_url;
        $post_data['cancel_url']          = $this->cancel_url;
        $post_data['total_amount']        = $this->amount;
        $post_data['cus_phone']           = $this->phone;
        $post_data['cus_fax']             = $this->phone;
        $post_data['product_amount']      = $this->price;
        $post_data['discount_amount']     = $this->discount;
        $post_data['cus_name']            = $this->name;
        $post_data['cus_email']           = $this->email;
        $post_data['cus_add1']            = $this->address;
        $post_data['cus_city']            = $this->city;
        $post_data['cus_state']           = $this->state;
        $post_data['cus_postcode']        = $this->zip;
        $post_data['tran_id']             = $this->transection_id;
        $post_data['currency']            = "";
        $post_data['emi_option']          = "1";
        $post_data['emi_max_inst_option'] = "9"; 
        $post_data['emi_selected_inst']   = "9";
        $post_data['cus_country']         = $this->country;
        $post_data['value_a']             = \csrf_token();
        $post_data['value_b']             = $this->email;
        $post_data['value_c']             = $this->password;
        # REQUEST SEND TO SSLCOMMERZ
        $direct_api_url = $this->api_endpoint;

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $direct_api_url );
        curl_setopt($handle, CURLOPT_TIMEOUT, 30);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($handle, CURLOPT_POST, 1 );
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


        $content = curl_exec($handle );

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE); 


        if($code == 200 && !( curl_errno($handle))) {
            curl_close( $handle);
            $sslcommerzResponse = $content;
        
        } else {
            curl_close( $handle);
            return new WP_REST_Response('FAILED TO CONNECT WITH SSLCOMMERZ API',500);
            exit;
        }
        
        $sslcz = json_decode($sslcommerzResponse, true );

        return $sslcz;
    }

    protected function TrackUserLocation( string $token='aeuKUPSJOzxMqLUfYmHi' ) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://timezoneapi.io/api/ip/?token=$token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  
        $result = curl_exec($ch);
  
        if (curl_errno($ch)) {
              echo 'Error:' . curl_error($ch);
        }
  
        curl_close($ch);
  
        return json_decode($result,true);
    }


    protected function OnPaymentSuccess(Request $request)
    {
        if ( isset( $request['status'] ) && $request['status'] == 'VALID' )
        {
            // check if this user is our's by csrf token
            if ( $request['value_a'] == \csrf_token()) {
                return \redirect()->route('home')->with("Your Payment Failed");
            } else {
               
                /**
                 * Separate transection id from $_POST data
                 */
                $this->transection_id = $request->tran_id;

                /**
                 * Generate an invoice code
                 */

                $this->invoice = \substr(\md5(uniqid()),0,8);

                /**
                 * Check if generate membership code generate method exist or not
                 * If exist generate a membership code
                 */
                $this->membershipCode = $this->GenerateMembershipCode(5);

                /**
                 * Serialize transection documents array to store database
                 */
                $transection_doc = \serialize($_REQUEST);

                /**
                 * User location track meaning from where user paying 
                 */
                
                     
                $user_location = $this->TrackUserLocation( ) ?? [
                    'data' => [
                        'timezone' => [
                            'id' => 'Asia/dhaka'
                        ]
                    ]
                ];

                /**
                 * Set timezone base on user location
                 * Transection data and time
                 */
                date_default_timezone_set($user_location['data']['timezone']['id'] ?? 'Asia/dhaka' );

                $date = Carbon::now();

                /**
                 * Serialize user location details to store in database
                 */
                $user_location = serialize($user_location);
                $card_type = $request->card_type;

                /**
                 * Write query base on renew or new payment
                 */
                
                /**
                 * generate auth toke and push it to session
                 */

                $update_status = Member::where('payment_id',$this->transection_id)->update([
                    'payment_gateway'       => $card_type,
                    'status_paid'           => 'Paid',
                    'transection_doc'       => $transection_doc,
                    'user_location_details' => $user_location,
                    'membership_code'       => $this->membershipCode,
                    'created_at'            => $date,
                ]);
                
                if ( $update_status ) {
                    //1.generate invoice
                    // $invoice = $this->GenerateInvoice();
                    //2.send email to use with invoice
                    // $send_mail = $this->sendMail();
                    //3. redirect user to dashboard

                    $credentials = [
                        'email' => $request->value_b,
                        'password' => $request->value_c,
                    ];

                    if (Auth::guard('member')->attempt($credentials)) {
                        return redirect()->route('dashboard');
                    }

                }
            }
        }
    }

    protected function OnPaymentFail()
    {
        //TODO ON PAYMENT FAIL
    }

    protected function OnPaymentCancel()
    {
        //TODO ON PAYMENT CANCEL
    }


    protected static function GenerateMembershipCode($count = 5){
        $char = [1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

        shuffle($char);

        $code = implode(array_slice($char,0,$count));

        return rtrim(chunk_split($code,3,'-'),'-');
    }


    public static function GenerateInvoice($member,$transection){

        $stylesheet = file_get_contents(asset('assets/pdf/pdf.css'));
        $html = file_get_contents(asset('assets/pdf/pdf.html'));
        
        // currency
        $currency = $transection['currency'];
        $amount = $transection['amount'];
        $gateway = $transection['card_type'];
        // provie dinamic value in mail
        $html = \str_replace('{{ invoice }}',$member->invoice_code,$html);
        $html = \str_replace('{{ contact }}',self::$contact,$html);
        $html = \str_replace('{{ transection_id }}',$transection['tran_id'],$html);
        $html = \str_replace('{{ date }}',date('d M Y'),$html);
        $html = \str_replace('{{ customer_email }}',$member->email,$html);
        $html = \str_replace('{{ full_name }}',$member->user_name,$html);
        $html = \str_replace('{{ address }}',$member->address,$html);
        $html = \str_replace('{{ number }}',$member->mobile_no,$html);
        $html = \str_replace('{{ city }}',$member->city,$html);
        $html = \str_replace('{{ state }}',$member->state,$html);
        $html = \str_replace('{{ zipcode }}',$member->zip,$html);
        $html = \str_replace('{{ price }}',$currency .' '. $amount,$html);
        $html = \str_replace('{{ discount }}',$currency .' 0',$html);
        $html = \str_replace('{{ amount_due }}',$currency . ' 0',$html);
        $html = \str_replace('{{ grand_total }}',$currency . ' ' . $amount ,$html);
        $html = \str_replace('{{ payment_gateway }}',\substr($gateway,\strpos($gateway,'-') + 1),$html);
        $html = \str_replace('{{ site }}','Movie',$html);
        $html = \str_replace('{{ login_page }}','#',$html);

        $mpdf = new PDF();

        $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
        
        //call watermark content aand image
        $mpdf->showWatermarkText = true;
        $mpdf->watermarkTextAlpha = 0.1;
        
        //save the file put which location you need folder/filname

        if(! is_dir(ABSPATH.'/wp-content/uploads/invoices') ) {
              mkdir(ABSPATH.'/wp-content/uploads/invoices');
        }

        $mpdf->Output(ABSPATH."/wp-content/uploads/invoices/invoice-{$member->invoice_code}.pdf", 'F');

    }


    public static function sendMail($toSend,$file_name,$member,$transection) {
                        
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions
        // Email server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';             //  smtp host
        $mail->SMTPAuth = true;
        $mail->Username = self::$admin_email;   //  sender username
        $mail->Password = self::$email_password;     // sender password
        $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
        $mail->Port = 587;                          // port - 587/465

        $mail->setFrom(self::$admin_email, 'Md Alim Khan');
        $mail->addAddress($toSend);

        $mail->addReplyTo(self::$admin_email, 'Alim');
        $mail->isHTML(true);  
        $mail->SMPTOptions = [
            'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => false
              ]
        ];              // Set email content format to HTML
        $mail->Subject = 'Your Membership Invoice';
        $html = file_get_contents(dirname(__DIR__).'/assets/html/mail.html');
        
        // currency
        $currency = $transection['currency'];
        $amount = $transection['amount'];
        $gateway = $transection['card_type'];

        // provie dinamic value in mail
        $html = \str_replace('{{ membership_code }}',$member->membership_code,$html);
        $html = \str_replace('{{ invoice }}',$member->invoice_code,$html);
        $html = \str_replace('{{ contact }}','+8801870048832',$html);
        $html = \str_replace('{{ transection_id }}',$transection['tran_id'],$html);
        $html = \str_replace('{{ date }}',date('d M Y'),$html);
        $html = \str_replace('{{ customer_email }}',$member->email,$html);
        $html = \str_replace('{{ full_name }}',$member->user_name,$html);
        $html = \str_replace('{{ address }}',$member->address,$html);
        $html = \str_replace('{{ number }}',$member->mobile_no,$html);
        $html = \str_replace('{{ city }}',$member->city,$html);
        $html = \str_replace('{{ state }}',$member->state,$html);
        $html = \str_replace('{{ zipcode }}',$member->zip,$html);
        $html = \str_replace('{{ price }}',$currency .' '. $amount,$html);
        $html = \str_replace('{{ discount }}',$currency .' 0',$html);
        $html = \str_replace('{{ amount_due }}',$currency . ' 0',$html);
        $html = \str_replace('{{ grand_total }}',$currency . ' ' . $amount ,$html);
        $html = \str_replace('{{ payment_gateway }}',\substr($gateway,\strpos($gateway,'-') + 1),$html);
        $html = \str_replace('{{ home_page }}','#',$html);
        $html = \str_replace('{{ site }}','Movie',$html);
        $html = \str_replace('{{ privecy_policy }}','#',$html);
        $html = \str_replace('{{ terms_condition }}','#',$html);
        $html = \str_replace('{{ year }}',\date('Y'),$html);
        $html = \str_replace('{{ login_page }}','#',$html);

        $mail->Body    = "$html";
        
        if( file_exists(dirname(__DIR__)."/storage/invoice-$file_name.pdf")){
            $mail->addAttachment(dirname(__DIR__)."/storage/invoice-$file_name.pdf");
        } 

        return $mail->send();

    }


}