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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['pembelian'] }}</div>
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
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['penjualan'] }}</div>
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
                                    {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['best_seller'] }}</div> --}}
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
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Nama Barang</h6>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between my-2 ">
                        <h1 class="h3 mb-0 text-gray-800">PT. Globalindo Inovatif</h1>
                        <a href="add-barang" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Tambah Barang</a>
                    </div>

                    <div class="row justify-content-end my-3 mr-3">
                        <form action="/home">
                            <div class="input-group justify-content-end">
                                <input type="text" class="form-control" placeholder="Search..." name="search"
                                    value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>
                    </div>

                    <div class="mx-3">
                        <table class="table table-striped table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Saldo Awal</th>
                                    <th>Qty</th>
                                    <th>Lokasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Saldo Awal</th>
                                    <th>Qty</th>
                                    <th>Lokasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody class="text-center">
                                <?php $no = 1; ?>
                                @foreach ($data['barang'] as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->saldo_awal }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->lokasi }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('/edit-barang') }}/{{ $item['id'] }}"
                                                class="btn btn-warning btn-sm" style="width: 80px">Edit</a> &nbsp;
                                            {{-- <a href="{{ url('/delete-barang') }}/{{ $item['id'] }}"
                                                class="btn btn-danger btn-sm" style="width: 80px"
                                                onclick="return confirm('Apakah kamu yakin?');">Delete</a> --}}
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

    <script>
        $(document).ready(function() {


        })

        // Get Modal
        function createPenjualan() {
            $.get("{{ url('penjualan') }}",{}, function(data, status){
                $("#modalTitle").html('Form Pembelian');
                $("#modalBody").html(data);
                $("#modalPembelian").modal('show');
            });
        }

        // Store Modal
        // function storePenjualan() {
        //     var nomor_nota = $("#nomor_nota").val();
        //     var barang = $("#barang").val();
        //     var qty = $("#qty").val();
        //     $.ajax({
        //         type: "get",
        //         url: "{{ url('store-penjualan') }}",
        //         data: {
        //             "nomor_nota=" + nomor_nota,
        //             "barang=" + barang,
        //             "qty=" + qty 
        //         },
        //         success: function(data) {
        //             $(".btn-close").click();
        //         }
        //     });
        // }

        function storePenjualan() {
            var nota = $("#nomor_nota").val();
            $.ajax({
                type: "get",
                url: "{{ url('store-penjualan') }}",
                data: "nomor_nota=" + nota,
                success: function(data) {
                    $(".btn-close").click();
                    read()
                }
            });
        }
    </script>

</div>
