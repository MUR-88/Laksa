@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" action="{{ route('post.driver.tambah') }}">
                @csrf
                <div class="mb-5">
                    <label class="form-label">Nama Driver</label>
                    <input type="text" class="form-control form-control-solid" name="nama" required>
                </div>
                <div class="mb-5">
                    <label class="form-label">No HP</label>
                    <input type="text" class="form-control form-control-solid" name="no_hp" required>
                </div>
                <div class="mb-5">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control form-control-solid" name="email" required>
                </div>
                <div class="mb-5">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control form-control-solid" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
    </div>
@endsection