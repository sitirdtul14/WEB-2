<?php

namespace App\Services;

class Helper
{
    // Format angka menjadi rupiah (contoh: Rp 1.000.000)
    public static function formatRupiah($angka)
    {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }

    // Format tanggal menjadi lebih mudah dibaca (contoh: 12 Mei 2025)
    public static function formatTanggal($tanggal)
    {
        return date('d F Y', strtotime($tanggal));
    }

    // Menghasilkan kode unik untuk pesanan
    public static function generateOrderCode()
    {
        return 'ORD-' . strtoupper(uniqid());
    }
}
