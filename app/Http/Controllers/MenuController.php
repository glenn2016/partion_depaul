<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    
    public function menue(){

        return view('about');

    }

    public function menue1(){

        return view('Passager');

    }

    
    
}
