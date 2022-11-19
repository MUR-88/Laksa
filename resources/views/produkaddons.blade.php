@extends('layout')
@section('content')
    <div class="card bg-white px-5 py-3">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk Id</th>
                        <th>Addons Id</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produkaddons as $index => $item)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $item->produk->nama }}</td>
                            <td>{{ $item->addons_id }}</td>
                            <td>{{ $item->harga }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection