<?php
// buat variabel yang menerima value yang dikirim dari form
$nama_customer = $_POST['customer'];
$produk = $_POST['produk'];
$jumlah = $_POST['jumlah'];

// Daftar harga produk (misalnya)
$harga_produk = [
    "Laptop" => 7000000,
    "Smartphone" => 5000000,
    "Tablet" => 3000000
];

// LOGIKA MENGHITUNG TOTAL HARGA
if (array_key_exists($produk, $harga_produk)) {
    $harga_satuan = $harga_produk[$produk];
    $total_harga = $harga_satuan * $jumlah;
} else {
    $total_harga = 0;
}

// mencetak belanjaan
echo "Nama Customer: " . $nama_customer . "<br>";
echo "Produk Dibeli: " . $produk . "<br>";
echo "Jumlah: " . $jumlah . "<br>";
echo "Total Harga: Rp " . number_format($total_harga, 0, ',', '.');
?>