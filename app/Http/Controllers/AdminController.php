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

  public function peoducts()
  {
    $header_title = "Продукти";
    $products = Product::orderBy('created_at', 'DESC')->paginate(10);

    return view('admin.products', compact('header_title', 'products'));
  }


}
