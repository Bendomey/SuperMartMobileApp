<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_name','latitude','longitude','products','price','location','sell'];

    protected $guard = ['id','created_at','updated_at'];

    public function Customer(){
    	return $this->belongsTo(Customer::class);
    }
}
