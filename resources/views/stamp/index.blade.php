@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <a href="{{ route('stamp.tambah') }}" class="btn btn-primary mb-10"><i class="fa fa-plus"></i> Tambah</a>
            <div class="d-flex justify-content-end">
                <div class="input-group w-200px">
                    <span class="input-group-text border-transparent" id="basic-addon1"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control form-control-solid" name="search" placeholder="Cari sesuatu..">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-row-bordered gy-5 gs-7 table-stamp">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800">
                            <th>No</th>
                            <th>User Id</th>
                            <th>Inovice ID</th>
                            <th>Status</th>>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Stamp as $index => $item)
                            <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $item->user_id }}</td>
                            <td>{{ $item->invoice_id }}</td>
                            <td>{{ $item->status }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('stamp.edit', ['id' => $item->id]) }}">
                                        Edit
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
