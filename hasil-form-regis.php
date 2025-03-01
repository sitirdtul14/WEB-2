<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Belanja Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .harga-pojok-kanan {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 18rem;
        }
        .form-label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5 position-relative">
        <div class="card text-white bg-primary harga-pojok-kanan">
            <div class="card-header">Daftar Harga</div>
            <div class="card-body">
                <p class="card-text">TV: Rp 4.200.000</p>
                <p class="card-text">Kulkas: Rp 3.100.000</p>
                <p class="card-text">Mesin Cuci: Rp 3.800.000</p>
                <p class="text-warning">* Harga dapat berubah setiap saat</p>
            </div>
        </div>
        
        <h2 class="mb-4">Belanja Online</h2>
        <form method="POST" action="form_belanja.php">
            <div class="mb-3 row">
                <label for="customer" class="col-sm-2 col-form-label">Customer</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="customer" name="customer" placeholder="Nama Customer" required>
                </div>
            </div>
            
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Pilih Produk</label>
                <div class="col-sm-10 d-flex align-items-center">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="tv" name="produk" value="TV" required>
                        <label class="form-check-label" for="tv">TV</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="kulkas" name="produk" value="KULKAS">
                        <label class="form-check-label" for="kulkas">Kulkas</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="mesin_cuci" name="produk" value="MESIN CUCI">
                        <label class="form-check-label" for="mesin_cuci">Mesin Cuci</label>
                    </div>
                </div>
            </div>
            
            <div class="mb-3 row">
                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah" min="1" required>
                </div>
            </div>
            
            <button type="submit" class="btn btn-success">Kirim</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
