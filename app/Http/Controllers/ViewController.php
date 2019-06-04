<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\Categories;
use App\Customer;
use App\User;


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

    public function view_stores(){
        $stores = User::where('isAuth','0')->paginate(10);
        return view('view_stores',compact('stores'));
    }

    public function remove_store($id){
        $stores = User::findOrFail($id);
        // var_dump($stores)
        //deleting products
        foreach ($stores->categories as $category) {
            foreach($category->products as $a){
                unlink($a->product_img);            
            }
        }
        // $stores->categories->products()->delete();
        foreach($stores->categories as $category){
            $category->products()->delete();
        }
        //deleting categories
        foreach ($stores->categories as $a) {
            unlink($a->category_img);
        }
        $stores->categories()->delete();

        //deleting the store
        if($stores->profile_img != null){
            unlink($stores->profile_img);
        }
        $storeName = $stores->name;
        $stores->delete();
        return back()->withSuccess("$storeName was deleted successfully");
    }
}
