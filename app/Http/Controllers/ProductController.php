<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

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

        foreach ($request->file('images') as $image) {
            $productImage = new ProductImage();
            $productImage->product_id = $product->id;
            $productImage->path = "/storage/" . $image->store('uploads', 'public');
            $productImage->save();
        }
        show_notification('success', 'Das Produkt wurde erfolgreich erstellt.');
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('pages.product-details', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        return view('pages.admin.edit-product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditProductRequest $request, Product $product)
    {
        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->description = $request->description;

        $images = $request->file('images');

        $imageOrder = json_decode($request->order);
        $imagesToDelete = json_decode($request->delete);

        if ($imageOrder != null) {
            foreach ($imageOrder as $i => $image) {
                $productImage = ProductImage::find($image->id);
                $productImage->position = $i;
                $productImage->save();
            }
        }

        if($imagesToDelete!=null) {
            foreach($imagesToDelete as $imageId){
                $image = ProductImage::find($imageId);
                $path = public_path($image->path);
                File::delete($path);
                $image->delete();
            }
        }

        if ($images != null && count($images) > 0) {

            foreach ($images as $image) {
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->path = "/storage/" . $image->store('uploads', 'public');
                $productImage->save();
            }
        }
        $product->save();

        show_notification('success', 'Das Produkt wurde erfolgreich aktualisiert.');
        return redirect()->route('products.edit', $product->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            $path = public_path($image->path);
            File::delete($path);
        }
        $product->delete();
        show_notification('success', 'Das Produkt wurde erfolgreich gelöscht.');
        return redirect()->route('dashboard');
    }
}
