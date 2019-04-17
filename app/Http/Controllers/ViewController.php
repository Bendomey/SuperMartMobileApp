<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\Categories;

class ViewController extends Controller
{
    public function index()
    {
        $top_product = Product::take(3)->get();
        $new_orders = Order::where('sell',0)->count();
        $accepted_orders = Order::where('sell',1)->count();
        $product_count = Product::count();
        $category_count = Categories::count();
        $orders = Order::take(3)->get();
    	return view('index',compact(['top_product','new_orders','accepted_orders','product_count','category_count','orders']));
    }

    public function profile()
    {
    	return view('profile');
    }

    public function add_categories(){
    	return view('add_categories');
    }
}
