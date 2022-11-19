@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" action="{{ route('post.driver.edit') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $driver->id }}">
                <div class="mb-5">
                    <label class="form-label">Nama Driver</label>
                    <input value="{{ $driver->nama }}" type="text" class="form-control form-control-solid" name="nama" required>
                </div>
                <div class="mb-5">
                    <label class="form-label">No HP</label>
                    <input value="{{ $driver->no_hp }}" type="text" class="form-control form-control-solid" name="no_hp" nullable>

                </div>
                <div class="mb-5">
                    <label class="form-label">Email</label>
                    <input value="{{ $driver->email }}" type="text" class="form-control form-control-solid" name="email" nullable>

                </div>
                <div class="mb-5">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control form-control-solid" name="password" nullable>

                    <small>Kosongkan jika tidak ingin diubah yaaa</small>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
    </div>
@endsection