<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Anggota - Koperasi Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('template/css/styles.css') }}">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Koperasi</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Master Data</div>
                        <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link" href="{{ route('anggota.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Anggota
                        </a>
                        <a class="nav-link" href={{route('jenis-produk.index')}}>
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Jenis Produk
                        </a>
                        <a class="nav-link" href={{route('produk.index')}}>
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Produk
                        </a>
                        <a class="nav-link" href={{route('pesanan.index')}}>
                            <div class="sb-nav-link-icon"><i class="fas fa-cart-shopping"></i></div>
                            Pemesanan
                        </a>
                        <a class="nav-link" href={{route('pembayaran.index')}}>
                            <div class="sb-nav-link-icon"><i class="fas fa-money-bill-transfer"></i></div>
                            Transaksi
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="container mt-4">
                        <h1 class="mb-4">Edit Pemesanan</h1>

                        <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                                            value="{{ $pesanan->tanggal }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="anggota_id">Anggota</label>
                                        <select class="form-control" id="anggota_id" name="anggota_id" required>
                                            <option value="">Pilih Anggota</option>
                                            @foreach($anggota as $a)
                                                <option value="{{ $a->id }}" {{ $pesanan->anggota_id == $a->id ? 'selected' : '' }}>{{ $a->pegawai->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="diskon">Diskon (%)</label>
                                        <input type="number" class="form-control" id="diskon" name="diskon" min="0"
                                            max="100" value="{{ $pesanan->diskon }}">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <h4>Detail Produk</h4>
                            <div id="produk-container">
                                @foreach($pesanan->detailPesanan as $index => $detail)
                                    <div class="row produk-item mb-3">
                                        <div class="col-md-5">
                                            <select class="form-control produk-select" name="produk_id[]" required>
                                                <option value="">Pilih Produk</option>
                                                @foreach($produk as $p)
                                                    <option value="{{ $p->id }}" data-harga="{{ $p->harga }}" {{ $detail->produk_id == $p->id ? 'selected' : '' }}>
                                                        {{ $p->nama }} (Rp
                                                        {{ number_format($p->harga, 0, ',', '.') }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control jumlah" name="jumlah[]" min="1"
                                                value="{{ $detail->jumlah }}" required>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control subtotal" readonly
                                                value="Rp {{ number_format($detail->produk->harga * $detail->jumlah, 0, ',', '.') }}">
                                        </div>
                                        <div class="col-md-1">
                                            @if($index === 0)
                                                <button type="button" class="btn btn-danger btn-remove" disabled>×</button>
                                            @else
                                                <button type="button" class="btn btn-danger btn-remove">×</button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" id="btn-add-produk" class="btn btn-secondary mb-3">Tambah
                                Produk</button>

                            <hr>

                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="text" class="form-control" id="total" readonly
                                    value="Rp {{ number_format($pesanan->total, 0, ',', '.') }}">
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="status_bayar" name="status_bayar" {{ $pesanan->status_bayar ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_bayar">Status Bayar (Lunas)</label>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">© {{ date('Y') }} Koperasi Pegawai | All Rights Reserved</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('template/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('template/assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('template/assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('template/js/datatables-simple-demo.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add new product row
            document.getElementById('btn-add-produk').addEventListener('click', function () {
                const container = document.getElementById('produk-container');
                const newRow = container.firstElementChild.cloneNode(true);

                // Clear values in the new row
                newRow.querySelector('.produk-select').selectedIndex = 0;
                newRow.querySelector('.jumlah').value = 1;
                newRow.querySelector('.subtotal').value = '';
                newRow.querySelector('.btn-remove').disabled = false;
                newRow.querySelector('.btn-remove').addEventListener('click', function () {
                    newRow.remove();
                    calculateTotal();
                });

                container.appendChild(newRow);

                // Add event listeners to new row
                addProdukEventListeners(newRow);
            });

            // Add event listeners to existing rows
            document.querySelectorAll('.produk-item').forEach(row => {
                addProdukEventListeners(row);
            });

            // Function to add event listeners to a product row
            function addProdukEventListeners(row) {
                const produkSelect = row.querySelector('.produk-select');
                const jumlahInput = row.querySelector('.jumlah');
                const subtotalInput = row.querySelector('.subtotal');

                // Calculate subtotal when product or quantity changes
                produkSelect.addEventListener('change', calculateSubtotal);
                jumlahInput.addEventListener('input', calculateSubtotal);

                // Calculate subtotal for this row
                function calculateSubtotal() {
                    const harga = produkSelect.options[produkSelect.selectedIndex]?.dataset.harga || 0;
                    const jumlah = jumlahInput.value || 0;
                    const subtotal = harga * jumlah;

                    subtotalInput.value = formatRupiah(subtotal);
                    calculateTotal();
                }
            }

            // Calculate total for all products
            function calculateTotal() {
                let total = 0;

                document.querySelectorAll('.produk-item').forEach(row => {
                    const produkSelect = row.querySelector('.produk-select');
                    const jumlahInput = row.querySelector('.jumlah');
                    const harga = produkSelect.options[produkSelect.selectedIndex]?.dataset.harga || 0;
                    const jumlah = jumlahInput.value || 0;

                    total += harga * jumlah;
                });

                // Apply discount
                const diskon = document.getElementById('diskon').value || 0;
                total = total * (1 - diskon / 100);

                document.getElementById('total').value = formatRupiah(total);
            }

            // Format number as Rupiah
            function formatRupiah(angka) {
                return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            // Calculate total when discount changes
            document.getElementById('diskon').addEventListener('input', calculateTotal);
        });
    </script>
</body>

</html>