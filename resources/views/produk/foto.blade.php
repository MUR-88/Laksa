@extends  ('layout')
@section ('content')
 <div class='card'>
    <div class='card-body'>
      <div class="d-flex flex-start mt-4">
        @foreach($produk->produkFoto as $produk_foto)
        <form method="POST" action="{{route('post.produk.foto.hapus')}}">
          @csrf
          <input type="hidden" name="produk_foto_id" value="{{$produk_foto->id}}">
            <div class="position-relative me-5">
              <img src="{{$produk_foto->foto}}" width="150" class=""/>
              <button class="btn btn-sm btn-danger position-absolute top-0 end-0"><i class="fa fa-trash"></i></button>
            </div>
        </form>
        @endforeach
      </div>
        <form method="POST" action="{{ route('post.produk.foto.tambah') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="produk_id" value="{{ $produk->id }}">
          <div class='row mt-4'>
            <div class="col-md-4">
              <input type="file" name="foto" required>
            </div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-success">simpan</button>
            </div>
          </div>
        </form>
    </div>
 </div>
@endsection