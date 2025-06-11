<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function categories()
    {
        $categories = Category::all();
        return view('categories.show_categories', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('categories.create_category');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
        ]);

        $category = new Category();
        $category->name = $request->name;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('uploaded_img', 'public');
            $image->storeAs('public/category_images', $imagePath);
            $category->image = $imagePath;
        }

        $category->save();

        return redirect()->route('admin.categories')->with('message', ['Category added successfully!']);
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('admin.categories')->with('error', 'Category not found');
        }

        return view('categories.update_category', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'image' => 'image|mimes:jpg,jpeg,png,webp',
        ]);

        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('admin.categories')->with('error', 'Category not found');
        }

        // Update category name
        $category->name = $request->name;

        // Update image if provided
        if ($request->hasFile('image')) {
            $oldImage = $category->image;
            $image = $request->file('image');
            $imagePath = $image->store('uploaded_img', 'public');

            // Delete old image
            if ($oldImage) {
                Storage::delete('public/uploaded_img/' . $oldImage);
            }

            $category->image = $imagePath;
        }

        $category->save();

        return redirect()->route('admin.categories')->with('message', 'Category updated successfully!');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Delete the category image if it exists
        if ($category->image && Storage::exists('public/category_images/' . $category->image)) {
            unlink(storage_path('app/public/category_images/' . $category->image));
        }

        $category->delete();

        return redirect()->route('admin.categories')->with('message', 'Category deleted successfully!');
    }
}
