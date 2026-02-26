<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\Category;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;

class AdminController extends Controller
{
  public function index()
  {
    return view('admin.index');
  }

  public function brands()
  {
    $header_title = "Бренди";

    $brands = Brand::orderBy('id', 'DESC')->paginate(10);
    return view('admin.brands', compact('brands', 'header_title'));
  }

  public function add_brand()
  {
    $header_title = "Додати бренд";
    return view('admin.add_brand', compact('header_title'));
  }

  public function store_brand(Request $request)
  {
    $request->validate([
      'name'  => 'required|string|max:255',
      'slug'  => 'required|string|max:255|unique:brands,slug',
      'image' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $brand = new Brand();
    $brand->name = $request->name;
    $brand->slug = Str::slug($request->name);

    if ($request->hasFile('image')) {
      $image = $request->file('image');
      $file_extension = $image->extension();
      $file_name = Carbon::now()->timestamp . '.' . $file_extension;

      $this->GenerateBrandThumbnailsImage($image, $file_name);
      $brand->image = $file_name;
    }

    $brand->save();

    return redirect()->route('admin.brands')
      ->with('success', 'Бренд успішно додано.');
  }


  public function edit_brand($id)
  {
    $header_title = "Редагувати бренд";
    $brand = Brand::findOrFail($id);
    return view('admin.edit_brand', compact('brand', 'header_title'));
  }

  public function update_brand(Request $request)
  {
    $request->validate([
      'name'  => 'required|string|max:255',
      'slug'  => 'required|string|max:255|unique:brands,slug' . ',' . $request->id,
      'image' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $brand = Brand::findOrFail($request->id);
    $brand->name = $request->name;
    $brand->slug = Str::slug($request->name);
    if ($request->hasFile('image')) {
      if (File::exists(public_path('uploads/brands/' . $brand->image))) {
        File::delete(public_path('uploads/brands/' . $brand->image));
      }
      $image = $request->file('image');
      $file_extension = $request->file('image')->extension();
      $file_name = Carbon::now()->timestamp . '.' . $file_extension;
      $this->GenerateBrandThumbnailsImage($image, $file_name);
      $brand->image = $file_name;
    }

    $brand->save();

    return redirect()->route('admin.brands')
      ->with('success', 'Бренд успішно змінено.');
  }

  public function GenerateBrandThumbnailsImage($image, $imageName)
  {
    $destinationPath = public_path('/uploads/brands');

    if (!file_exists($destinationPath)) {
      mkdir($destinationPath, 0755, true);
    }

    $img = Image::read($image)
      ->cover(300, 100)
      ->save($destinationPath . '/' . $imageName);
  }
  public function delete_brand($id)
  {
    $brand = Brand::findOrFail($id);

    if (File::exists(public_path('uploads/brands/' . $brand->image))) {
      File::delete(public_path('uploads/brands/' . $brand->image));
    }

    $brand->delete();

    return redirect()->route('admin.brands')
      ->with('success', 'Бренд успішно видалено.');
  }

  public function categories()
  {
    $header_title = "Категорії";

    $categories = Category::orderBy('id', 'DESC')->paginate(10);
    return view('admin.categories', compact('categories', 'header_title'));
  }

  public function add_category()
  {
    $header_title = "Додати категорію";
    return view('admin.add_category', compact('header_title'));
  }


  public function GenerateCategoryThumbnailsImage($image, $imageName)
  {
    $destinationPath = public_path('/uploads/categories');

    if (!file_exists($destinationPath)) {
      mkdir($destinationPath, 0755, true);
    }

    $img = Image::read($image)
      ->cover(300, 100)
      ->save($destinationPath . '/' . $imageName);
  }

  public function store_category(Request $request)
  {
    $request->validate([
      'name'  => 'required|string|max:255',
      'slug'  => 'required|string|max:255|unique:categories,slug',
    ]);

    $category = new Category();
    $category->name = $request->name;
    $category->slug = Str::slug($request->name);

    if ($request->hasFile('image')) {
      $image = $request->file('image');
      $file_extension = $image->extension();
      $file_name = Carbon::now()->timestamp . '.' . $file_extension;

      $this->GenerateCategoryThumbnailsImage($image, $file_name);
      $category->image = $file_name;
    }

    $category->save();

    return redirect()->route('admin.categories')
      ->with('success', 'Категорію успішно додано.');
  }

  public function edit_category($id)
  {
    $header_title = "Редагувати категорію";
    $category = Category::findOrFail($id);
    return view('admin.edit_category', compact('category', 'header_title'));
  }

  public function update_category(Request $request)
  {
    $request->validate([
      'name'  => 'required|string|max:255',
      'slug'  => 'required|string|max:255|unique:categories,slug' . ',' . $request->id,
    ]);

    $category = Category::findOrFail($request->id);
    $category->name = $request->name;
    $category->slug = Str::slug($request->name);
    if ($request->hasFile('image')) {
      if (File::exists(public_path('uploads/categories/' . $category->image))) {
        File::delete(public_path('uploads/categories/' . $category->image));
      }
      $image = $request->file('image');
      $file_extension = $request->file('image')->extension();
      $file_name = Carbon::now()->timestamp . '.' . $file_extension;
      $this->GenerateCategoryThumbnailsImage($image, $file_name);
      $category->image = $file_name;
    }

    $category->save();

    return redirect()->route('admin.categories')
      ->with('success', 'Категорію успішно змінено.');
  }

  public function delete_category($id)
  {
    $category = Category::findOrFail($id);

    if (File::exists(public_path('uploads/categories/' . $category->image))) {
      File::delete(public_path('uploads/categories/' . $category->image));
    }

    $category->delete();

    return redirect()->route('admin.categories')
      ->with('success', 'Категорію успішно видалено.');
  }

  public function products()
  {
    $header_title = "Продукти";
    $products = Product::orderBy('created_at', 'DESC')->paginate(10);

    return view('admin.products', compact('header_title', 'products'));
  }

  public function add_product()
  {
    $header_title = "Додати продукт";
    $categories = Category::select('id', 'name')->orderBy('name')->get();
    $brands = Brand::select('id', 'name')->orderBy('name')->get();

    return view('admin.add_product', compact('header_title', 'categories', 'brands'));
  }

  public function GenerateProductImages($image, $imageName)
  {
    $mainPath  = public_path('/uploads/products');
    $thumbPath = public_path('/uploads/products/thumbnails');

    if (!file_exists($mainPath)) {
      mkdir($mainPath, 0755, true);
    }

    if (!file_exists($thumbPath)) {
      mkdir($thumbPath, 0755, true);
    }

    // Основне зображення
    Image::read($image)
      ->cover(540, 680, 'center')
      ->save($mainPath . '/' . $imageName);

    // Thumbnail
    Image::read($image)
      ->cover(124, 124, 'center')
      ->save($thumbPath . '/' . $imageName);
  }
  public function GenerateProductThumbnailImage($image, $imageName)
  {
    $destinationPath = public_path('/uploads/products');

    $destinationPath = public_path('/uploads/products/thumbnails');

    if (!file_exists($destinationPath)) {
      mkdir($destinationPath, 0755, true);
    }

    $img = Image::read($image);
    $img->cover(540, 680, "top");
    $img->resize(124, 124, function ($constraint) {
      $constraint->aspectRatio();
    })->save($destinationPath . '/' . $imageName);
  }
  public function store_product(Request $request)
  {
    $request->validate([
      'name'               => 'required|string|max:255',
      'slug'               => 'nullable|string|max:255|unique:products,slug',
      'category_id'        => 'required|exists:categories,id',
      'brand_id'           => 'nullable|exists:brands,id',
      'SKU'                => 'required|string|max:100|unique:products,SKU',
      'quantity'           => 'required|integer|min:0',
      'stock_status'       => 'required|in:instock,outofstock',
      'regular_price'      => 'required|numeric|min:0',
      'sale_price'         => 'nullable|numeric|min:0',
      'short_description'  => 'required|string',
      'description'        => 'required|string',
      'featured'           => 'boolean',
      'image'              => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
      'images.*'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);


    $product = new Product();
    $product->name              = $request->name;
    $product->slug              = $request->slug ?? Str::slug($request->name);
    $product->category_id       = $request->category_id;
    $product->brand_id          = $request->brand_id;
    $product->SKU               = $request->SKU;
    $product->quantity          = $request->quantity;
    $product->stock_status      = $request->stock_status;
    $product->regular_price     = $request->regular_price;
    $product->sale_price        = $request->sale_price;
    $product->short_description = $request->short_description;
    $product->description       = $request->description;
    $product->featured          = $request->featured ?? 0;

    $timestamp = now()->timestamp;

    /** Головне зображення */
    if ($request->hasFile('image')) {
      $image = $request->file('image');
      $imageName = $timestamp . '.' . $image->getClientOriginalExtension();

      $this->GenerateProductImages($image, $imageName);

      $product->image = $imageName;
    }

    /** Зберігаємо продукт */
    $product->save();

    /** Галерея */
    if ($request->hasFile('images')) {

      $gallery = [];
      $counter = 1;

      foreach ($request->file('images') as $file) {

        $fileName = $timestamp . '-' . $counter . '.' . $file->getClientOriginalExtension();

        $this->GenerateProductImages($file, $fileName);

        $gallery[] = $fileName;
        $counter++;
      }

      $product->images = implode(',', $gallery);
      $product->save();
    }


    return redirect()
      ->route('admin.products')
      ->with('success', 'Продукт успішно додано');
  }



  public function edit_product($id)
  {
    $header_title = "Редагувати продукт";

    $product = Product::findOrFail($id);

    $categories = Category::select('id', 'name')
      ->orderBy('name')
      ->get();

    $brands = Brand::select('id', 'name')
      ->orderBy('name')
      ->get();

    return view('admin.edit_product', compact(
      'header_title',
      'product',
      'categories',
      'brands'
    ));
  }



  public function update_product(Request $request)
  {
    $request->validate([
      'name'              => 'required|string|max:255',
      'slug'              => 'nullable|string|max:255|unique:products,slug,' . $request->id,
      'category_id'       => 'required|exists:categories,id',
      'brand_id'          => 'nullable|exists:brands,id',
      'SKU'               => 'required|string|max:100|unique:products,SKU,' . $request->id,
      'quantity'          => 'required|integer|min:0',
      'stock_status'      => 'required|in:instock,outofstock',
      'regular_price'     => 'required|numeric|min:0',
      'sale_price'        => 'nullable|numeric|min:0',
      'short_description' => 'required|string',
      'description'       => 'required|string',
      'featured'          => 'boolean',
      'image'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
      'images.*'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    $product = Product::findOrFail($request->id);

    $product->fill([
      'name'              => $request->name,
      'slug'              => $request->slug ?? Str::slug($request->name),
      'category_id'       => $request->category_id,
      'brand_id'          => $request->brand_id,
      'SKU'               => $request->SKU,
      'quantity'          => $request->quantity,
      'stock_status'      => $request->stock_status,
      'regular_price'     => $request->regular_price,
      'sale_price'        => $request->sale_price,
      'short_description' => $request->short_description,
      'description'       => $request->description,
      'featured'          => $request->featured ?? 0,
    ]);

    $timestamp = now()->timestamp;

    /* ===== Головне зображення ===== */
    if ($request->hasFile('image')) {

      if ($product->image) {
        File::delete(public_path('uploads/products/' . $product->image));
        File::delete(public_path('uploads/products/thumbnails/' . $product->image));
      }

      $image     = $request->file('image');
      $imageName = $timestamp . '.' . $image->getClientOriginalExtension();

      $this->GenerateProductImages($image, $imageName);

      $product->image = $imageName;
    }

    /* ===== Галерея ===== */
    if ($request->hasFile('images')) {

      if ($product->images) {
        foreach (explode(',', $product->images) as $oldImage) {
          File::delete(public_path('uploads/products/' . $oldImage));
          File::delete(public_path('uploads/products/thumbnails/' . $oldImage));
        }
      }

      $gallery = [];
      $counter = 1;

      foreach ($request->file('images') as $file) {

        $fileName = $timestamp . '-' . $counter . '.' . $file->getClientOriginalExtension();

        $this->GenerateProductImages($file, $fileName);

        $gallery[] = $fileName;
        $counter++;
      }

      $product->images = implode(',', $gallery);
    }

    $product->save();

    return redirect()
      ->route('admin.products')
      ->with('success', 'Продукт успішно оновлено');
  }




  public function delete_product($id)
  {
    $product = Product::findOrFail($id);

    if (File::exists(public_path('uploads/products/' . $product->image))) {
      File::delete(public_path('uploads/products/' . $product->image));
    }

    if (File::exists(public_path('uploads/products/thumbnails' . $product->image))) {
      File::delete(public_path('uploads/products/thumbnails' . $product->image));
    }

    if ($product->images) {
      foreach (explode(',', $product->images) as $oldImage) {
        File::delete(public_path('uploads/products/' . $oldImage));
        File::delete(public_path('uploads/products/thumbnails/' . $oldImage));
      }
    }


    $product->delete();

    return redirect()->route('admin.products')
      ->with('success', 'Продукт успішно видалено.');
  }
  public function coupons()
  {
    $header_title = "Купони";

    $coupons = Coupon::orderBy('expire_date', 'DESC')->paginate(10);

    return view('admin.coupons', compact('header_title', 'coupons'));
  }

  public function add_coupon()
  {
    $header_title = "Додати купон";
    return view('admin.add_coupon', compact('header_title'));
  }

  public function store_coupon(Request $request)
  {
    $request->validate([
      'code'       => 'required',
      'type'       => 'required',
      'value'      => 'required|numeric',
      'cart_value' => 'required|numeric',
      'expire_date' => 'required|date|after_or_equal:today',
    ]);

    $coupon = new Coupon();
    $coupon->code = $request->code;
    $coupon->type = $request->type;
    $coupon->value = $request->value;
    $coupon->cart_value = $request->cart_value;
    $coupon->expire_date = $request->expire_date;
    $coupon->save();

    return redirect()->route('admin.coupons')
      ->with('success', 'Купон успішно додано.');
  }

public function edit_coupon($id)
  {
    $header_title = "Редагувати купон";
    $coupon = Coupon::findOrFail($id);
    return view('admin.edit_coupon', compact('coupon', 'header_title'));
  }

  public function update_coupon(Request $request)
  {
    $request->validate([
      'code'       => 'required',
      'type'       => 'required',
      'value'      => 'required|numeric',
      'cart_value' => 'required|numeric',
      'expire_date' => 'required|date|after_or_equal:today',
    ]);

    $coupon = Coupon::findOrFail($request->id);
    $coupon->code = $request->code;
    $coupon->type = $request->type;
    $coupon->value = $request->value;
    $coupon->cart_value = $request->cart_value;
    $coupon->expire_date = $request->expire_date;
    $coupon->save();

    return redirect()->route('admin.coupons')
      ->with('success', 'Купон успішно оновлено.');
  }

  public function delete_coupon($id)
  {
    $coupon = Coupon::findOrFail($id);
    $coupon->delete();

    return redirect()->route('admin.coupons')
      ->with('success', 'Купон успішно видалено.');
  }

  public function orders()
  {
    $header_title = "Замовлення";
    $orders = Order::orderBy('created_at', 'DESC')->paginate(10);
    return view('admin.orders', compact('header_title', 'orders'));
  }

  public function order_details($order_id)
  {
    $header_title = "Деталі замовлення";
    $order = Order::findOrFail($order_id);
    $orderItems = OrderItem::where('order_id', $order_id)->orderBy('id')->paginate(10);
    $transaction = Transaction::where('order_id', $order_id)->first();
    return view('admin.order_details', compact('header_title', 'order', 'orderItems', 'transaction'));
  }

}
