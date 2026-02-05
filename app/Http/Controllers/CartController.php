<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
   public function index()
   {
      $header_title = 'Кошик для покупок';
      $items = Cart::instance('cart')->content();
      return view('cart', compact('items', 'header_title'));  
   }

   public function add_to_cart(Request $request)
   {
  /*     $request->validate([
         'product_id' => 'required|integer',
         'product_name' => 'required|string',
         'product_price' => 'required|numeric',
         'quantity' => 'required|integer|min:1',
      ]); */

      Cart::instance('cart')->add($request->id, $request->name, $request->quantity, $request->price)->associate('App\Models\Product');
         return redirect()->back();

      return redirect()->route('cart.index')->with('success', 'Товар додано до кошика!');
   }
}
