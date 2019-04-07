<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use Storage;

class CategoriesController extends Controller
{
    public function view_categories(){
        $categories = Categories::paginate(10);
        return view('view_categories', compact('categories'));
    }

    public function create(Request $request){
    	$category = new Categories();
    	$category->category_name = $request->category_name;
    	$hashName = md5(microtime());
    	$image_name = 'category_images/' . $hashName . '.' . ($request->file('category_img'))->getClientOriginalExtension();
    	$category->category_img = $image_name;
    	Storage::putFileAs(
    		'public/category_images', 
    		$request->file('category_img'),
    		$hashName . '.' . ($request->file('category_img'))->getClientOriginalExtension()
    	);
    	$category->save();
    	return back()->with('success',"$request->category_name uploaded successfully");
    }

    public function update(Request $request){
    	$category = Categories::findOrFail($request->id);
    	$category->category_name = $request->category_name;
    	if($request->category_img != null){
    		//delete old image
    		unlink("storage/$category->category_img");
    		Storage::delete("public/$category->$category_img");
    		//save new image
    		$hashName = md5(microtime());
    		$image_name = 'category_images/' . $hashName . '.' . ($request->file('category_img'))->getClientOriginalExtension();
	    	$category->category_img;
	    	Storage::putFileAs(
	    		'public/category_images', 
	    		$request->file('category_img'),
	    		$hashName . '.' . ($request->file('category_img'))->getClientOriginalExtension()
	    	);	
    	}

    	$category->save();
    	//redirect to view page of category
    	return back()->withSuccess("$request->category_name was updated successfully");
    }

    public function destroy($categoryName){
    	$category = Categories::where('category_name',$categoryName)->first();
    	unlink("storage/$category->category_img");
    	Storage::delete("public/$category->category_img");
    	$category->delete();
    	return back()->withSuccess('Category deleted successfully');
    }
}
