@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" action="{{ route('post.driver_order.edit') }}">
                @csrf
                {{-- <input type="hidden" name="id" value="{{ $invoice->id }}"> --}}
                <div class="mb-5">
                    <label class="form-label">Driver </label>
                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" name="driver_id" required>
                        <option></option>
                        @foreach($driver as $item)
                            <option value="{{ $item->id }}"@if($item->id == $driver_selected->id) selected @endif>ID = {{$item->id}} ; {{$item->no_hp}} ; {{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div> 
                <div class="mb-5">
                    <label class="form-label">Invoice </label>
                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" name="invoice_id" required>
                        <option></option>
                        @foreach($invoice as $item)
                            <option value="{{ $item->id }}" @if($item->id == $invoice_selected->id) selected @endif>ID = {{$item->id}} ; {{$item->user->no_hp}} ; {{ $item->user->nama }}</option>
                        @endforeach
                    </select>
                </div> 
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
    </div>
@endsection