<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){

    return view('backend.auth.login');

    }
    public function register(){

        return view('backend.auth.register');


    }
    public function registerpost(Request  $request){
        $request->validate([
          'name' => 'required',
          'email'=>'required|email|unique:admins,email',
          'password' => 'required',
        ]);
        Admin::insert([
         'name' => $request->name,
         'email' => $request->email,
         'password' => Hash::make($request->password),
        ]);
        return redirect()->route('admin.login')->with('success', 'Registration Completed');

    }

        public function loginpost(Request $request)
        {
           $this->validate($request,[
            'email' => 'required|email|exists:admins,email',
            'password' => 'required',
        ], [
            'email.exists' => 'This email does not exists database',
            ]);
           if (Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->get('remember'))) {
              return redirect()->route('admin.dashboard');
           }else{
            session()->flash('error','Either email/passeord incorrect');
            return back()->withInput($request->only('email'));
           }
        }

        public function logout(){
            Auth::guard('admin')->logout();
            return redirect()->route('home');
        }
}