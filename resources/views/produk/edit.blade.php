@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" action="{{ route('post.produk.edit') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $produk->id }}">
                <div class="mb-5">
                  <label class="form-label">Nama Produk</label>
                  <input value="{{ $produk->nama }}" type="text" class="form-control form-control-solid" name="nama" required>
                </div>
                <div class="mb-5">
                  <label class="form-label">Harga</label>
                  <input value="{{ $produk->harga }}" type="text" class="form-control form-control-solid" name="harga" required>
                </div>
                <div class="mb-10">
                  <label class="form-label">Kategori</label>
                    <select name="kategori_id" required class="mb-5 form-control form-control-solid">
                      <option value="">Pilih</option>
                      @foreach($kategori as $item)
                        <option value="{{ $item->id }}" @if($item->id == $produk->kategori_id) selected @endif>{{ $item->nama }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label class="mb-5 form-label">Deskripsi</label>
                    <textarea class="form-control form-control-solid" name="deskripsi" required rows="5"><?= $produk->deskripsi ?></textarea>
                </div>
                <div class=" mb-5 form-check form-check-custom form-check-solid">
                    <input @if($produk->is_available == 1) checked @endif class="form-check-input" type="checkbox"  id="flexCheckDefault" name="is_available"/>
                    <label class="form-check-label" for="flexCheckDefault">
                      Tersedia
                    </label>
                </div>
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
          </form>
    </div>
@endsection
