<div id="content-wrapper" class="d-flex flex-column">

    @include('layouts.navbar')
    
    <div class="container-fluid">

        <div class="col-lg-8">
            <h3 class="text-danger">Form Lokasi</h3>

            <form action="{{ url('/create-lokasi') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" class="form-control" id="lokasi" name="lokasi"
                        placeholder="Lokasi...">
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" id="gambar" name="gambar">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</div>
