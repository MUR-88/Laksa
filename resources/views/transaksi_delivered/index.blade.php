@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <a href="{{ route('transaksi_delivered.tambah') }}" class="btn btn-primary mb-10"><i class="fa fa-plus"></i> Tambah</a>
            <div class="d-flex justify-content-end">
                <div class="input-group w-200px">
                    <span class="input-group-text border-transparent" id="basic-addon1"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control form-control-solid" name="search" placeholder="Cari sesuatu..">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-row-bordered gy-5 gs-7 table-voucher">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User Id</th>
                            <th>Invoice Id</th>
                            <th>keterangan</th>
                            <th>Status</th>
                            <th>deleted_at</th>
                            <th>created_at</th>
                            <th>updated_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi_delivered as $index => $item)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $item->user->nama }} <br> {{$item->user->email}}</td>
                                <td>{{ $item->invoice_id }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->deleted_at }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('transaksi_delivered.edit', ['id' => $item->id]) }}">
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

