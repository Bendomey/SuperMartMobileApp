<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Customer;

class OrderController extends Controller
{
	public function acceptOrder($id){
		$order = Order::whereId($id)->first();
		$order->sell = '1';
		$order->save();
		return back()->withSuccess('You have successfully accepted this order');
	}

	public function rejectOrder($id){
		$order = Order::whereId($id)->first();
		$order->delete();
		return back()->withSuccess('You have successfully rejected this order');
	}

	public function viewOrder(){
		$orders = Order::where('sell','0')->paginate(10);
		return view('view_order',compact('orders'));
	}
}
