<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\ProductTrait;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    use ProductTrait;

    public function index()
    {
        $cart = [];
        foreach(session()->get('cart', []) as $product_id => $amount){
            $cart[] = [
                "product" => Product::find($product_id),
                "amount" => $amount
            ];
        }

        return view('pages.cart',compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //If the product isn't in the cart for this user, store the product and the amount in the cart session and send HTTP-Response 200
        //Otherwise send HTTP-Response 409 and a message that the product is already in the cart as JSON in field "message";
        if(!session()->has('cart')){
            session()->put('cart', []);
        }
        if(!isset(session()->get('cart')[$request->product_id])){
            
            $product = Product::find($request->product_id);

            if($request->amount > $this->getAvailableStockOfProduct($product)){
                return response()->json(['message' => __('Das Produkt ist nicht in der gewünschten Menge verfügbar.')], 409);
            }
            $cart = session()->get('cart');
            $cart[$request->product_id] = $request->amount;
            session()->put('cart', $cart);
            return response()->json(['message' => __('Das Produkt wurde erfolgreich in den Warenkorb gelegt.')], 200);
        }else{
            return response()->json(['message' => __('Das Produkt ist bereits im Warenkorb.')], 409);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $product_id)
    {
        
        //If the product is in the cart for this user, update the amount in the cart session and send HTTP-Response 200
        if(isset(session()->get('cart')[$product_id]) && $request->amount > 0){
            $product = Product::find($product_id);
            if($request->amount > $this->getAvailableStockOfProduct($product)){
                show_notification('error', __('Das Produkt ist nicht in der gewünschten Menge verfügbar.'));
                return redirect()->back();
            }
            $cart = session()->get('cart');
            $cart[$product_id] = $request->amount;
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //If the product is in the cart for this user, remove the product from the cart session and send HTTP-Response 200
        //Otherwise send HTTP-Response 404 and a message that the product is not in the cart as JSON in field "message";
        if(isset(session()->get('cart')[$id])){
            $cart = session()->get('cart');
            unset($cart[$id]);
            session()->put('cart', $cart);
            show_notification('success', __('Das Produkt wurde erfolgreich aus dem Warenkorb entfernt.'));
        }

        return redirect()->route('cart.index');

    }
}
