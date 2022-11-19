@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" action="{{ route('post.voucher.tambah') }}">
                @csrf
                <div class="mb-5">
                    <label class="form-label">User Id </label>
                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" name="user_id" required>
                        <option></option>
                        @foreach($user as $item)
                            <option value="{{ $item->id }}">{{$item->no_hp}} {{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div> 
                
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
    </div>
@endsection
