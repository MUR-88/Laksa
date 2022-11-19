@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" action="{{ route('post.stamp.tambah') }}">
                @csrf
                <div class="mb-5">
                    <input type='text' class='form-control form-control-solid' required name='kode'>
                </div>
                <div class="mb-5">
                    <label class="form-label">Produk </label>
                    <select class="form-select form-select-solid" data-placeholder="Select an option" name="produk_id" required>
                        <option></option>
                        @foreach($produk as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div> 
                
                
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
       let code = "";
            let reading = false;

            document.addEventListener('keypress', e => {
                //usually scanners throw an 'Enter' key at the end of read
                if (e.keyCode === 13) {
                    if(code.length > 10 && code.includes('LaksaPoint:')) {
                        console.log(code.substr(11));
                        $("input[name='kode']").val(code.substr(11))
                        code = "";
                    }
                } else {
                    code += e.key; //while this is not an 'enter' it stores the every key            
                }
            });
    </script>
@endsection
