@extends('layout')
@section('content')
    <div class="card bg-white px-5 py-3">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User Id</th>
                        <th>Nama</th>
                        <th>No Hp </th>
                        <th>Email</th>
                        <th>foto</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profile as $index => $item)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>#{{ $item->id }}</td>
                            <td>{{ $item->nama}}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td>{{ $item->email }}</td>
                            <td><img src="{{ $item->foto }}" width="50" /></td>
                            <td>{{ $item->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection