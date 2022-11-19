@extends('layout')
@section('content')
    <div class="card bg-white px-5 py-3">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User Id</th>
                        <th>Jumlah Tamu</th>
                        <th>invoice_id</th>
                        <th>keterangan</th>
                        <th>Inovice ID</th>
                        <th>Status</th>
                        <th>deleted_at</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi_reservasi as $index => $item)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $item->user_id }}</td>
                            <td>{{ $item->jlmh_orang }}</td>
                            <td>{{ $item->latitude }}</td>
                            <td>{{ $item->invoice_id }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->deleted_at }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection