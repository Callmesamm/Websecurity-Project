<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $movies = DB::table("");
        return view('home');
    }

    public function ff(){
        
    }
}