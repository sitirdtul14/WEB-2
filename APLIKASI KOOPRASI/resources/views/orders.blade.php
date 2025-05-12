@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Daftar Pesanan</h2>
    <a href="{{ route('order.create') }}" class="btn btn-success mb-3">Tambah Pesanan</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Pelanggan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->nama_pelanggan }}</td>
                <td>{{ $order->produk }}</td>
                <td>{{ $order->jumlah }}</td>
                <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('order.detail', $order->id) }}" class="btn btn-primary">Detail</a>
                    <a href="{{ route('order.edit', $order->id) }}" class="btn btn-warning">Edit</a>
                    <form method="POST" action="{{ route('order.delete', $order->id) }}" style="display:inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
