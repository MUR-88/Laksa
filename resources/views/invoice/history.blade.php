@extends('layout')
@section('content')
  <div class="card">
    <div class="card-body">
      {{-- <a href="{{ route('invoice.tambah') }}" class="btn btn-primary mb-10"><i class="fa fa-plus"></i> Tambah</a> --}}
      <form>
        <div class="row">
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
      
      <div class="d-flex justify-content-end">
        <div class="input-group w-200px">
            <span class="input-group-text border-transparent" id="basic-addon1"><i class="fa fa-search"></i></span>
            <input type="text" class="form-control form-control-solid" name="search" placeholder="Cari sesuatu..">
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-row-bordered gy-5 gs-7 table-invoice">
          <thead>
            <tr class="fw-bold fs-6 text-gray-800">
              <th>No 1</th>
              <th>Kode</th>
              <th>status</th>
              <th>status_pembayaran </th>
              <th>status_ordered</th>
              <th>tujuan_alamat</th>
              <th>waktu_order</th>
              <th>deleted at</th>
              <th>created_at</th>
              <th>updated_at</th>
            </tr>
          </thead>
          <tbody>
            @foreach($invoice as $index => $item)
              <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->status_pembayaran }}</td>
                <td>{{ $item->status_ordered }}</td>
                <td>{{ $item->tujuan_alamat }}</td>
                <td>{{ $item->waktu_order }}</td>
                <td>{{ $item->deleted_at }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection