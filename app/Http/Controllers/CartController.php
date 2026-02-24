<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use Carbon\Carbon;

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
   public function apply_coupon(Request $request)
   {
      $coupon_code = $request->coupon_code;

      if (isset($coupon_code)) {
         $coupon = Coupon::where('code', $coupon_code)->where('expire_date', '>=', Carbon::today())
            ->where('cart_value', '<=', str_replace(',', '', Cart::instance('cart')->subtotal()))->first();
         
         
            if (!$coupon) {
            return redirect()->back()->with('error_message', 'Невірний код купона або купон не дійсний!');
         } else {
            session()->put('coupon', [
               'code' => $coupon->code,
               'type' => $coupon->type,
               'value' => $coupon->value,
               'cart_value' => $coupon->cart_value
            ]);
            $this->calculateDiscount();
            return redirect()->back()->with('success_message', 'Купон успішно застосований!');
         }
      } else {
         return redirect()->back()->with('error_message', 'Будь ласка, введіть код купона!');
      }
   }
   public  function calculateDiscount()
   {
      $discount = 0;
     if (session()->has('coupon')) {

    // Отримуємо subtotal як число
    $subtotal = Cart::instance('cart')->subtotal(0, '', '');

    // Розрахунок знижки
    if (session()->get('coupon')['type'] === 'fixed') {
        $discount = (float) session()->get('coupon')['value'];
    } else {
        $discount = ($subtotal * session()->get('coupon')['value']) / 100;
    }

    // Після знижки
    $subtotalAfterDiscount = $subtotal - $discount;
    $taxAfterDiscount = ($subtotalAfterDiscount * config('cart.tax')) / 100;
    $totalAfterDiscount = $subtotalAfterDiscount + $taxAfterDiscount;
}

      session()->put('discounts', [
         
         'discount' => number_format(floatval($discount), 2, '.', ''),
         'subtotal' => number_format(floatval($subtotalAfterDiscount), 2, '.', ''),
         'tax' => number_format(floatval($taxAfterDiscount), 2, '.', ''),
         'total' => number_format(floatval($totalAfterDiscount), 2, '.', '')
      ]);
   }

   public function remove_coupon()
   {
      session()->forget('coupon');
      session()->forget('discounts');
      return redirect()->back()->with('success_message', 'Купон успішно видалений!');
   }
}
