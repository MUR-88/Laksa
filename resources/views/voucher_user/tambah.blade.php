@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" action="{{ route('post.voucher_user.tambah') }}">
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
                <div class="mb-5">
                    <label class="form-label">voucher id</label>
                    {{-- @if($voucher_selected)
                        <p>{{$voucher_selected->nama}}</p>
                        <input type="hidden" name="voucher_id" value="{{$voucher_selected->id}}"/>
                    @else --}}
                        <select name="voucher_id" required class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" >
                            <option value="">Pilih</option>
                            @foreach($voucher as $item)
                                <option @if($voucher_selected && $voucher_selected->id == $item->id) selected @endif value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    {{-- @endif --}}
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
<script>
    // In your Javascript (external .js resource or <script> tag)
    
</script>
@endsection