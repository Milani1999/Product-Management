<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        
        return view('dashboard'); 
    }

    public function donatorDashboard()
    {
        return view('donator.dashboard'); 
    }

    public function issuerDashboard()
    {

        return view('issuer.dashboard');
    }

    public function index()
    {
        $topProducts = Donation::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'desc')
            ->limit(10)
            ->with('product')
            ->get();
            $labels = $topProducts->pluck('product.product_name')->toArray();
            $data = $topProducts->pluck('total_quantity')->toArray();
            // dd($labels, $data);

        $topDonors = Donation::select('user_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('user_id')
            ->orderBy('total_quantity', 'desc')
            ->limit(5)
            ->with('user')
            ->get();

$lowStockProducts = Donation::with('product')
    ->where('remaining_quantity', '<', 10)
    ->get();

        return view('admin.dashboard', compact('topProducts', 'topDonors', 'lowStockProducts','labels', 'data'));
    }
}
