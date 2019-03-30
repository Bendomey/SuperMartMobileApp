<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

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

    public function update_profile_img(Request $request){
    	//find the user
    	$user = User::where('id',Auth::user()->id)->first();

    	if($user->profile_img != null){
    		unlink($user->profile_img);
    	}
		$user->update([
			'profile_img' => $this->updateImage($request->profileImage),
		]);
		return back()->with('success', 'Profile image updated successfully');
    }

    protected function updateImage($data){
    	
    	$hashName = md5(microtime());
    	$new_name = 'profile_images/' . $hashName . '.' . $data->getClientOriginalExtension();
    	Image::make($data)->save($new_name);
    	return $new_name;
    }
}
