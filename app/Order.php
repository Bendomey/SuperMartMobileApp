<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_name','latitude','longitude','product'];

    protected $guard = ['id','created_at','updated_at'];
}
