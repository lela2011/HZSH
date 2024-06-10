<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    // displays the login form
    public function login() {
        // if the user is already logged in, redirect them to the create node page
        if (Auth::check()) {
            return redirect()->route('node.index');
        }

        // otherwise, display the login form
        return view('auth.login');
    }

    // authenticates the user
    public function authenticate(Request $request) {
        // validate username and password
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ], [
            'username.required' => 'Please enter a Username',
            'password.required' => 'Please enter a Password'
        ]);

        // attempt to log the user in
        if (Auth::attempt($credentials)) {
            // if successful, regenerate session and redirect to create node page
            $request->session()->regenerate();
            return redirect()->intended(route('node.create'));
        }

        // if unsuccessful, redirect back with an error message
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.'
        ]);
    }

    // logs the user out
    public function logout(Request $request) {
        // log the user out
        Auth::logout();
        // invalidate the session
        $request->session()->invalidate();
        // regenerate the CSRF token
        $request->session()->regenerateToken();
        // redirect to the login page
        return Redirect::route('login');
    }
}
