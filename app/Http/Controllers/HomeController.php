<?php

namespace App\Http\Controllers;
use App\Models\Movie;

use Illuminate\Http\Request;

class HomeController extends Controller
{
   

    public function ff(){
        
    }
    public function index()
{
    $movies = Movie::latest()->take(4)->get(); // Limit to 4 movies for home page
    return view('home', compact('movies'));
}

}