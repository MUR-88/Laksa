@extends('layout')
@section('content')
  <div class="card">
    <div class="card-body">
      <form>
        <div class="row mb-4">
          <div class="col-2 md-3">
            <span>Tanggal Awal</span >
            <input type="date" value="{{$tanggal_awal}}" name="tanggal_awal" class="form-control input-group w-200px" placeholder="Username">
          </div>
          <div class="col-3 md-3 ">
            <span>Tanggal Akhir</span >
            <input type="date" value="{{$tanggal_akhir}}" name="tanggal_akhir" class="form-control input-group w-200px" placeholder="Username">
          </div>
          <div class="col-3 md-3 ">
            <button class="btn btn-primary">Cari</button>
          </div>
        </div>
      </form>
      <div class="row d-flex justify-content-between">
        <a href="{{ route('invoice.tambah') }}" class="col-2 btn btn-primary mb-10"><i class="fa fa-plus"></i> Tambah</a>
        <div class="input-group w-200px">
          <span class="input-group-text border-transparent" id="basic-addon1"><i class="col-6 fa fa-search"></i></span>
          <input type="text" class="form-control form-control-solid" name="search" placeholder="Cari sesuatu..">
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-row-bordered gy-7 gs-7 table-invoice">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800">
                    <th>No</th>
                    <th>Status</th>
                    <th>Status Pembayaran </th>
                    <th>Status Order</th>
                    <th>Tujuan Alamat</th>
                    <th>Waktu Order </th>
                    <th>Dihapus</th>
                    <th>Dibuat</th>
                    <th>Diperbaharui</th>
                    <th>Edit</th>
                    <th>Pembayaran</th>
                    <th>Cancel</th>


                </tr>
            </thead>
          <tbody>
            @foreach($invoice as $index => $item)
              <tr>
                <td>{{ $index+1 }}</td>
                <td>
                  @if($item->status == 1)
                  <span class="badge bg-warning">
                    Belum Selesai
                  </span>
                  @elseif($item->status == 2)
                    <span class="badge bg-success">
                      Selesai
                    </span>
                  @elseif($item->status == 3)
                    <span class="badge bg-danger">
                      Dibatalkan
                    </span>
                  @else
                    <span class="badge bg-danger">
                      Error
                    </span>
                  @endif
                </td>
                <td>
                  @if($item->status_pembayaran == 1)
                    <span class="badge bg-warning">
                      Belum Bayar
                    </span>
                  @elseif($item->status_pembayaran == 2)
                    <span class="badge bg-success">
                      Sudah Bayar
                    </span>
                  @elseif($item->status_pembayaran == 3)
                    <span class="badge bg-danger">
                      Pembayaran gagal
                    </span>
                  @else
                    <span class="badge bg-danger">
                      Error
                    </span>
                  @endif
                </td>
                <td>
                  @if($item->status_ordered == 1)
                  <span class=" btn btn-light-primary">
                    <i class="fas fa-box-open text-black"></i>
                   
                  </span>
                @elseif($item->status_ordered == 2)
                  <span class=" btn btn-light-success">
                    <a class="fa fa-motorcycle text-black"></a>
                   
                  </span>
                @elseif($item->status_ordered == 3)
                <span class=" btn btn-light-danger">
                  <a class="fa fa-bookmark text-black"></a>
                 
                </span>
                @else
                  <span class="badge bg-danger">
                    Error
                  </span>
                @endif
                </td>
                <td>{{ $item->tujuan_alamat }}</td>
                <td>
                  {{ \Carbon\Carbon::parse($item->waktu_order)->locale('id')->isoFormat('dddd, Do MMM YYYY HH:mm') }}
                </td>
                <td>{{ $item->deleted_at }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
                <td>
                  <a class="btn btn-primary btn-sm" href="{{ route('invoice.edit', ['id' => $item->id]) }}">
                    Edit
                  </a>
                </td><td>
                  <a class="btn btn-success btn-sm d-flex justify-content-center btn-bayar" data-invoice_bayar_id="{{ $item->id }}">
                    Bayar
                  </a>
                </td>
                <td>
                  <button class="btn btn-danger btn-hapus" data-invoice_batal_id="{{ $item->id }}">Batal</button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script>
    $(".btn-bayar").click(function(e){
        e.preventDefault();
        
        const id = $(this).data('invoice_bayar_id')

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Sudah Bayar!'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = '{{ route("invoice.bayar") }}?id='+id                
            }
        })
    })
</script>
<script>
  $(".btn-hapus").click(function(e){
      e.preventDefault();
      
      const id = $(this).data('invoice_batal_id')

      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, cancel it!'
      }).then((result) => {
          if (result.isConfirmed) {
              location.href = '{{ route("invoice.batal") }}?id='+id                
          }
      })
  })
</script>
@endsection