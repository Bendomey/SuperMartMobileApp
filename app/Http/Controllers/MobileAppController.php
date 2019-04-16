<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Categories;

class MobileAppController extends Controller
{
    //get categories
	public function categories(){
		$categories = Categories::all();
		return response()->json($categories);
	}

	//get products
	public function products(){
		$products = Product::all();
		return response()->json($products);
	}
}
