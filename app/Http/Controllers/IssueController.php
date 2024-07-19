<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


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

    // public function issue(Request $request, Donation $donation)
    // {
    //     $request->validate([
    //         'quantity' => 'required|numeric|min:1|max:' . $donation->remaining_quantity,
    //     ]);

    //     $updatedQuantity = $donation->remaining_quantity - $request->quantity;

    //     if ($updatedQuantity < 0) {
    //         return redirect()->back()->with('error', 'Cannot issue more than available quantity.');
    //     }

    //     $donation->update(['remaining_quantity' => $updatedQuantity]);

    //     Issue::create([
    //         'user_id' => Auth::id(),
    //         'product_id' => $donation->product_id,
    //         'quantity' => $request->quantity,
    //     ]);

    //     return redirect()->route('issuer.dashboard')->with('success', 'Product issued successfully.');
    // }


    // public function issue(Request $request, Donation $donation)
    // {
    //     $user = Auth::user();
    //     $currentMonth = Carbon::now()->month;
    //     $currentYear = Carbon::now()->year;
    
    //     $request->validate([
    //         // 'quantity' => 'required|numeric|min:1|max:3',
    //         // 'quantity' => 'required|numeric',
    //     ]);
    
    //     $requestedQuantity = $request->quantity;
    
    //     // if ($requestedQuantity > $donation->remaining_quantity) {
    //     //     return redirect()->back()->with('error', 'Cannot issue more than available quantity.');
    //     // }
    
    //     if ($requestedQuantity <= 0) {
    //         return redirect()->back()->with('error', 'Quantity must be greater than zero.');
    //     }

    //     if ($requestedQuantity > 3) {
    //         return redirect()->back()->with('error', 'Your issue limit is 3 per entry');
    //     }
    
    //     $t_Issued = Issue::where('user_id', $user->id)
    //         ->whereYear('created_at', $currentYear)
    //         ->whereMonth('created_at', $currentMonth)
    //         ->sum('quantity');
    
    //     if ($t_Issued + $requestedQuantity > 100) {
    //         return redirect()->back()->with('error', 'Your issue limit is 100 per month');
    //     }
    
    //     $updatedQuantity = $donation->remaining_quantity - $requestedQuantity;
    //     $donation->update(['remaining_quantity' => $updatedQuantity]);
    
    //     Issue::create([
    //         'user_id' => $user->id,
    //         'product_id' => $donation->product_id,
    //         'quantity' => $requestedQuantity,
    //     ]);
    
    //     return redirect()->route('issuer.dashboard')->with('success', 'Product issued successfully.');
    // }

    public function issue(Request $request, Donation $donation)

    {
        $user = Auth::user();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
    
        $request->validate([
            'quantity' => 'required|numeric|min:1|max:3',
        ]);
    
        $requestedQuantity = $request->quantity;
    
        if ($requestedQuantity > $donation->remaining_quantity) {
            return response()->json(['success' => false, 'message' => 'Cannot issue more than available quantity.']);
        }
    
        if ($requestedQuantity <= 0) {
            return response()->json(['success' => false, 'message' => 'Quantity must be greater than zero.']);
        }
    
        if ($requestedQuantity > 3) {
            return response()->json(['success' => false, 'message' => 'Your issue limit is 3 per entry.']);
        }
    
        $totalIssued = Issue::where('user_id', $user->id)
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('quantity');
    
        if ($totalIssued + $requestedQuantity > 100) {
            return response()->json(['success' => false, 'message' => 'Your issue limit is 100 per month.']);
        }
    
        $updatedQuantity = $donation->remaining_quantity - $requestedQuantity;
        $donation->update(['remaining_quantity' => $updatedQuantity]);
    
        Issue::create([
            'user_id' => $user->id,
            'product_id' => $donation->product_id,
            'quantity' => $requestedQuantity,
        ]);
    
        return response()->json([
            'success' => true, 
            'message' => 'Product issued successfully.',
            'redirect' => route('issuer.dashboard')
        ]);    }

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
