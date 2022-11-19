@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" action="{{ route('post.voucher.tambah') }}">
                @csrf
                <div class="mb-5">
                    <label class="form-label">Nama </label>
                    <input type="text" class="form-control form-control-solid" name="nama" required>
                </div>
                <div class="mb-5">
                    <label class="form-label">Foto</label>
                    <input type="file" class="form-control form-control-solid" name="foto" required>
                </div>
                <div class="mb-5">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control form-control-solid" name="deskripsi" required rows="5"></textarea>
                </div>
                <div class="mb-5">
                    <label class="form-label">Potongan harga <span class="badge badge-circle badge-primary"><i class="fa fa-info text-white"></i></span> </label>
                    <input type="text" class="form-control form-control-solid" name="potongan_harga" nullable>
                </div>
                <div class="mb-5">
                    <label class="form-label">Potongan Beli </label>
                    <input type="text" class="form-control form-control-solid" name="potongan_beli" nullable>
                </div>
                <div class="mb-5">
                    <label class="form-label">Potongan Persen </label>
                    <input type="text" class="form-control form-control-solid" name="potongan_persen" nullable>
                </div>
                <div class="mb-5">
                    <label class="form-label">Minimal Item </label>
                    <input type="text" class="form-control form-control-solid" name="min_item" nullable>
                </div>
                <div class="mb-5">
                    <label class="form-label">Minimal Beli </label>
                    <input type="text" class="form-control form-control-solid" name="min_beli" nullable>
                </div>
                <div class="mb-5">
                    <label class="form-label">Maximal potongan </label>
                    <input type="text" class="form-control form-control-solid" name="max_potongan" nullable>
                </div>
                <div class="mb-5">
                    <label class="form-label">Limit </label>
                    <input type="text" class="form-control form-control-solid" name="limmit" nullable>
                </div>
                <div class="mb-5">
                    <label class="form-label">Kode </label>
                    <input type="text" class="form-control form-control-solid" name="kode" nullable>
                </div>
                <div class="mb-5">
                    <label class="form-label">Potongnan Ongkir </label>
                    <input type="text" class="form-control form-control-solid" name="potongan_ongkir" nullable>
                </div>
                <div class="mb-5">
                    <label class="form-label">Expired Time </label>
                    <input type="text" class="form-control form-control-solid" name="expired_time" nullable>
                </div>
                <div class="mb-5">
                    <label class="form-label">Kategori </label>
                    <select id="kategori" class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" name="kategori_id" required>
                        <option></option>
                        @foreach($kategori as $item)
                            <option value="{{ $item->id }}">{{$item->nama}}</option>
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
                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="is_public"/>
                    <label class="form-check-label" for="flexCheckDefault">
                        Public
                    </label>
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

@section('script')
    <script>
        $(function (){
            $('select[name="kategori_id"]').on('change', function(){
                let item = $(this).val();
                
            $.ajax({
                type : 'Get',
                url : "{{route('selectProduk.tambah')}}",
                data : {kategori_id:item},
                success : function(data){
                    console.log(data)
                    $('.produk').html('')
                    $('.produk').append('<option value="" > Pilih </option>')
                    data.map(item=> 
                        $('.produk').append('<option value="'+item.id+'">'+item.nama+'</option>')
                    )
                }
            })
        })})
    </script>

@endsection