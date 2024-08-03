<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function about_us(){
        return view('frontend.about-us');
    }

    public function blog(){
        return view('frontend.about-us');
    }

    public function contact(){
        return view('frontend.contact-us');
    }
}
