<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Notification;
use App\Customer;
use Image;
use Illuminate\Support\Facades\Hash;
use App\Notifications\CustomerForgotPassword;
use App\Notifications\CustomerForgotPasswordMail;
use App\Notifications\VerifyCustomerAccount;

class CustomerAuthenticationController extends Controller
{
    public function register(Request $request){
        $user = Customer::where('customer_email',$request->email)->first();
        if($user == null){
            $customer = new Customer();
            $customer->customer_name = $request->name;
            $customer->customer_img = 'customer_images/avatar.jpg';
            $customer->customer_email = $request->email;
            $customer->customer_contact = $request->contact;
            $customer->customer_password = Hash::make($request->password);
            $customer->validation_code = $this->validation_code();
            $customer->save();
            //send verification
            try{
                Notification::route('mail',$customer->customer_email)->notify(new VerifyCustomerAccount($customer->customer_name,$customer->validation_code));
            }catch(Exception $e){
                return response()->json(null);
            }
            return response()->json($customer);
        }else{
            return response()->json(null);
        }
    }

    public function verifyAccount(Request $request){
        $user = Customer::whereId($request->id)->first();
        if($user != null){
            if($request->verification_code == $user->validation_code){
                $user->validation_code = null;
                $user->isVerified = '1';
                $user->save();
                return response()->json($user);
            }else{
                return response()->json(false);
            }        
        }else{
            return response()->json(null);
        }

    }

    public function resendValidationCode(Request $request){
        $customer = Customer::whereId($request->id)->first();
        if($customer){
            $customer->validation_code = $this->validation_code();
            $customer->save();     
            //send code
            try{
                Notification::route('mail',$customer->customer_email)->notify(new VerifyCustomerAccount($customer));
            }catch(Exception $e){
                return response()->json(false);
            }        
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }

    public function login(Request $request){
    	$customer = null;
		if(Customer::where('customer_email',$request->email)->first() != null){
			$userVerified = Customer::where('customer_email',$request->email)->first();
			if(Hash::check($request->password,$userVerified->customer_password)){
				$customer = Customer::where('customer_email',$request->email)->first();
			}else{
				$customer = null;
			}

    	}else{
    		$customer = null;
    	}

    	return response()->json($customer);
	}


    /**
    * @auth Domey Benjamin
    * This is the Password Reset Flow
    * 1.Collect Email Address from user, create a validation code for user
    * and send it to the user through email or contact
    * 2.Check if the the validation code entered by the user is the same as 
    * the one sent to them from the database
    * 3.Collect the id, new password from the user and update the password
    */

    public function forgotPassword(Request $request){
        $user = Customer::where('customer_email',$request->email)->first();
        if($user != null){
            $user->validation_code = $this->validation_code();
            $user->save();
            try{                
            Notification::route('mail',$user->customer_email)->notify(new CustomerForgotPasswordMail($user->validation_code,$user->customer_name));
            // Notification::send($user->customer_contact,new CustomerForgotPassword($user->transaction_code,$user->customer_email));
            }catch(Exception $e){
                return response()->json(null);
            }
            return response()->json($user);
        }else{
            return response()->json(null);
        }
    }

    public function resendVerifyCode(Request $request){
        $customer = Customer::whereId($request->id)->first();
        if($customer){
            $customer->validation_code = $this->validation_code();
            $customer->save();
            try{                
            Notification::route('mail',$user->customer_email)->notify(new CustomerForgotPasswordMail($user->validation_code,$user->customer_name));
            // Notification::send($user->customer_contact,new CustomerForgotPassword($user->transaction_code,$user->customer_email));
            }catch(Exception $e){
                return response()->json(null);
            }
            return response()->json($customer);
        }else{
            return response()->json(null);
        }
    }

    public function validateCode(Request $request){
        $user = Customer::whereId($request->id)->first();
        if($user != null){
            if($user->validation_code == $request->validation_code){
                $user->validation_code = null;
                $user->save();
                return response()->json($user);
            }else{
                return response()->json(false);
            }
        }else{
            return response()->json(null);
        }
    }

    public function resetPassword(Request $request){
        $user = Customer::whereId($request->id)->first();
        if($user){
            $user->customer_password = Hash::make($request->password);
            $user->save();
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }

    private function validation_code(){
        $code = rand(pow(10, 4),pow(10, 5)-1);
        return $code;
    }

    /**
    * @auth Domey Benjamin
    * This is for updating credentials
    * 1.Update the Full Name
    * 2.Update the email
    * 3.Update the contact
    * 4.Update the password
    */

    public function updateProfile(Request $request){
        $customer = Customer::whereId($request->id)->first();
        if($customer){
            $customer->customer_name = $request->name;
            $customer->customer_email = $request->email;
            $customer->customer_contact = $request->contact;
            if($request->customer_img != null){
                $customer->customer_img = $this->image($request->customer_img);
            }
            $customer->save();
            return response()->json($customer);
        }else{
            return response()->json(null);
        }
    }

    public function updatePassword(Request $request){
        $customer = Customer::whereId($request->id)->first();
        if($customer){
            if(Hash::check($request->old_password, $customer->customer_password)){
                $customer->customer_password = Hash::make($request->new_password);
                $customer->save();
            return response()->json(true);
            }else{
                return response()->json(false);
            }
        }else{
            return response()->json(null);
        }
        
    }

    public function image($image){
        $name = md5(microtime());
        Image::make($image)->save('customer_images' . $name . '.' . $image->getClientOriginalExtension());
        $image_save = 'customer_images' . $name . '.' . $image->getClientOriginalExtension()
        return $image_save;
    }

}