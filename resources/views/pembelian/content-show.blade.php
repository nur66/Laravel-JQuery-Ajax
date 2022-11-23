<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        @include('layouts.navbar');
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
            </div>

            <!-- Card -->
            <div class="row">

                <!-- Terjual -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Pembelian</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['total_pembelian'] }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Penjualan -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Penjualan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['total_penjualan'] }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pembayaran -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Pembelian - Penjualan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['selisih'] }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Best Seller -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        User</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Nur</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-duotone fa-star text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->

            <div class="row">
                <div class="card shadow mb-4 col-xl-12 col-md-12 col-sm-12 mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Pembelian</h6>
                    </div>


                    <div class="d-sm-flex align-items-center justify-content-between my-3 ">
                        <h1 class="h3 mb-0 text-gray-800">PT. Globalindo Inovatif</h1>
                        <a href="add-pembelian" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Tambah Pembelian</a>
                    </div>

                    {{-- <div class="row justify-content-end my-3 mr-3">
                        <form action="/home">
                            <div class="input-group justify-content-end">
                                <input type="text" class="form-control" placeholder="Search..." name="search"
                                    value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>
                    </div> --}}

                    <div class="mx-3">
                        <table class="table table-striped table-bordered mt-2">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>No.Nota</th>
                                    <th>Tanggal Pembelian</th>
                                    <th>Barang</th>
                                    <th>Lokasi</th>
                                    <th>Qty</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>No.Nota</th>
                                    <th>Tanggal Pembelian</th>
                                    <th>Barang</th>
                                    <th>Lokasi</th>
                                    <th>Qty</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($data['pembelian'] as $item)
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td class="text-center">{{ $item->nomor_nota }}</td>
                                        <td class="text-center">{{ $item->tanggal_pembelian }}</td>
                                        <td class="text-center">{{ $item->barang->nama }}</td>
                                        <td class="text-center">{{ $item->barang->lokasi }}</td>
                                        <td class="text-center">{{ $item->qty }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('/edit-pembelian') }}/{{ $item['id'] }}"
                                                class="btn btn-warning btn-sm" style="width: 80px">Edit</a> &nbsp;
                                            <a href="{{ url('/delete-pembelian') }}/{{ $item['id'] }}"
                                                class="btn btn-danger btn-sm" style="width: 80px"
                                                onclick="return confirm('Apakah kamu yakin?');">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Nur Iswanto 2022</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

</div>
