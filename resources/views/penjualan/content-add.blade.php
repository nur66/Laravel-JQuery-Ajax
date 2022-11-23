<div id="content-wrapper" class="d-flex flex-column">

    @include('layouts.navbar')
    
    <div class="container-fluid">

        <div class="col-lg-8">
            <h3 class="text-danger">Form Penjualan</h3>

            <form action="{{ url('/create-penjualan') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nomor_nota" class="form-label">Nomor Nota</label>
                    <input type="text" class="form-control" id="nomor_nota" name="nomor_nota"
                        placeholder="Nomor nota...">
                </div>
                <div class="mb-3">
                    <label for="kode-barang" class="form-label">Kode Barang</label>
                    <select id="kode-barang" class="form-control" name="barang">
                        @foreach ($data['barang'] as $row)
                            <option value="{{ $row->id }}">{{ $row->kode }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" placeholder="date..." name="tanggal_penjualan">
                </div>
                <div class="mb-3">
                    <label for="qty" class="form-label">Qty</label>
                    <input type="number" class="form-control" id="qty" placeholder="qty..." name="qty">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</div>
