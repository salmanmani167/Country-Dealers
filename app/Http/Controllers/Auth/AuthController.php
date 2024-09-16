<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{

    public function login(){
        $title = 'login';
        return view('auth.login',compact(
            'title'
        ));
    }
    public function postLogin(Request $request){
       $request->validate([
            'email' => 'required|string',
            'password' => 'required'
       ]);
       $credentials = $request->only('email', 'password');
       if (filter_var($credentials['email'], FILTER_VALIDATE_EMAIL) === false) {
            $credentials['username'] = $credentials['email'];
            unset($credentials['email']);
        }
       $user = User::where('email', $request->email)
                ->orWhere('username', $request->email)
                ->first();

        if ($user && ($user->active == 1) && auth()->attempt($credentials)) {
            return redirect()->route('dashboard');
        }
        $notification = notify('Invalid login credentials','danger');
        return back()->withErrors(['email' => 'These credentials do not match our records.'])->with($notification);

    }

    public function register(){
        $title = 'register';
        return view('auth.register',compact(
            'title'
        ));
    }

    public function store(Request $request){
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'email' => 'required|string|email',
            'password' => 'required|min:6|max:255|confirmed'
        ]);
        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'is_client' => true,
            'is_employee' => false,
            'active' => true,
            'password' => Hash::make('password'),
        ]);
        return redirect()->route('dashboard');
    }

    public function forgotPassword(){
        $title = 'forgot password';
        return view('auth.forgot-password',compact(
            'title'
        ));
    }

    public function reset(Request $request){
        $this->validate($request,[
            'email'=>'required|email',
        ]);
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }
}
