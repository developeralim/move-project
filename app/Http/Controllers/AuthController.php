<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login_view ( ) {
        return \view('pages.login');
    }

    protected function login ( Request $request ) {
        
        $this->validate($request,[
            'email'     => 'required|email|exists:members,email',
            'password'  => 'required'
        ],['email.exists' => 'This email does not exists database']);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('member')->attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return \redirect()->back()->with('fail','Either mail or password wrong');

    } 

    protected function logout ( ) {
        Auth::guard('member')->logout();
        return redirect()->route('home');
    }

    
    public function dashboard(Request $request) {
        return \view('pages.admin.dashboard');
    }
}