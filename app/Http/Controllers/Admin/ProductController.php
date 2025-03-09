<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
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
        // Validate request
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|min:5|max:80',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'image' => 'required|image|max:2048'
        ]);
    
        $imagePath = $request->file('image')->store('products', 'public');
    
        // Create product
        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'photo' => $imagePath
        ]);
    
        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

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
    public function update(Request $request, Product $product) {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|min:5|max:80',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|max:2048' // Allow optional file upload
        ]);
    
        $data = $request->only(['category_id', 'name', 'price', 'quantity']);
    
        // Check if a new image is uploaded
        if ($request->hasFile('image')) { // Change 'photo' to 'image'
            // Delete old image if it exists
            if ($product->photo && Storage::disk('public')->exists($product->photo)) {
                Storage::disk('public')->delete($product->photo);
            }
    
            // Store new image
            $data['photo'] = $request->file('image')->store('products', 'public');
        }
    
        // Update product
        $product->update($data);
    
        return redirect()->route('admin.products.index')->with('success', 'Product successfully updated!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
