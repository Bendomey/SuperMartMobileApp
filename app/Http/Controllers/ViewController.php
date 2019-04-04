<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index()
    {
    	return view('index');
    }

    public function profile()
    {
    	return view('profile');
    }

    public function add_categories(){
    	return view('add_categories');
    }
}
