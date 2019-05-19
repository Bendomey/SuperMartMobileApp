<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Categories;
use Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('view_products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();
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
        $product = new Product();
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
        $categories = Categories::all();
        $product = Product::whereId($id)->first();
        return view('edit_product',compact(['product','categories']));
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
        return response()->json('success');
    }

    public function unFeature($id){
        $product = Product::findOrFail($id);
        $product->update([
            'featured'=>'0'
        ]);
        return response()->json('success');
    }

    public function promote($id){
        $product = Product::findOrFail($id);
        $product->update([
            'promote'=>'1'
        ]);
        return response()->json('success');
    }

    public function unPromote($id){
        $product = Product::findOrFail($id);
        $product->update([
            'promote'=>'0'
        ]);
        return response()->json('success');
    }

    public function recommended($id){
        $product = Product::findOrFail($id);
        $product->update([
            'recommended'=>'1'
        ]);
        return response()->json('success');
    }

    public function unRecommended($id){
        $product = Product::findOrFail($id);
        $product->update([
            'recommended'=>'0'
        ]);
        return response()->json('success');
    }
}
