<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerAuthenticationController extends Controller
{
    public function register(Request $request){
    	Customer::create([
    		'customer_name' => $request->name,
    		'customer_email'=> $request->email,
    		'customer_contact' => $request->contact,
    		'customer_password' => Hash::make($request->password),
    	]);

    	return response()->json('success');
    }

    public function login(Request $request){
    	$customer = null;
		if(Customer::where('customer_email',$request->email)->first() != null){
			$userVerified = Customer::where('customer_email',$request->email)->first();
			if(Hash::check($request->password,$userVerified->customer_password)){
				$customer = Customer::where('customer_email',$request->email)->get();
			}else{
				$customer = null;
			}

    	}else{
    		$customer = null;
    	}

    	return response()->json($customer);
	}
}
