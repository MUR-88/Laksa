@extends('layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <a href="{{ route('voucher.tambah') }}" class="btn btn-primary mb-10"><i class="fa fa-plus"></i> Tambah</a>
            <div class="d-flex justify-content-end">
                <div class="input-group w-200px">
                    <span class="input-group-text border-transparent" id="basic-addon1"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control form-control-solid" name="search" placeholder="Cari sesuatu..">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-row-bordered gy-5 gs-7 table-voucher">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Foto</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Produk</th>
                        <th>Potongan Harga</th>
                        <th>Potongan beli</th>
                        <th>Potongan Persen</th>
                        <th>Minimal Item</th>
                        <th>Minimal Beli</th>
                        <th>Maximal Potongan</th>
                        <th>Limit</th>
                        <th>Kode</th>
                        <th>Public?</th>
                        <th>Created at</th>
                        <th>Expired </th>
                        <th>Update at</th>
                        <th>Edit Voucher</th>
                        <th>Edit Voucher User</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($voucher as $index => $item)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    <img src="{{ $item->foto }}" width="50" />
                                </td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>
                                    @if($item->kategori_id)
                                     {{ $item->kategori?->nama}}
                                    @else
                                     -
                                    @endif
                                
                                </td>
                                <td>
                                    @if($item->produk_id)
                                        {{ $item->produk->nama}}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $item->potongan_harga_formatted }}</td>
                                <td>{{ $item->potongan_beli_formatted }}</td>
                                <td>{{ $item->potongan_persen }}</td>
                                <td>{{ $item->min_item }}</td>
                                <td>{{ $item->min_beli_formatted }}</td>
                                <td>{{ $item->max_potongan_formatted }}</td>
                                <td>{{ $item->limmit_formatted }}</td>
                                <td>{{ $item->kode }}</td>
                                <td>
                                    @if($item->is_public == 1)
                                        <span class="badge bg-warning text-white">
                                            Promo User tertentu
                                        </span>
                                    @else
                                        <span class="badge bg-success text-white">
                                            Promo Untuk Semua User
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $item->created_at_formatted }}</td>
                                <td>{{ \Carbon\Carbon::now()->addSeconds($item->expired_time)->locale('id')->diffForHumans() }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->updated_at)->locale('id')->isoFormat('dddd, Do MM YYYY HH:mm') }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('voucher.edit', ['id' => $item->id]) }}">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ route('voucher_user.tambah', ['id' => $item->id]) }}">
                                        Add user 
                                    </a>
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
        const table = $(".table-voucher").DataTable()

        $('input[name="search"]').on('keyup', function () {
            table.search( this.value ).draw();
        });
    </script>
@endsection
