<?php

namespace App\Http\Controllers;

use App\Models\Article;

class MainController extends Controller
{

    public function index()
    {

        return "Frontend";
//        return view('index2',compact('articles'));
    }
}
