<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function home() {
        return view ('home');
    }

    public function signUp() {
        return view ('signup');
    }

    public function resultadosHoteles() {
        return view ('resultadosHoteles');
    }

    public function hotel() {
        return view ('hotel');
    }

}
