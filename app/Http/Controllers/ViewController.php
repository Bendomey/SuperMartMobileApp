<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ViewController extends Controller
{
    public function index()
    {
        $top_product = Product::take(3)->get();
    	return view('index',compact(
            'top_product'
        ));
    }

    public function profile()
    {
    	return view('profile');
    }

    public function add_categories(){
    	return view('add_categories');
    }
}
