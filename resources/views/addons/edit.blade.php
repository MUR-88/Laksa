@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" action="{{ route('post.addons.edit') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $addons->id }}">
                <div class="mb-5">
                    <label class="form-label">Nama addons</label>
                    <input value="{{ $addons->nama }}" type="text" class="form-control form-control-solid" name="nama" nullable>
                </div>
                <div class=" mb-5 form-check form-check-custom form-check-solid">
                    <input @if($addons->is_multiple == 1) checked @endif class="form-check-input" type="checkbox"  id="flexCheckDefault" name="is_multiple"/>
                    <label class="form-check-label" for="flexCheckDefault">
                      Multiple?
                    </label>
                </div>
                <div class=" mb-5 form-check form-check-custom form-check-solid">
                    <input @if($addons->is_required == 1) checked @endif class="form-check-input" type="checkbox"  id="flexCheckDefault" name="is_required"/>
                    <label class="form-check-label" for="flexCheckDefault">
                      Tersedia
                    </label>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
    </div>
@endsection
