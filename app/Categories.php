<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['category_name', 'category_img','user_id'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function products(){
    	return $this->hasMany(Product::class);
    }
}
