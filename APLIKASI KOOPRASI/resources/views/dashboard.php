@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-4">
        @include('components.cards', ['title' => 'Total Pengguna', 'value' => $totalUsers])
    </div>
    <div class="col-lg-4">
        @include('components.cards', ['title' => 'Total Pesanan', 'value' => $totalOrders])
    </div>
    <div class="col-lg-4">
        @include('components.cards', ['title' => 'Pendapatan', 'value' => 'Rp ' . number_format($totalRevenue, 0, ',', '.')])
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-12">
        @include('components.tables')
    </div>
</div>
@endsection
