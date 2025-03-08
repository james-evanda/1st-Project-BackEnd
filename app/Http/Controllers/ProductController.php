<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|min:5|max:80',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'photo' => 'required|image|max:2048'
        ]);

        $photoPath = $request->file('photo')->store('product', 'public');

        Product::create([
            'category_id' => $request->category_id, // Save category
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'photo' => $photoPath
        ]);

        return redirect()->route('products.index')->with('success', 'Product successfully added!');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|min:5|max:80',
            'price' => 'required|integer',
            'quantity' => 'required|integer'
        ]);

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity
        ]);

        return redirect()->route('products.index')->with('success', 'Product successfully updated!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product successfully deleted!');
    }
}
