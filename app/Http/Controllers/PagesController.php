<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function home() {
        return view ('home');
    }

    public function crud() {
        return view ('crud.home');
    }

}
