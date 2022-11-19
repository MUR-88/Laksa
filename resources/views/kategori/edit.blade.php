@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" action="{{ route('post.kategori.edit') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $kategori->id }}">
                <div class="mb-5">
                    <label class="form-label">Nama Kategori</label>
                    <input value="{{ $kategori->nama }}" type="text" class="form-control form-control-solid" name="nama" required>
                </div>
                <div class="mb-5">
                    <label class="form-label">Icon</label>
                    <input type="file" class="form-control form-control-solid" name="icon">
                    <small>Kosongkan jika tidak ingin diubah yaaa</small>
                </div>
                <div class="mb-5">
                    <label class="form-label">Icon Active</label>
                    <input type="file" class="form-control form-control-solid" name="icon_active">
                    <small>Kosongkan jika tidak ingin diubah yaaa</small>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
    </div>
@endsection