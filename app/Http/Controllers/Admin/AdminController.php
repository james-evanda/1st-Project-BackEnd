<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Category;
use App\Models\Invoice;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalProducts' => Product::count(),
            'totalUsers' => User::count(),
            'totalCategories' => Category::count(),
            'totalInvoices' => Invoice::count(),
            'totalSales' => Invoice::where('status', 'Paid')->sum('total_price'),
        ]);
        
    }
}
