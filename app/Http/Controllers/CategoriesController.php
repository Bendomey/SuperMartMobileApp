<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use App\Product;
use Intervention\Image\Facades\Image;

class CategoriesController extends Controller
{
    public function view_categories(){
        $categories = Categories::paginate(10);
        return view('view_categories', compact('categories'));
    }

    public function create(Request $request){
    	$category = new Categories();
    	$category->category_name = $request->category_name;
    	$category->category_img = $this->image($request->category_img);
    	$category->save();
    	return back()->with('success',"$request->category_name uploaded successfully");
    }

    protected function image($image){
        $name = md5(microtime());
        Image::make($image)->save('category_images/' . $name . '.' . $image->getClientOriginalExtension());
        $image_save = 'category_images/' . $name . '.' . $image->getClientOriginalExtension();
        return $image_save;
    }

    public function update(Request $request){
    	$category = Categories::findOrFail($request->id);
    	$category->category_name = $request->category_name;
    	if($request->category_img != null){
    		//delete old image
    		unlink($category->category_img);
    		//save new image
	    	$category->category_img = $this->request->file('category_img');
    	}
        $category->products()->update([
            'category_name' => $request->category_name
        ]);

    	$category->save();
    	//redirect to view page of category
    	return back()->withSuccess("$request->category_name was updated successfully");
    }

    public function destroy($categoryName){
    	$category = Categories::where('id',$categoryName)->first();
    	unlink($category->category_img);
        foreach ($category->products as $a) {
            unlink($a->product_img);
        }
        $category->products()->delete();
    	$category->delete();
    	return back()->withSuccess('Category deleted successfully');
    }
}
