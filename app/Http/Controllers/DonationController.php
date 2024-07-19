<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Donation;
use App\Events\DonationCreated;
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
    $validatedData = $request->validate([
        'quantity' => 'required|numeric|min:1|max:' . $product->quantity,
    ]);

    $updatedQuantity = $product->quantity - $validatedData['quantity'];

    $product->update(['quantity' => $updatedQuantity]);

    $donation = Donation::create([
        'user_id' => Auth::id(),
        'product_id' => $product->id,
        'quantity' => $validatedData['quantity'],
        'remaining_quantity' => $validatedData['quantity'],
    ]);

    // event(new DonationCreated($donation));

    return redirect()->route('products.index')
                     ->with('success', 'Donation successful.');
}

public function index2()
{
    $donations = Donation::with(['user:id,name,email', 'product:id,product_name,description'])->get();
    return view('admin.donations', compact('donations'));
}

public function index3()
{
    $donations = Donation::with(['user:id,name,email', 'product:id,product_name,description'])->get();
    return view('admin.donation_history', compact('donations'));
}
}

