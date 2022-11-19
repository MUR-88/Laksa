@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" action="{{ route('post.addons.tambah') }}">
                @csrf
                <div class="mb-5">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control form-control-solid" name="nama" required>
                </div>
                <div class=" mb-5 form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="is_required"/>
                    <label class="form-check-label" for="flexCheckDefault">
                        Required
                    </label>
                </div>
                <div class=" mb-5 form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="is_available"/>
                    <label class="form-check-label" for="flexCheckDefault">
                        Multiple
                    </label>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
    </div>
@endsection