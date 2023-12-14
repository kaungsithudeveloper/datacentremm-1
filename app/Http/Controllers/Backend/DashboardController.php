<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Backend\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        $orders = Order::orderBy('id','DESC')->get();
        $moviesCount = Product::where('type', 'movie')->where('status', 1)->count();
        $seriesCount = Product::where('type', 'serie')->where('status', 1)->count();
        $gamesCount = Product::where('type', 'game')->where('status', 1)->count();
        $totalAmount = Order::where('status', 'complete')->sum('amount');
        return view('backend.dashboard', compact('orders', 'moviesCount','seriesCount','gamesCount','totalAmount'));
    }

}
