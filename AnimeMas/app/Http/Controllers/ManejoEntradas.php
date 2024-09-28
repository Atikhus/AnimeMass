<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManejoEntradas extends Controller
{
    //
    public function showLoginForm(){
        return view('login');
    }

    public function showSignForm(){
        return view('sign');
    }
}
