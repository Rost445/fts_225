<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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

   public function checkout()
   {

      if (!Auth::check()) {
         return redirect()->route('login')->with('error_message', 'Будь ласка, увійдіть, щоб оформити замовлення!');
      }
      $header_title = 'Оформлення замовлення';
      $address = Address::where('user_id', Auth::user()->id)->where('isdefault', 1)->first();
      $items = Cart::instance('cart')->content();
      return view('checkout', compact('items', 'header_title', 'address'));
   }
   public function place_an_order(Request $request)
   {
      $user_id = Auth::user()->id;
      $address = Address::where('user_id', $user_id)->where('isdefault', true)->first();
      if (!$address) {
         $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'address' => 'string|max:255',
            'zip' => 'string|max:10',
            'locality' => 'string|max:100',
            'landmark' => 'nullable|string|max:255',
         ]);

         $address = new Address();
         $address->user_id = $user_id;
         $address->name = $request->name;
         $address->phone = $request->phone;
         $address->city = $request->city;
         $address->address = $request->address;
         $address->zip = $request->zip;
         $address->locality = $request->locality;
         $address->landmark = $request->landmark;
         $address->isdefault = true;
         $address->country = 'Україна';
         $address->save();
      }

      $this->setAmountForCheckout();

      $order = new Order();
      $order->user_id = $user_id;
      $order->subtotal = session()->get('checkout')['subtotal'];
      $order->discount = session()->get('checkout')['discount'];
      $order->tax = session()->get('checkout')['tax'];
      $order->total = session()->get('checkout')['total'];
      $order->name = $address->name;
      $order->phone = $address->phone;
      $order->locality = $address->locality;
      $order->address = $address->address;
      $order->city = $address->city;
      $order->country = $address->country;
      $order->state = $address->state;
      $order->landmark = $address->landmark;
      $order->zip = $address->zip;
      $order->save();

      foreach (Cart::instance('cart')->content() as $item) {

         $orderItem = new OrderItem();
         $orderItem->order_id = $order->id;
         $orderItem->product_id = $item->id;
         $orderItem->quantity = $item->qty;
         $orderItem->price = $item->price;
         $orderItem->save();
      }
      if ($request->mode == 'card') {
      } elseif ($request->mode == 'cod') {
      } elseif ($request->mode == 'paypal') {
      }

      $order->save();

      $transaction = new Transaction();
      $transaction->order_id = $order->id;
      $transaction->user_id = $user_id;
      $transaction->mode = $request->mode;
      $transaction->status = 'pending';
      $transaction->save();

      Cart::instance('cart')->destroy();
      session()->forget('coupon');
      session()->forget('discounts');
      session()->forget('checkout');   
      session()->put('order_id', $order->id);
      session()->flash('success_message', 'Ваше замовлення успішно оформлено!');
      return redirect()->route('cart.order.confirmation');
   }
   public function setAmountForCheckout()
   {
      if (!Cart::instance('cart')->content()->count() > 0) {
         session()->forget('checkout');
         return;
      }
      if (session()->has('coupon')) {
         session()->put('checkout', [
            'discount' => session()->get('discounts')['discount'],
            'subtotal' => session()->get('discounts')['subtotal'],
            'tax' => session()->get('discounts')['tax'],
            'total' => session()->get('discounts')['total']
         ]);
      } else {
         session()->put('checkout', [
            'discount' => 0,
            'subtotal' => Cart::instance('cart')->subtotal(2, '.', ''),
            'tax'      => Cart::instance('cart')->tax(2, '.', ''),
            'total'    => Cart::instance('cart')->total(2, '.', ''),
         ]);
      }
   }
   public function order_confirmation()
   {
      if(session()->has('order_id')){
         $order = Order::find(session()->get('order_id'));
         return view('order-confirmation', compact('order'));
      }
      $header_title = 'Успішне замовлення';
      return view('order-confirmation', compact('header_title'));
   }
}
