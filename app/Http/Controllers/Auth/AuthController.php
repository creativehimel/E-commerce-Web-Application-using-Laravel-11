<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function viewRegister()
    {
        if(Auth::user()){
            return redirect()->route($this->redirectTo());
        }
        return view("auth.register");
    }

    public function register(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'phone' => 'required|min:11',
           'email' => 'required|email|unique:users',
           'password' => 'required|confirmed|min:6', 
        ]);

        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        toastr()->success('User registered successfully');
        return redirect()->route('login');
    }
    public function viewLogin()
    {
        if(Auth::user()){
            return redirect()->route($this->redirectTo());
        }
        return view("auth.login");

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            if(isset($request->remember_me)){
                setcookie('email', $request->email, time() + (86400 * 30));
                setcookie('password', $request->password, time() + (86400 * 30));
            }else{
                setcookie('email', '');
                setcookie('password', '');
            }
            toastr()->success('User logged in successfully');
            return redirect()->route($this->redirectTo());
        }else{
            toastr()->error('Invalid credentials');
            return redirect()->back();
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:6',
            'password' => 'required|min:6|confirmed'
        ]);
        if(Auth::attempt(['email' => Auth::user()->email, 'password' => $request->old_password])) {
            Auth::user()->update(['password' => bcrypt($request->password)]);
            toastr()->success('Password Updated Successfully');
            return redirect()->back();
        }else{
            toastr()->error('Your old password is incorrect');
            return redirect()->back();
        }
    }
     
    public function logout()
    {
        Auth::logout();
        toastr()->success('User logged out successfully');
        return redirect()->route('login');
    }

    public function redirectTo()
    {
        $redirectRoute = '';

        if(Auth::user() && Auth::user()->role == '1') {
            $redirectRoute = 'admin.dashboard';
        }else {
            $redirectRoute = 'home';
        }

        return $redirectRoute;

    }

   
}
