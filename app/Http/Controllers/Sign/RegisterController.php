<?php

namespace App\Http\Controllers\Sign;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {
        return view('pages.sign.register');
    }

    public function verification() {
        return view('pages.sign.verification');
    }
}