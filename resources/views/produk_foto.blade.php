@extends('layout')
@section('content')
    <div class="card bg-white px-5 py-3">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk Id</th>
                        <th>foto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produk_foto as $index => $item)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $item->produk_id }}</td>
                            <td>{{ $item->produk_foto }}</td>
                          
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection