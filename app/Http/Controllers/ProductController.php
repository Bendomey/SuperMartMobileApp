<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Categories;
use Storage;

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
        //saving the image
        $hashName = md5(microtime());
        $imageName = 'product_images/' . $hashName . '.' . ($request->file('product_img'))->getClientOriginalExtension();
        $product->product_img = $imageName;
        $product->product_description = $request->product_description;
        $product->product_expiry_date = $request->product_expiry_date;
        Storage::putFileAs(
            'public/product_images',
            $request->file('product_img'),
            $hashName . '.' . ($request->file('product_img'))->getClientOriginalExtension()
        );
        
        $product->save();
        return back()->withSuccess("$request->product_name has been uploaded successfully");
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
        $product = Product::whereId($request->id)->first();
        $product->category_name = $request->category_name;
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        //saving the image
        if($request->product_img != null){
            //delete old image
            unlink("storage/$product->product_img");
            Storage::delete("public/$product->product_img");
            //save new image
            $hashName = md5(microtime());
            $imageName = 'product_images/' . $hashName . '.' . ($request->file('product_img'))->getClientOriginalExtension();
            $product->product_img = $imageName;
            $product->product_description = $request->product_description;
            $product->product_expiry_date = $request->product_expiry_date;
            Storage::putFileAs(
                'public/product_images',
                $request->file('product_img'),
                $hashName . '.' . ($request->file('product_img'))-> getClientOriginalExtension()
            );
        }
        $product->save();   
        return redirect()->route('product.index')->withSuccess("$request->product_img has been updated successfully");
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
        unlink("storage/$product->product_img");
        Storage::delete("public/$product->product_name");
        $product->delete();
        return back()->withSuccess('Product has been deleted succesfully');
    }
}
