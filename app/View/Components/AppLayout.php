<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $cart = Session::get('cart', null);
        $amount = $cart!=null ? count($cart) : 0;
        return view('layouts.app', compact('amount'));
    }
}
