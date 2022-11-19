@extends('layout')
@section('content')
    <div class="card bg-white px-5 py-3">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User Id</th>
                        <th>Langitude</th>
                        <th>Latitude </th>
                        <th>Keterangan</th>
                        <th>Created At</th>
                        <th>Deleted At</th>
                        <th>Updated At</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($alamat_user as $index => $item)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $item->user_id }}</td>
                            <td>{{ $item->langtitude }}</td>
                            <td>{{ $item->latitude }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->deleted_at }}</td>
                            <td>{{ $item->updated_at }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection