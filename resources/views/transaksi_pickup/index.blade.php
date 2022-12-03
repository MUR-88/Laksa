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
                            <th>invoice_id</th>
                            <th>User Id</th>
                            <th>keterangan</th>
                            <th>Status</th>
                            <th>created_at</th>
                            <th>updated_at</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi_pickup as $index => $item)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>#{{ $item->id }}</td>
                                <td>{{ $item->user->nama }} <br> {{$item->user->email}}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('invoice.detail', ['id' => $item->id]) }}">
                                        Detail    
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


{{-- @extends('layout')
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
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>User Id</th>
                        <th>invoice_id</th>
                        <th>keterangan</th>
                        <th>Inovice ID</th>
                        <th>Status</th>
                        <th>langitude</th>
                        <th>latitude</th>
                        <th>deleted_at</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi_pickup as $index => $item)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $item->user_id }}</td>
                            <td>{{ $item->invoice_id }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->langitude }}</td>
                            <td>{{ $item->latitude }}</td>
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
@endsection --}}