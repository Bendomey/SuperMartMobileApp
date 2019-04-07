<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'category_name',
    	'product_name',
    	'product_price',
    	'product_img',
    	'product_description',
    	'product_expiry_date',
    	'featured',
    	'promote',
    	'recommended'
    ];

    protected $guard = ['id','created_at','updated_at'];
}
