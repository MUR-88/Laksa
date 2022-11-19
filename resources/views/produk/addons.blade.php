@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('post.produk.addons') }}">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="" class="form-label">Addons</label>
                            <select class="form-control form-control" name="addons_id" required>
                                <option value="">Pilih</option>
                                @foreach($addons as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="" class="form-label">Harga</label>
                            <input type="number" class="form-control" required name="harga" placeholder="isi harga..">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" class="form-control" required name="nama" placeholder="isi nama..">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label text-transparent d-block">.</label>
                            <button class="btn btn-success" type="submit">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
            <hr>
            @foreach($data_addons as $item)
                <p class="fw-bold h2 mb-4">{{ $item->nama }}</p>
                @foreach($item->produkAddons->where('produk_id', $produk->id) as $produkAddons)
                    <form method="POST" action="{{ route('post.produk.addons.edit') }}">
                        @csrf
                        <input type="hidden" name="produk_addons_id" value="{{ $produkAddons->id }}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">Harga</label>
                                    <input type="number" value={{ $produkAddons->harga }} class="form-control" required name="harga" placeholder="isi harga..">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nama</label>
                                    <input type="text" value="{{ $produkAddons->nama }}" class="form-control" required name="nama" placeholder="isi nama..">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label text-transparent d-block">.</label>
                                    <button class="btn btn-primary" type="submit">Edit</button>
                                    <button class="btn btn-danger btn-hapus" data-produk_addons_id="{{ $produkAddons->id }}">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection

@section('script')
<script>
    $(".btn-hapus").click(function(e){
        e.preventDefault();

        const id = $(this).data('produk_addons_id')

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = '{{ route("produk.addons.hapus") }}?produk_addons_id='+id                
            }
        })
    })
</script>
@endsection