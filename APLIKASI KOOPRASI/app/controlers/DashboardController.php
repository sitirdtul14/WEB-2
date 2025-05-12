<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController
{
    // Menampilkan halaman dashboard
    public function index()
    {
        // Mengambil data jumlah pengguna dan total pesanan dari database
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_harga');

        return view('dashboard', compact('totalUsers', 'totalOrders', 'totalRevenue'));
    }
}
// Controller ini digunakan untuk mengatur tampilan halaman dashboard.