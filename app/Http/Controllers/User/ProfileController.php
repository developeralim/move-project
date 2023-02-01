<?php

namespace App\Http\Controllers\User;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function data_update(Request  $request){
        $request->validate([
            'user_name'=>'required',
            'email'=>'required|email',
            'mobile_no'=>'required',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zip'=>'required',
        ]);
        $user = Member::find(Auth::id());
        $data = $request->all();
        $user->fill($data)->save();
        return redirect()->back()->with('success','Profile updated successfully');
    }
    public function password_update(Request  $request){
        $request->validate([
            'old_password'=>'required',
            'new_password'=>'required|min:6|max:12|confirmed',
        ]);
        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }

         #Update the new Password
         Member::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return redirect()->back()->with('success','Profile password updated successfully');
    }

}