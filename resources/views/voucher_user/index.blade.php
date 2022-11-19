@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <a href="{{ route('voucher_user.tambah') }}" class="btn btn-primary mb-10"><i class="fa fa-plus"></i> Tambah</a>
            <div class="d-flex justify-content-end">
                <div class="input-group w-200px">
                    <span class="input-group-text border-transparent" id="basic-addon1"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control form-control-solid" name="search" placeholder="Cari sesuatu..">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table A-striped table-row-bordered gy-5 gs-7 table-voucher_user">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800">
                            <th>No</th>
                            <th>User Id</th>
                            <th>Voucher_id</th>
                            <th>Keterangan</th>
                            <th>Expired_at</th>
                            <th>Status</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th>Aksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($voucher_user as $index => $item)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $item->user->nama }} <br> {{$item->user->email}}</td>
                                <td>{{ $item->voucher->nama }}<br> {{$item->voucher->kode}}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>
                                    {{-- {{ strtotime($item->expired_at)}} --}}
                                    @if(strtotime($item->expired_at) > (strtotime(now())))
                                        @if(strtotime($item->expired_at) > (strtotime(now()) + 86400))
                                            <span class="badge bg-success">
                                                {{ \Carbon\Carbon::parse($item->expired_at)->locale('id')->diffForHumans() }}</td>
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                {{ \Carbon\Carbon::parse($item->expired_at)->locale('id')->diffForHumans() }}</td>    
                                            </span>
                                        @endif
                                    @else
                                        <span class="badge bg-primary">
                                            {{ \Carbon\Carbon::parse($item->expired_at)->locale('id')->diffForHumans() }}</td>    
                                        </span>
                                    @endif
                                    
                                <td>
                                    @if($item->status == 0 )
                                        <span class="badge bg-warning text-white">
                                            belum digunakan
                                        </span>
                                    @else
                                        <span class="badge bg-success text-white">
                                            sudah digunakan
                                        </span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('dddd, Do MM YYYY HH:mm') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->updated_at)->locale('id')->isoFormat('dddd, Do MM YYYY HH:mm') }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('voucher_user.edit', ['voucher_user_id' => $item->id]) }}">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-hapus" data-voucher_user_id="{{ $item->id }}">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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

