<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcceilClient extends Controller
{
    public function home() {
        return view('client.accueil');
    }

    public function map() {
        return view('client.map');
    }
}
