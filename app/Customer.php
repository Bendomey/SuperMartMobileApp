<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
    	'customer_name',
        'customer_img',
    	'customer_email',
    	'customer_contact',
    	'customer_password',
    	'isVerified'
    ];

    protected $guard = ['created_at','updated_at'];

    public function Order(){
    	return $this->hasMany(Order::class);
    }
}
