@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" action="{{ route('post.voucher.edit') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $voucher->id }}">
                <div class="mb-5">
                  <label class="form-label">Nama</label>
                  <input value="{{ $voucher->nama }}" type="text" class="form-control form-control-solid" name="nama" >
                </div>
                <div class="mb-5">
                    <label class="form-label">Foto</label>
                    <input type="file" class="form-control form-control-solid" nullable name="foto">
                    <small>Kosongkan jika tidak ingin diubah yaaa</small>
                </div>
                <div class="mb-5">
                    <label class="mb-5 form-label">Deskripsi</label>
                    <textarea class="form-control form-control-solid" name="deskripsi"  rows="5"><?= $voucher->deskripsi ?></textarea>
                </div>
                <div class="mb-5">
                    <label class="form-label">Potongan Harga</label>
                    <input value="{{ $voucher->potongan_harga }}" type="text" class="form-control form-control-solid" name="potongan_harga" >
                </div>
                <div class="mb-5">
                    <label class="form-label">Minimal Item</label>
                    <input value="{{ $voucher->min_item }}" type="text" class="form-control form-control-solid" name="min_item" >
                </div>
                <div class="mb-5">
                    <label class="form-label">Minimal Beli</label>
                    <input value="{{ $voucher->min_beli }}" type="text" class="form-control form-control-solid" name="min_beli" >
                </div>
                <div class="mb-5">
                    <label class="form-label">Maximal Potongan </label>
                    <input value="{{ $voucher->max_potongan }}" type="text" class="form-control form-control-solid" name="max_potongan" >
                </div>
                <div class="mb-5">
                    <label class="form-label">Expired time</label>
                    <input value="{{ $voucher->expired_time }}" type="text" class="form-control form-control-solid" name="expired_time" >
                </div>
                <div class="mb-5">
                    <label class="form-label">Potongan Beli</label>
                    <input value="{{ $voucher->potongan_beli }}" type="text" class="form-control form-control-solid" name="potongan_beli" >
                </div>
                <div class="mb-5">
                    <label class="form-label">Limit</label>
                    <input value="{{ $voucher->limmit }}" type="text" class="form-control form-control-solid" name="limmit" >
                </div>
                <div class="mb-5">
                    <label class="form-label">Kode</label>
                    <input value="{{ $voucher->kode }}" type="text" class="form-control form-control-solid" name="kode" >
                </div>
                <div class="mb-5">
                    <label class="form-label">Kategori </label>
                    <select id="kategori" class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" name="kategori_id" required>
                        <option></option>
                        @foreach($kategori as $item)
                            <option value="{{ $item->id }}" @if($item->id == $voucher->kategori_id) selected @endif>{{$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label class="form-label">Produk </label>
                    <select id="" class="form-select form-select-solid produk" data-control="" data-placeholder="Select an option" name="produk_id" >
                        <option></option>
                        
                    </select>
                </div>
                <div class=" mb-5 form-check form-check-custom form-check-solid">
                    <input @if($voucher->is_public == 1) checked @endif class="form-check-input" type="checkbox"  id="flexCheckDefault" name="is_public"/>
                    <label class="form-check-label" for="flexCheckDefault">
                      Public?
                    </label>
                </div>
                <div class=" mb-5 form-check form-check-custom form-check-solid">
                    <input @if($voucher->is_available == 1) checked @endif class="form-check-input" type="checkbox"  id="flexCheckDefault" name="is_available"/>
                    <label class="form-check-label" for="flexCheckDefault">
                      Tersedia
                    </label>
                </div>
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
          </form>
    </div>
@endsection

@section('script')
    <script>
        $( document ).ready(function() {
            $('select[name="kategori_id"]').trigger('change')
            console.log( "ready!" );
        });
        const produk_id = @js($voucher->produk_id);
        console.log(produk_id);
        $('select[name="kategori_id"]').change(function(){
            let item = $(this).val();
                
            $.ajax({
                type : 'Get',
                url : "{{route('selectProduk.tambah')}}",
                data : {kategori_id:item},
                success : function(data){
                    console.log(data)
                    $('.produk').html('')
                    $('.produk').append('<option value="">Pilih</option>')
                    data.map(item=> {
                        if(item.id == produk_id){
                            return $('.produk').append('<option selected value="'+item.id+'">'+item.nama+'</option>')
                        } else {
                            return $('.produk').append('<option value="'+item.id+'">'+item.nama+'</option>')
                        }
                    })
                }
            })
        })
    </script>

@endsection               
