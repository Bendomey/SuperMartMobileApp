<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Categories;
use App\Order;
use App\User;
use Notification;
use App\Notifications\MakeOrderMail;

class MobileAppController extends Controller
{
	//homepage data
	public function homepage(){
		$Stores = User::where('feature','1')->get()->toArray();
		$stores = User::where('feature','1')->get();
		$products = [];
		foreach ($stores as $store) {
			foreach ($store->products as $product) {
				if($product->feature == '1'){
					array_push($products,$store->products);
				}else{
					continue;
				}
			}
		}
		$promoteProducts = Product::where('promote','1')->take(5);
		return response()->json(
			array(
				'stores'=>$stores,
				'promoteProducts'=>$promoteProducts
			)
		);
	}

	//get single product
	public function product($id){
		$product = Product::findOrFail($id)->toArray();
		return response()->json($product);
	}

	//all featured stores
	public function all_featured_stores(){
		$stores = User::where('feature','1')->get()->toArray();
		return response()->json($stores);
	}

	//for single store
	public function single_store($id){
		$products = Product::where(['user_id'=>$id,'featured'=>'1'])->take(5);
		$user = User::where('id',$id)->first();
		$categories = $user->categories()->get()->toArray();
		return response()->json(array(
			'products'=>$products,
			'categories'=>$categories
		));
	}

	//show all featured products in a store
	public function featured_single_store($id){
		$products = Product::where(['user_id'=>$id,'featured'=>'1'])->get()->toArray();
		return response()->json($products);
	}

	//promotions
	public function promote_products(){
		$products = Product::where('promote','1')->take(5);
		return response()->json($products);
	}

	//promotions all
	public function promote_products_all(){
		$products = Product::where('promote','1')->get()->toArray();
		return response()->json($products);
	}



    //get categories
	public function categories(){
		$categories = Categories::all()->toArray();
		return response()->json(array('categories'=>$categories));
	}

	//get products
	public function products($name){
		$products = Product::where('category_name',$name)->get();
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

	
    public function search($data){
        // $name = $request->product_name;
        $search = Product::where('product_name','like',"$data%")->get();
        return response()->json($search);
    }
}
