<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lunar\Exceptions\Carts\CartException;
use Lunar\Facades\CartSession;
use Lunar\Models\Product;
use Lunar\Models\ProductVariant;

class CartController extends Controller
{
    public function index()
    {

    }

    public function add(Request $request, ProductVariant $variant)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1|max:10000',
        ]);

        $quantity = 2;

        if ($variant->stock < $quantity) {
            return back()->withErrors(['quantity' => 'The quantity exceeds the available stock.']);
        }

        CartSession::manager()->add($variant, $quantity);

        return back()->with('success', 'Added to cart!');
    }
}
