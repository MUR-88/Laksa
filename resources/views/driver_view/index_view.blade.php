@extends('driver_view/index')
@section('content')
@if(count($invoice)>0)
  @foreach($invoice as $item)
    <div id="kt_app_content" class="app-content flex-column-fluid-sm bg-success mb-10">
      <div >
        <div class="card">
          <div class="card-body px-10">
            <div class="row">
              <div class="col-md-12">
                <div class="flex mb-10">
                  <div class="mt-n1">
                    <div class="d-flex flex-stack pb-10">
                      <a >
                        <img alt="Logo" src="/metronic8/demo1/assets/media/svg/brand-logos/code-lab.svg" />
                      </a>
                      <a  class="btn btn-sm btn-success btn-antar" data-id="{{$item->id}}">Sampai ditujuan</a>
                      {{-- tombol mengganti satuts pengantaran --}}
                    </div>
                    <div class="m-0">
                      <div class="fw-bold fs-3 text-gray-800 mb-8">Invoice ID #{{$item->id}}</div>
                      <div class="row g-5 mb-11">
                        <div class="col-sm-6">
                          <div class="fw-semibold fs-7 text-gray-600 mb-1 badge bg-warning text-dark">Sesi Pengantarn</div>
                          <div class="fw-bold fs-6 text-gray-800 ms-2">{{$item->waktu_order_formatted}}</div>
                        </div>
                        <div class="col-sm-6">
                          <div class="fw-semibold fs-7 badge bg-primary text-dark mb-1">Batas Waktu Pengantaran:</div>
                          <div class="fw-bold fs-6 text-gray-800 d-flex align-items-center flex-wrap ms-2">
                            <span class="pe-2">{{$item->waktu_order_formatted}}</span>
                          </div>
                        </div>
                      </div>
                      <div class="row g-5 mb-12">
                        <div class="col-sm-6">
                          <div class="fw-semibold fs-7 text-whtie-600 mb-1 badge bg-primary">Nama Pemesan:</div>
                          <div class="fw-bold fs-6 text-gray-800 ms-2">{{$item->user->nama}}</div>
                          <div class="fw-semibold fs-7 text-gray-600 mt-2 ms-2"> Pastikan kembali pesanan dan Nama pesanan sama </div>
                        </div>
                        <div class="col-sm-6 ">
                          <div class="badge bg-info fw-semibold fs-7 text-white-600 mb-1 ">Alamat :</div>
                          <div class="fw-bold fs-6 text-gray-800 ms-2">
                            <a target="_blank" class="btn btn-secondary btn-sm mt-5" href={{ "https://maps.google.com/?q=". $item->latitude .",". $item->langitude }}>
                              Klik Disini
                            <i class="fas fa-chevron-circle-right"></i>
                            </a>
                          </div>
                          
                        </div>
                      </div>
                      <button class="col-12 btn btn-secondary btn-sm text-black-600">
                        <a class="fas fa-chevron-circle-down text-black" data-bs-toggle="collapse" href="#invoice_{{$item->id}}" role="button" aria-expanded="false" aria-controls="invoice_{{$item->id}}">
                        </a>
                        lihat Selengkapnya
                      </button>
                      <div class="collapse" id="invoice_{{$item->id}}">
                        <div class="flex-grow-1">
                          <div class="table-responsive border-bottom mb-9">
                            <table class="table mb-3">
                              <thead>
                                <tr class="border-bottom fs-6 fw-bold text-muted">
                                  <th class="min-w-175px pb-2">Nama Produk</th>
                                  <th class="min-w-70px text-end pb-2">Jumlah</th>
                                  <th class="min-w-80px text-end pb-2">Harga</th>
                                  <th class="min-w-100px text-end pb-2">Total </th>
                                </tr>
                              </thead>
                              <tbody>
                                @php
                                  $subtotal = 0;
                                  $total = 0;
                                  // $fee = 1000;  
                                  $ongkir = 0; 
                                @endphp
                                @foreach($item->invoiceDetail as $item)
                                  @php
                                    $subtotal += ($item->harga * $item->jumlah);
                                    // $total = $subtotal ;
                                  @endphp
                                  <tr class="fw-bold text-gray-700 fs-5 text-end ms-2">
                                    <td class="d-flex align-items-center pt-6">
                                      <i class="fa fa-genderless text-danger fs-2 me-2"></i>
                                        {{$item->produk->nama}}
                                        @foreach($item->invoiceDetailAddons->filter(fn($item) => $item->harga > 0) as $invoiceDetailAddons)
                                        <div class="fw-light ml-3"> {{ $invoiceDetailAddons->produkAddons->nama }}</div>
                                      @endforeach
                                      {{-- <span class="fa fa-genderless text-danger fs-2 me-2">{{$item->invoice}}</span> --}}
                                    </td>
                                    <td class="pt-6">
                                        {{$item->jumlah}}
                                    </td>
                                    <td class="pt-6">{{$item->harga_with_addons_formatted}}</td>
                                    <td class="pt-6 text-dark fw-bolder">{{$item->subtotal_formatted}}</td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                          <div class="d-flex justify-content-end mb-3z">
                            <div class="mw-300px">
                              <div class="d-flex flex-stack mb-3">
                                <div class="fw-semibold pe-10 text-gray-600 fs-7">Subtotal:</div>
                                <div class="text-end fw-bold fs-6 text-gray-800">Rp. {{$subtotal}}</div>
                              </div>
                              <div class="d-flex flex-stack mb-3">
                                <div class="fw-semibold pe-10 text-gray-600 fs-7">Ongkir</div>
                                <div class="text-end fw-bold fs-6 text-gray-800">{{$item->invoice->ongkir_formatted}}</div>
                              </div>
                              {{-- <div class="d-flex flex-stack mb-3">
                                <div class="fw-semibold pe-10 text-gray-600 fs-7">Fee</div>
                                <div class="text-end fw-bold fs-6 text-gray-800">Rp. {{$fee}}</div>
                              </div> --}}
                              <div class="d-flex flex-stack">
                                <div class="fw-semibold pe-10 text-gray-600 fs-7">Total</div>
                                <div class="text-end fw-bold fs-6 text-gray-800">{{$item->invoice->total_formatted}}</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endforeach
@else
  <div>
    <a>
      <img  src="/assets/images/lost_signal.png" />
      Tidak ada Transaksi
    </a>
  </div>
@endif

@endsection

@section('script')
<script>
    $(".btn-antar").click(function(e){
        e.preventDefault();
        
        const id = $(this).data('id')

        Swal.fire({
            title: 'Sudah Yakin?',
            text: "Kamu tidak bisa melihat pesanan ini lagi",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delivered it!'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = '{{ route("driver_antar") }}?id='+id                
            }
        })
    })
</script>
@endsection