<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Show the home page with categories and latest products.
     */
    public function showHome()
    {
        $categories = Category::all();
        $latestProducts = Product::whereIn('category_id', [1, 2])
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('user_views.home', compact('categories', 'latestProducts'));
    }

    /**
     * Show the category page.
     */
    public function showCategory()
    {
        return view('user_views.category');
    }

    /**
     * Show the about page.
     */
    public function showAbout()
    {
        return view('user_views.about');
    }

    /**
     * Show the search page.
     */
    public function showSearch()
    {
        return view('user_views.search');
    }

    /**
     * Handle search form submission.
     */
    public function submitSearch(Request $request)
    {
        $searchQuery = $request->input('search_box');

        if (empty($searchQuery)) {
            $products = Product::all();
        } else {
            $products = Product::where('name', 'like', '%' . $searchQuery . '%')->get();
        }

        return view('user_views.search', compact('products'));
    }

    /**
     * Handle AJAX search requests.
     */
    public function ajaxSearch(Request $request)
    {
        $searchQuery = $request->input('search_box');
        $products = Product::where('name', 'like', '%' . $searchQuery . '%')->get();

        return response()->json(['products' => $products]);
    }
}
