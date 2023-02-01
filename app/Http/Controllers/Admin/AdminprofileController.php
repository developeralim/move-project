<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminprofileController extends Controller
{
    public function profile(){
        return view('backend.pages.profile.index');
   }
    public function password(){
        return view('backend.pages.profile.password');
   }
   public function  image_update(Request $request){
        $request->validate([
            'image' => 'required|image'
        ]);
        $admin_image = Admin::find(Auth::id());
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(150,150)->save('backend/assets/user/' . $name_gen);
            $image = 'backend/assets/user/' . $name_gen;
            if ($admin_image->image != null) {
                unlink($admin_image->image);
            }
        }

        $admin_image->update([
           'image'=>$image,
           'updated_at'=>Carbon::now()
        ]);
        return back()->with('success', 'Profile updated successfully');
   }
   public function  details_update(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $admin = Admin::find(Auth::id());
        $data = $request->all();
        $admin->fill($data)->save();
        return back()->with('success_details', 'Profile details updated successfully');
   }
   public function  profile_password_update(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|max:12|confirmed',
        ]);
            #Match The Old Password
            if(!Hash::check($request->old_password, auth()->user()->password)){
                return back()->with("error_password", "Old Password Doesn't match!");
            }

             #Update the new Password
             Admin::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
        return back()->with('success_password', 'Profile password updated successfully');
   }
}
