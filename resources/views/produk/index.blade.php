@extends('layout')
@section('content')
<div class="card">
    <div class="card-body">
        <a href="{{ route('produk.tambah') }}" class="btn btn-primary mb-10"><i class="fa fa-plus"></i> Tambah</a>
            <div class="table-responsive">
                <table id="table_produk" class="table table-striped table-row-bordered gy-5 gs-7 table-produk">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>harga</th>
                            <th>kategori</th>
                            <th>deskripsi</th>
                            <th>foto</th>
                            <th>addons</th>
                            <th>addons</th>
                            <th>Aksi</th>
                            <th>Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produk as $index => $item)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->harga }}</td>
                                <td>
                                        {{ $item->kategori?->nama }}
                                </td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>
                                    @foreach($item->produkFoto as $index => $foto)
                                    <img src="{{ $foto->foto }}" width="50" />
                                    @endforeach
                                </td>
                                <td>
                                    <ul>
                                        @foreach($item->produkAddons->take(3) as $produkAddons)
                                            <li>{{ $produkAddons->addons->nama }} - {{ $produkAddons->nama }} - Rp. {{ number_format($produkAddons->harga, 0, ',', '.') }}</li>
                                        @endforeach
                                        @if(count($item->produkAddons) > 3)
                                            <a href="#" class="texts-primary mb-10 btn-lihat-selengkapnya" data-id="{{ $item->id }}"> Lihat Selengkapnya</a>
                                        @endif
                                    </ul>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('produk.addons', ['produk_id' => $item->id]) }}">
                                        Tambah Addons
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('produk.edit', ['id' => $item->id]) }}">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('produk.foto', ['produk_id' => $item->id]) }}">
                                        Foto
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>   
<div class="modal fade" id="modalAddons" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modal-body-addons">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div> 
@endsection

@section('script')
    <script>
        $(function (){
            $('.btn-lihat-selengkapnya').on('click', function(){
                const id = $(this).data('id')
                
                $.ajax({
                    type : 'get',
                    data : {id},
                    url : "{{route('post.collaps.edit')}}",
                    success : function(data){
                        $("#modalAddons").modal('show')
                        $(".modal-body-addons").html('')
                        data.map(item => 
                            $(".modal-body-addons").append('<li>'+ item.addons.nama +' - '+ item.nama +' - '+ item.harga +'</li>')
                        )
                        console.log(data)
                    }
                })
            })
        })
    </script>
@endsection