@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <a href="{{ route('driver_order.tambah') }}" class="btn btn-primary mb-10"><i class="fa fa-plus"></i> Tambah</a>
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
                            <th>Nama</th>
                            <th>No HP</th>
                            <th>Email</th>
                            <th>Nama Pembeli</th>
                            <th>Dibuat</th>
                            <th>Di Update</th>
                            <th>Aksi</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($index_driver as $index => $item)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $item->driver->nama }}</td>
                                <td>{{ $item->driver->no_hp }}</td>
                                <td>{{ $item->driver->email }}</td>
                                <td>{{ $item->user->nama }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('driver_order.edit',['driver_id' =>$item->id, 'id'=>$item->id]) }}">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <a target="_blank" class="btn btn-primary btn-sm" href={{ "https://maps.google.com/?q=". $item->latitude .",". $item->langitude }}>
                                        Alamat
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

{{-- @section('script')
    <script>
        const table = $(".table-kategori").DataTable()

        $('input[name="search"]').on('keyup', function () {
            table.search( this.value ).draw();
        });
    </script>
@endsection --}}