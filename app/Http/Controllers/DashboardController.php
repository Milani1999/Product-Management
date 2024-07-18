<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
