@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <a href="{{ route('addons.tambah') }}" class="btn btn-primary mb-10"><i class="fa fa-plus"></i> Tambah</a>
            <div class="d-flex justify-content-end">
                <div class="input-group w-200px">
                    <span class="input-group-text border-transparent" id="basic-addon1"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control form-control-solid" name="search" placeholder="Cari sesuatu..">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-row-bordered gy-5 gs-7 table-kategori">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama</th>
                            <th>Required</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($addons as $index => $item)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    @if($item->is_required )
                                    Iya
                                    @else
                                    Tidak
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('addons.edit', ['id' => $item->id]) }}">
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