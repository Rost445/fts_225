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
   }

   public function increase_cart_quantity($rowId)
   {
     $product = Cart::instance('cart')->get($rowId);  
     $qty = $product->qty + 1;
     Cart::instance('cart')->update($rowId, $qty);
     return redirect()->back();
   }

   public function decrease_cart_quantity($rowId)
   {
     $product = Cart::instance('cart')->get($rowId);  
     $qty = $product->qty - 1;
     Cart::instance('cart')->update($rowId, $qty);
     return redirect()->back();
   }

   public function remove_item($rowId)
   {
      Cart::instance('cart')->remove($rowId);
      return redirect()->back();
   }

   public function empty_cart()
   {
      Cart::instance('cart')->destroy();
      return redirect()->back();
   }
}
