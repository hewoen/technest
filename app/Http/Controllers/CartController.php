<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            $cart = session()->get('cart');
            $cart[$request->product_id] = $request->amount;
            session()->put('cart', $cart);
            return response()->json(['message' => 'Das Produkt wurde erfolgreich in den Warenkorb gelegt.'], 200);
        }else{
            return response()->json(['message' => 'Das Produkt ist bereits im Warenkorb.'], 409);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
