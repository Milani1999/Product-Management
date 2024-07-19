<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    public function index()
    {
        $donations = Donation::with(['product', 'user'])->get();

        return view('issuer.dashboard', compact('donations'));
    }

    public function issueForm(Donation $donation)
    {
        return view('issuer.issues', compact('donation'));
    }

    public function issue(Request $request, Donation $donation)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1|max:' . $donation->remaining_quantity,
        ]);

        $updatedQuantity = $donation->remaining_quantity - $request->quantity;

        if ($updatedQuantity < 0) {
            return redirect()->back()->with('error', 'Cannot issue more than available quantity.');
        }

        $donation->update(['remaining_quantity' => $updatedQuantity]);

        Issue::create([
            'user_id' => Auth::id(),
            'product_id' => $donation->product_id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('issuer.dashboard')->with('success', 'Product issued successfully.');
    }

    public function showIssuedProducts()
    {
        $userId = Auth::id();
        $issues = Issue::where('user_id', $userId)
                       ->with('product')
                       ->get();

        return view('issuer.issued-products', compact('issues'));
    }

    public function showAllHistory()
    {
    $issues = Issue::with(['user:id,name,email', 'product:id,product_name,description'])->get();
    return view('admin.issue_history', compact('issues'));
    }

}
