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
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5>Edit Anggota</h5>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('anggota.update', $anggota->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIP</label>
                                    <input type="text" class="form-control" id="nip" name="nip"
                                        value="{{ $anggota->pegawai->nip ?? $anggota->nip }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ $anggota->pegawai->nama ?? $anggota->nama }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki"
                                                value="L" {{ $anggota->pegawai->jenis_kelamin == 'L' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="laki">Laki-laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                id="perempuan" value="P" {{  $anggota->pegawai->jenis_kelamin == 'P' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="perempuan">Perempuan</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="jabatan" class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan"
                                        value="{{ $anggota->pegawai->jabatan ?? $anggota->jabatan }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="status_aktif" class="form-label">Status</label>
                                    <select class="form-control" id="status_aktif" name="status_aktif" required>
                                        <option value="1" {{ $anggota->status_aktif ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ !$anggota->status_aktif ? 'selected' : '' }}>Tidak Aktif
                                        </option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
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
</body>

</html>