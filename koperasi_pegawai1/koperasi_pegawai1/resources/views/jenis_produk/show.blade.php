<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - Koperasi Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('template/css/styles.css') }}">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Koperasi</a>
        <!-- Sidebar Toggle-->
        <div class="">

        </div>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></div>
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
                        <a class="nav-link" href={{route('anggota.index')}}>
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
                            <h5>Detail Anggota Koperasi</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-3 fw-bold">NIP</div>
                                <div class="col-md-9">{{ $anggota->pegawai->nip }}</div>

                                <div class="col-md-3 fw-bold">Nama Lengkap</div>
                                <div class="col-md-9">{{ $anggota->pegawai->nama }}</div>

                                <div class="col-md-3 fw-bold">Jenis Kelamin</div>
                                <div class="col-md-9">
                                    {{ $anggota->pegawai->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </div>

                                <div class="col-md-3 fw-bold">Jabatan</div>
                                <div class="col-md-9">{{ $anggota->pegawai->jabatan }}</div>
                            </div>

                            <h5 class="mb-3">Riwayat Pesanan</h5>
                            @if($anggota->pesanan->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No. Pesanan</th>
                                                <th>Tanggal</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($anggota->pesanan as $pesanan)
                                                <tr>
                                                    <td>#{{ $pesanan->id }}</td>
                                                    <td>{{ $pesanan->tanggal->format('d/m/Y') }}</td>
                                                    <td>Rp {{ number_format($pesanan->total, 2) }}</td>
                                                    <td>
                                                        @if($pesanan->status_bayar)
                                                            <span class="badge bg-success">Lunas</span>
                                                        @else
                                                            <span class="badge bg-warning text-dark">Belum Lunas</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('pesanan.show', $pesanan->id) }}"
                                                            class="btn btn-sm btn-info">Detail</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    Anggota ini belum memiliki riwayat pesanan.
                                </div>
                            @endif

                            <div class="mt-4">
                                <a href="{{ route('anggota.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                                </a>
                                <a href="{{ route('anggota.edit', $anggota->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit Data
                                </a>
                                <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">© <?php echo date("Y"); ?> Koperasi Pegawai | All Rights Reserved</div>
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
    <script src="{{ 'template' }}/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ 'template' }}/assets/demo/chart-area-demo.js"></script>
    <script src="{{ 'template' }}/assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ 'template' }}/js/datatables-simple-demo.js"></script>
</body>

</html>