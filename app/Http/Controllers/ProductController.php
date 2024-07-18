<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $products = Product::where('user_id', $user->id)->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        
        $product = new Product([
            'product_name' => $request->input('product_name'),
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
            'user_id' => $user->id,
        ]);

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
       
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
        ]);
    
        $product->update([
            'product_name' => $request->input('product_name'),
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
        ]);

        $product->save();
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    

    public function destroy(Product $product)
{
    $product->delete();

    return response()->json(['message' => 'Product deleted successfully.']);
}

}
