@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" action="{{ route('post.produk.tambah') }}">
                @csrf
                <div class="mb-5">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" class="form-control form-control-solid" name="nama" required>
                </div>
                <div class="mb-5">
                    <label class="form-label">Harga </label>
                    <input type="integer" class="form-control form-control-solid" name="harga" required>
                </div>
                <div class="mb-5">
                    <label class="form-label">Kategori</label>
                    <select name="kategori_id" required class="form-control form-control-solid">
                        <option value="">Pilih</option>
                        @foreach($kategori as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control form-control-solid" name="deskripsi"   rows="5"></textarea>
                </div>
                <div class=" mb-5 form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="is_available"/>
                    <label class="form-check-label" for="flexCheckDefault">
                        Tersedia
                    </label>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
    </div>
@endsection