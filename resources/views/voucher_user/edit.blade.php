@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" action="{{ route('post.voucher_user.edit') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $voucher_user->id }}">
                <div class="mb-5">
                    <label class="form-label">User Id </label>
                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" name="user_id" required>
                        <option></option>
                        @foreach($user as $item)
                            <option value="{{ $item->id }}" @if($item->id == $voucher_user->user_id) selected @endif>{{$item->nama}} No Hp ({{$item->no_hp}})</option>
                        @endforeach
                    </select>
                </div> 
                <div class="mb-5">
                    <label class="form-label">voucher id</label>
                        <select name="voucher_id" required class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" >
                            <option value="">Pilih</option>
                            @foreach($voucher as $item)
                                <option value="{{ $item->id }}" @if( $item->id == $voucher_user->voucher_id) selected @endif> {{ $item->nama }} </option>
                            @endforeach
                        </select>
                </div>
                <div class="mb-5">
                    <label class="form-label">Expired time</label>
                    <input value="{{ \Carbon\Carbon::parse($voucher_user->expired_at)->format('Y-m-d\TH:i') }}" type="datetime-local" class="form-control form-control-solid" name="expired_at" >
                </div>
                
                <button class="btn btn-danger btn-hapus" data-voucher_user_id="{{ $voucher_user->id }}">Hapus</button>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
          </form>
    </div>
@endsection

@section('script')
<script>
    $(".btn-hapus").click(function(e){
        e.preventDefault();
        
        const id = $(this).data('voucher_user_id')

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = '{{ route("voucher_user.hapus") }}?voucher_user_id='+id                
            }
        })
    })
</script>
@endsection

             
