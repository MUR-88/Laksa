@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <form>
                <div class="row">
                  <div class="col-2 md-3">
                    <span>Tanggal Awal</span >
                    <input type="date" value="{{$tanggal_awal}}" name="tanggal_awal" class="form-control input-group w-200px" placeholder="Username">
                  </div>
                  <div class="col-2 md-1 ">
                    <span>Tanggal Akhir</span >
                    <input type="date" value="{{$tanggal_akhir}}" name="tanggal_akhir" class="form-control input-group w-200px" placeholder="Username">
                  </div>
                  <div class="col-1 md-1 d-flex justify-content-end align-items-center">
                    <button class="btn btn-primary">Cari</button>
                  </div>
                </div>
              </form>
            <a href="{{ route('notifikasi.tambah') }}" class="btn btn-primary  mt-5"><i class="fa fa-plus"></i> Tambah</a>
            <div class="d-flex justify-content-end">
                <div class="input-group w-200px">
                    <span class="input-group-text border-transparent" id="basic-addon1"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control form-control-solid" name="search" placeholder="Cari sesuatu..">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-row-bordered gy-5 gs-7 table-kategori">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800">
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Invoice Id</th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th>Admin</th>
                            <th>Driver</th>
                            <th>Scheduled</th>
                            <th>Suara Notifikasi</th>
                            <th>Foto</th>
                            <th>Dibuat</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notifikasi as $index => $item)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                @if($item->user)
                                    <td>{{ $item->user->nama }}</td>
                                @else
                                    <td></td>
                                @endif

                                @if($item->invoice)
                                 <td>{{ $item->invoice->id }}</td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->isi }}</td>
                                <td>{{ $item->is_admin }}</td>
                                @if($item->invoice)
                                <td>{{ $item->driver_id, $item->driver->nama }}</td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{ $item->scheduled_at }}</td>
                                <td>{{ $item->is_with_sound }}</td>
                                <td><img src="{{ $item->foto }}" width="50" /></td>
                                <td>{{ $item->created_at }}</td>
                                
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
        const table = $(".table-kategori").DataTable()

        $('input[name="search"]').on('keyup', function () {
            table.search( this.value ).draw();
        });
    </script>
@endsection