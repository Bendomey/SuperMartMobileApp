<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\Categories;
use App\Customer;

class ViewController extends Controller
{
    public function index()
    {
        $top_product = Product::take(3)->get();
        $new_orders = Order::where('sell',0)->count();
        $customers = Customer::count();
        $product_count = Product::count();
        $category_count = Categories::count();
        $orders = Order::take(3)->get();
    	return view('index',compact(['top_product','new_orders','customers','product_count','category_count','orders']));
    }

    public function profile()
    {
    	return view('profile');
    }

    public function add_categories(){
    	return view('add_categories');
    }
}
