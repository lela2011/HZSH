<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    // displays the login form
    public function login() {
        return view('auth.login');
    }

    // authenticates the user
    public function authenticate(Request $request) {

    }

    // logs the user out
    public function logout() {

    }
}
