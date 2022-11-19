@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" action="{{ route('post.notifikasi.tambah') }}">
                @csrf
                <div class="mb-5">
                    <label class="form-label">Nama User</label>
                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" name="user_id" >
                        <option></option>
                        @foreach($user as $item)
                            <option value="{{ $item->id }}">{{$item->no_hp}} {{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control form-control-solid" name="judul" required>
                </div>
                <div class="mb-5">
                    <label class="form-label">Keterangan</label>
                    <input type="text" class="form-control form-control-solid" name="isi" required>
                </div>
                <div class="mb-5">
                    <label class="form-label">Schedule</label>
                    <input type="datetime-local" class="form-control form-control-solid" name="scheduled_at" >
                </div>
                <div class="mb-5">
                    <label class="form-label">Foto</label>
                    <input type="file" class="form-control form-control-solid" name="foto"  >
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
    </div>
@endsection