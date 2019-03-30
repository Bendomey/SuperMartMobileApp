<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function updatePersonalInfo(Request $request){
    	$user = User::where('id',$request->id)->first();
    	$user->update([
    		'name' => $request->name,
    		'position' => $request->position,
    		'email' => $request->email,
    		'contact' => $request->contact
    	]);
    	return back()->with('success', 'Update was successful');
    }

    public function updatePassword(Request $request){
    	$user = User::where('id',$request->id)->first();

    	if(Hash::check($request->old_password, $user->password)){
    		if($request->new_password == $request->confirm_password){
    			// update the password here
    			$user->update([
    				'password'=>Hash::make($request->new_password),
    			]);
    			return back()->with('success','Password has successfully been updated');
    		}else{
    			return back()->with('error','Your new password did not match with confirm password');
    		}
    	}else{
    		return back()->with('error','Your old password did not match');
    	}
    }
}
