<?php

namespace App\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\Helper;

class OrderController
{
    public function index()
    {
        $orders = Order::all();
        return view('orders', compact('orders'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'produk' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0'
        ]);

        $validatedData['kode_pesanan'] = Helper::generateOrderCode();
        $validatedData['total_harga'] = Helper::formatRupiah($validatedData['total_harga']);

        Order::create($validatedData);

        return redirect()->route('orders')->with('success', 'Pesanan berhasil dibuat!');
    }
}
