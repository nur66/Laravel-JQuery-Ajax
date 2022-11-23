<div id="content-wrapper" class="d-flex flex-column">

    @include('layouts.navbar')
    
    <div class="container-fluid">

        <div class="col-lg-8">
            <h3 class="text-danger">Form Penjualan</h3>

            <form action="{{ url('/update-penjualan') }}" method="post" enctype="multipart/form-data">
                @csrf
                @foreach($data['penjualan'] as $item)
                <input type="hidden" name="id" value="{{ $item->id }}">
                <div class="mb-3">
                    <label for="nomor_nota" class="form-label">Nomor Nota</label>
                    <input type="text" class="form-control" id="nomor_nota" name="nomor_nota"
                        placeholder="Nomor nota..." value="{{ $item->nomor_nota }}">
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
                    <input type="date" class="form-control" id="date" placeholder="date..." name="tanggal_penjualan" value="{{ $item->tanggal_pembelian }}">
                </div>
                <div class="mb-3">
                    <label for="qty" class="form-label">Qty</label>
                    <input type="number" class="form-control" id="qty" placeholder="qty..." name="qty" value="{{ $item->qty }}">
                </div>
                @endforeach

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</div>
