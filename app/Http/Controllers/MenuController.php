<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class MenuController extends Controller
{
    public function showMenu()
    {
        $categories = Category::with('products')->get();

        return view('user_views.menu', compact('categories'));
    }

    public function showCategory($name)
    {
        $category = Category::where('name', $name)->firstOrFail();

        return view('user_views.category_products', compact('category'));
    }

    public function quickView($name)
    {
        $product = Product::where('name', $name)->firstOrFail();
        return view('user_views.quick_view', compact('product'));
    }
}
