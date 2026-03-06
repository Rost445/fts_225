<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Contact;
use App\Models\Slide;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::where('status', 1)->get()->take(3);
        $categories = Category::orderBy('name')->get();
        $sproducts = Product::whereNotNull('sale_price')->where('sale_price', '<>', '')->inRandomOrder()->take(8)->get();
        $fproducts = Product::where('featured', 1)->get()->take(8);
        return view('index', compact('slides', 'categories', 'sproducts', 'fproducts'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function contact_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'comment' => 'required|string',
        ],  [
            'name.required' => 'Поле Ім’я є обов’язковим.',
            'name.max' => 'Ім’я не може бути довшим за 255 символів.',

            'email.required' => 'Поле Email є обов’язковим.',
            'email.email' => 'Введіть коректну електронну адресу.',
            'email.max' => 'Email не може бути довшим за 255 символів.',

            'phone.required' => 'Поле Телефон є обов’язковим.',
            'phone.max' => 'Телефон не може бути довшим за 20 символів.',

            'comment.required' => 'Поле Коментар є обов’язковим.',
        ], [
            'name' => "Ім’я",
            'email' => 'Email',
            'phone' => 'Телефон',
            'comment' => 'Коментар',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;

        $contact->phone = $request->phone;
        $contact->comment = $request->comment;
        $contact->save();
        return redirect()->back()->with('success', 'Ваше повідомлення успішно надіслано. Ми зв’яжемося з вами найближчим часом!');
    }

    public function search(Request $request)
{
    $query = $request->input('query');

    $results = Product::where('name', 'LIKE', "%{$query}%")
        ->orWhere('description', 'LIKE', "%{$query}%")
        ->take(8)
        ->get();

    return response()->json($results);
}
}