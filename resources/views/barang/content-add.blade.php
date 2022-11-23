<div id="content-wrapper" class="d-flex flex-column">

    @include('layouts.navbar')
    
    <div class="container-fluid">

        <div class="col-lg-8">
            <h3 class="text-danger">Form Barang</h3>

            <form action="{{ url('/create-barang') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="kode" class="form-label">Kode</label>
                    <input type="text" class="form-control" id="kode" name="kode"
                        placeholder="Kode...">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama"
                        placeholder="Nama...">
                </div>
                <div class="mb-3">
                    <label for="saldo_awal" class="form-label">Saldo Awal</label>
                    <input type="text" class="form-control" id="saldo_awal" placeholder="Saldo awal..." name="saldo_awal">
                </div>
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <select id="lokasi" class="form-control" name="lokasi">
                        {{-- @foreach ($data['lokasi'] as $row)
                            <option value="{{ $row->id }}">{{ $row->lokasi }}</option>
                        @endforeach --}}
                        <option value="Gudang 1">Gudang 1</option>
                        <option value="Gudang 2">Gudang 2</option>
                        <option value="Gudang 3">Gudang 3</option>
                        <option value="Gudang 4">Gudang 4</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" id="gambar" placeholder="gambar..." name="gambar">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</div>
