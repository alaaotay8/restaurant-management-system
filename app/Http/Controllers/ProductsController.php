<?php
// app/Http/Controllers/ProductsController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display all products and categories in the admin products view.
     */
    public function products()
    {
        $products = Product::all();
        $categories = Category::all();

        return view('products.show_products', compact('products', 'categories'));
    }

    /**
     * Display all products and categories (alternative index method).
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();

        return view('products.show_products', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create_product', compact('categories'));
    }

    /**
     * Store a newly created product in the database.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/|min:0|max:9999999999.99',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp',
        ]);

        // Handle the image upload
        $image = $request->file('image');
        $imagePath = $image->store('uploaded_img', 'public');
        $image->storeAs('public/category_images', $imagePath);

        // Prepare the data for creation
        $data = $request->all();
        $data['name'] = $request->name;
        $data['category_id'] = $request->category_id;
        $data['price'] = $request->price;
        $data['image'] = $imagePath;

        // Create the product
        Product::create($data);

        return redirect()->route('admin.products')->with('message', 'Product added successfully!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found');
        }

        return view('products.update_product', compact('product', 'categories'));
    }

    /**
     * Update the specified product in the database.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/|min:0|max:9999999999.99',
            'category_id' => 'required|exists:categories,id', // Validate category ID
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.create_product')->with('message', 'Product not found');
        }

        // Update product fields
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id; // Set category ID

        // Handle image update if a new image is uploaded
        if ($request->hasFile('image')) {
            $oldImage = $product->image;
            $image = $request->file('image');
            $imagePath = $image->store('uploaded_img', 'public');

            // Delete old image if exists
            if ($oldImage) {
                Storage::delete('public/uploaded_img/' . $oldImage);
            }

            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('admin.products')->with('message', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from the database.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete the product image if it exists
        if ($product->image) {
            Storage::delete('public/uploaded_img/' . $product->image);
        }

        $product->delete();
        return redirect()->route('admin.products')->with('message', 'Product deleted successfully!');
    }
}
