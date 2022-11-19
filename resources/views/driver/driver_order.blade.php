@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" action="{{ route('post.driver_order.tambah') }}">
                @csrf
                <div class="mb-5">
                    <label class="form-label">Driver </label>
                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" name="driver_id" nullable>
                        <option></option>
                        @foreach($driver_order as $item)
                            <option value="{{ $item->id }}">ID = {{$item->id}} ; {{$item->no_hp}} ; {{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div> 
                <div class="mb-5">
                    <label class="form-label">Invoice </label>
                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" name="invoice_id" nullable>
                        <option></option>
                        @foreach($invoice as $item)
                            <option value="{{ $item->id }}">ID = {{$item->id}} ; {{$item->no_hp}} ; {{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div> 
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
    </div>
@endsection