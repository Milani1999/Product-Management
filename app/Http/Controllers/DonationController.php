<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
  
    // public function index()
    // {
    //     $user = Auth::user();
    //     $products = Product::where('user_id', $user->id)->get();
    //     return view('products.index', compact('products'));
    // }

    public function index()
    {
        $user = Auth::user();
        $donations = Donation::where('user_id', $user->id)->with('product')->get();
        return view('donator.index', compact('donations'));
    }

    public function donate(Product $product)
    {
        return view('products.donate', compact('product'));
    }

  
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1|max:' . $product->quantity,
        ]);

        $product->quantity -= $request->quantity;
        $product->save();

        Donation::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('products.index')
                         ->with('success', 'Donation successful.');
    }
}

