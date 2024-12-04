<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductManagementController extends Controller
{

    /**
     * Edit product page
     */
    public function editProductPage()
    {
        return view('pages.admin.edit-product');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.create-product');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();
        
        foreach($request->file('images') as $image){
            $productImage = new ProductImage(); 
            $productImage->product_id = $product->id;
            $productImage->path = "/storage/" . $image->store('uploads', 'public');
            $productImage->save();
        }

        return redirect()->route('dashboard','created=1');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        foreach($product->images as $image){
            $path = public_path($image->path);
            File::delete($path);
        }
        $product->delete();
        return redirect()->route('dashboard','deleted=1');
    }
}
