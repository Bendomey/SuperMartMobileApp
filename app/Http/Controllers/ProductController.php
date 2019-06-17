<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Categories;
use Intervention\Image\Facades\Image;
use App\User;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        $categories = $user->categories()->get();
        foreach($categories as $category){
            $products = Product::where('categories_id',$category->id)->paginate(10);
        }
        return view('view_products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::findOrFail(Auth::user()->id);
        $categories = $user->categories()->get();
        return view('add_product', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cat = Categories::where('category_name',$request->category_name)->first();
        $product = new Product();
        $product->user_id = Auth::user()->id;
        $product->categories_id = $cat->id;
        $product->category_name = $request->category_name;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_img = $this->image($request->file('product_img'));
        $product->product_description = $request->product_description;
        $product->product_expiry_date = $request->product_expiry_date;
        $product->save();
        return back()->withSuccess("$request->product_name has been uploaded successfully");
    }

    protected function image($image){
        $name = md5(microtime());
        Image::make($image)->save('product_images/'. $name .'.'.$image->getClientOriginalExtension());
        $image_save = 'product_images/'. $name .'.'.$image->getClientOriginalExtension();
        return $image_save;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where(['user_id'=>Auth::user()->id,'id'=>$id])->first();
        if($product){
            $categories = Categories::where('user_id',Auth::user()->id)->get();
            return view('edit_product',compact(['product','categories']));
        }else{
            $product = null;
            return view('edit_product',compact('product'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->category_name = $request->category_name;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_description = $request->product_description;
        //saving the image
        if($request->product_img != null){
            //delete old image
            unlink($product->product_img);
            $product->product_img = $this->image($request->file('product_img'));
        }
        $product->product_description = $request->product_description;
        $product->product_expiry_date = $request->product_expiry_date;
        $product->save();   
        return redirect()->route('product.index')->withSuccess("$product->product_name has been updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::whereId($id)->first();
        unlink($product->product_img);
        $product->delete();
        return back()->withSuccess('Product has been deleted succesfully');
    }

    public function feature($id){
        $product = Product::findOrFail($id);
        $product->update([
            'featured'=>'1'
        ]);
        return back();
    }

    public function unFeature($id){
        $product = Product::findOrFail($id);
        $product->update([
            'featured'=>'0'
        ]);
        return back();
    }

    public function promote($id){
        $product = Product::findOrFail($id);
        $product->update([
            'promote'=>'1'
        ]);
        return back();
    }

    public function unPromote($id){
        $product = Product::findOrFail($id);
        $product->update([
            'promote'=>'0'
        ]);
        return back();
    }

    public function recommended($id){
        $product = Product::findOrFail($id);
        $product->update([
            'recommended'=>'1'
        ]);
        return back();
    }

    public function unRecommended($id){
        $product = Product::findOrFail($id);
        $product->update([
            'recommended'=>'0'
        ]);
        return back();
    }
}
