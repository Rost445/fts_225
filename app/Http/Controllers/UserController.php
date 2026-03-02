<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
//use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
  public function index()
  {
    return view('user.index');
  }

  public function orders()
  {
      $header_title = "Замовлення";
    $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
    return view('user.orders', compact('orders', 'header_title'));
  }
  public function order_details($order_id)
  {
        $header_title = "Деталі замовлення";
    $order = Order::where('user_id', Auth::user()->id)->where('id', $order_id)->firstOrFail();
    if ($order) {
      $orderItems = OrderItem::where('order_id', $order->id)->orderBy('id')->paginate(12);
      $transaction = Transaction::where('order_id', $order->id)->first();
      return view('user.order_details', compact('order', 'orderItems', 'transaction', 'header_title'));
    } else {
      return redirect()->route('login');
    }
  }
}
