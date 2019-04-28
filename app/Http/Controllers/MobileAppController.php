<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Categories;
use App\Order;
use Notification;
use App\Notifications\MakeOrderMail;

class MobileAppController extends Controller
{
    //get categories
	public function categories(){
		$categories = Categories::all()->toArray();
		return response()->json(array('categories'=>$categories));
	}

	//get products
	public function products(){
		$products = Product::all();
		return response()->json($products);
	}

	//make orders
	public function makeOrder(Request $request){
		$user = Customer::whereId($request->id)->first();
		$order = new Order();
		$order->customer_name = $user->customer_name;
		$order->latitude = $request->latitude;
		$order->longitude = $request->longitude;
		$order->products = serialize($request->products);
		$order->price =  $request->price;
		$order->location = $request->location;
		$order->save();
		//send mail to owner
		Notification::route('mail','domeybenjamin1@gmail.com')->notify(new MakeOrderMail($order));
		return response()->json(true);
	}


}
