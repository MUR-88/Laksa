@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" action="{{ route('post.kategori.tambah') }}">
                @csrf
                <div class="mb-5">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control form-control-solid" name="nama" required>
                </div>
                <div class="mb-5">
                    <label class="form-label">Icon</label>
                    <input type="file" class="form-control form-control-solid" name="icon" required>
                </div>
                <div class="mb-5">
                    <label class="form-label">Icon</label>
                    <input type="file" class="form-control form-control-solid" name="icon_active"  required>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
    </div>
@endsection