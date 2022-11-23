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


            <!-- Content Row -->

            <div class="row">
                <div class="card shadow mb-4 col-xl-12 col-md-12 col-sm-12 mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Kartu Stok</h6>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between my-2 ">
                        <h1 class="h3 mb-0 text-gray-800">PT. Globalindo Inovatif</h1>
                    </div>

                    <div class="mx-3">
                        <table class="table table-striped table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Kode Barang</th>
                                    <th>Stok Awal</th>
                                    <th>Pembelian (IN)</th>
                                    <th>Penjualan (OUT)</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tfoot class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Kode Barang</th>
                                    <th>Stok Awal</th>
                                    <th>Pembelian (IN)</th>
                                    <th>Penjualan (OUT)</th>
                                    <th>Qty</th>
                                </tr>
                            </tfoot>
                            <tbody class="text-center">
                                <?php $no = 1; ?>
                                @foreach ($data['barang'] as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->saldo_awal }}</td>
                                        <td>{{ $item->pembelian }}</td>
                                        <td>{{ $item->penjualan }}</td>
                                        <td>{{ $item->qty }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- <div class="d-sm-flex align-items-center justify-content-between my-2 ">
                        <h1 class="h3 mb-0 text-gray-800">SUM Group</h1>
                    </div>

                    <div class="mx-3">
                        <table class="table table-striped table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tfoot class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Qty</th>
                                </tr>
                            </tfoot>
                            <tbody class="text-center">
                                <?php $no = 1; ?>
                                @foreach ($data['sumGroup'] as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> --}}
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
