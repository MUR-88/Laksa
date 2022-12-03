@extends('layout')
@section('content')
  <div class="card">
    <div class="card-body">
      <div class="mx-auto container h-100 py-10 px-10" style="max-width: 512px">
        <div class="bg-white">
          <div id="kt_app_content" class="app-content flex-column-fluid-sm bg-success mb-10">
            <div >
              <div class="card">
                <div class="card-body px-10">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <p class="col-6 d-flex justify-content-start">Nomor Invoice</p>
                          {{-- <div class="col-6 d-flex justify-content-end">
                            @if(!$invoice->gagal_at && $invoice->status == 1)
                              <button class="btn btn-danger btn-hapus" data-invoice_batal_id="{{ $invoice->id }}">Batal</button>
                            @endif
                          </div> --}}
                      </div>
                      <h1 class="mt-4">#{{$invoice->id}}</h1>
                      <div class="row">
                        <div class="col-6">Status</div>
                        <div class="col-6 d-flex justify-content-end">
                          @if($invoice->status_ordered == 1 ) 
                            <div class="badge bg-light text-dark">Pickup</div> 
                          @elseif($invoice->status_ordered == 2)
                            <div class="badge bg-light text-dark">Delivery</div> 
                          @elseif($invoice->status_ordered == 3)
                            <div class="badge bg-light text-dark">Reservasi</div> 
                          @endif
                        </div>
                      </div>
                      <div class="row mt-4">
                        <div class="col-2 fw-semibold fs-7 text-whtie-600 d-flex justify-content-start">Nama </div>
                        <div class="col-10 d-flex justify-content-end">{{$invoice->user->nama}}</div>
                      </div>
                      <div class="row mt-4">
                        <div class="col-3 fw-semibold fs-7 text-whtie-600 d-flex justify-content-start">Nomor Hp </div>
                        <div class="col-9 d-flex justify-content-end">{{$invoice->user->no_hp}}</div>
                      </div>
                      @if($invoice->status_ordered == 2)
                        <div class="row mt-4">
                          <div class="col-2 fw-semibold fs-7 text-whtie-600 d-flex justify-content-start">Alamat </div>
                          <div class="col-10 d-flex justify-content-end">{{$invoice->tujuan_alamat ? $invoice->tujuan_alamat : '-'}} , {{$invoice->alamatUser->jarak}} Km</div>
                        </div>
                      @endif
                      <div class="row mt-4">
                        <div class="col-2 fw-semibold fs-7 text-whtie-600 d-flex justify-content-start"> Catatan </div>
                        <div class="col-10 d-flex justify-content-end">{{$invoice->catatan ? $invoice->catatan : '-'}}</div>
                      </div>
                      <div class="row mt-4">
                        <div class="col-4 fw-semibold fs-7 text-whtie-600 d-flex justify-content-start"> Status Pembayaran </div>
                        <div class="col-8 d-flex justify-content-end">
                          <div>
                            @if($invoice->status_pembayaran == 1)
                              <div class="badge bg-warning text-dark">Belum Bayar</div> 
                            @elseif($invoice->status_pembayaran == 2)
                             <div class="badge bg-success text-dark">Sudah Bayar</div> 
                            @elseif($invoice->status_pembayaran == 3)
                             <div class="badge bg-danger text-dark">Pembayaran gagal</div> 
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row mt-4">
                        <div class="col-3 fw-semibold fs-7 text-white-600 d-flex justify-content-start">Waktu Order </div>
                        <div class="col-9 d-flex justify-content-end">{{$invoice->waktu_order_formatted}}</div>
                      </div>
                      <div class="row mt-4 mb-4">
                        <div class="col-3 fw-semibold fs-7 text-white-600 d-flex justify-content-start">Alamat </div>
                        <div class="col-9 d-flex justify-content-end">
                          <a target="_blank" class="btn btn-secondary btn-sm" href={{ "https://maps.google.com/?q=". $invoice->latitude .",". $invoice->langitude }}>
                            Klik Disini
                          <i class="fas fa-chevron-circle-right"></i>
                          </a>
                        </div>
                      </div>
                      
                      <button class="col-12 btn btn-secondary btn-sm text-black-600 mt-5" data-bs-toggle="collapse" href="#invoice_{{$invoice->id}}" role="button" aria-expanded="false" aria-controls="invoice_{{$invoice->id}}">
                          <i class="fas fa-chevron-circle-down text-black">
                          </i>
                          Lihat Status
                      </button>
                      
                      <div class="col collapse"  id="invoice_{{$invoice->id}}">
                        <!--begin::List Widget 9-->
                            <!--begin::Timeline-->
                            <div class="timeline timeline-6 mt-3">
                              <!--begin::Item-->
                              <div class="timeline-item align-items-start">
                                <!--begin::Badge-->
                                <div class="timeline-badge col-1 d-flex justify-content-start">
                                  <i class="fa fa-genderless text-warning icon-xl"></i>
                                </div>
                                <!--end::Badge-->
                                <!--begin::Text-->
                                <div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3 pl-3 col-11 fw-bolder"> Pesanan diterima</div>
                                <!--end::Text-->
                              </div>
                              <!--end::Item-->
                              <!--begin::Item-->
                                <div class="timeline-item align-items-start mb-4">
                                  <!--begin::Badge-->
                                  <div class="timeline-badge col-1  ">
                                    <i class="fa fa-genderless text-danger icon-xl"></i>
                                  </div>
                                  <!--end::Badge-->
                                  <!--begin::Content-->
                                  <div class="timeline-content d-flex col-10">
                                    @if($invoice->status_pembayaran == 1 )
                                      <span class="font-weight-bolder text-dark-75 pl-3 pl-3 font-size-lg text-muted fw-bolder">Pembayaran Sedang Diproses</span>
                                    @elseif($invoice->status_pembayaran == 2)
                                      <span class="font-weight-bolder text-dark-75 pl-3 pl-3 font-size-lg text-muted fw-bolder">Pembayaran Berhasil</span>
                                    @elseif($invoice->status == 2)
                                      <span class="font-weight-bolder text-dark-75 pl-3 pl-3 font-size-lg text-muted fw-bolder">Pesanan Telah Sampai</span>
                                    @elseif($invoice->status_pembayaran == 3)
                                      <span class="font-weight-bolder text-dark-75 pl-3 pl-3 font-size-lg text-muted fw-bolder">Pembayaran Gagal</span>
                                    @endif
                                  </div>
                                  <!--end::Content-->
                                </div>
                              
                              <div class="timeline-item align-items-start">
                                <!--begin::Badge-->
                                <div class="timeline-badge col-1">
                                  <i class="fa fa-genderless text-primary icon-xl"></i>
                                </div>
                                <!--end::Badge-->
                                <!--begin::Desc-->
                                @if($invoice->status_pembayaran == 2)
                                  <div class="timeline-content font-weight-bolder font-size-lg text-dark-75 text-muted pl-3 pl-3 col-11 fw-bolder">Pesanan Diproses 
                                  </div>
                                @endif
                                <!--end::Desc-->
                              </div>
                              <!--end::Item-->
                              <!--begin::Item-->
                              @if($invoice->status == 2)
                                <div class="timeline-item align-items-start">
                                  <!--begin::Badge-->
                                  <div class="timeline-badge col-1">
                                    <i class="fa fa-genderless text-success icon-xl"></i>
                                  </div>
                                  <!--end::Badge-->
                                  <!--begin::Text-->
                                  <div class="timeline-content font-weight-mormal font-size-lg text-muted pl-3 pl-3 fw-bolder">
                                    Pesanan Selesai
                                  </div>
                                  <!--end::Text-->
                                </div>
                              @endif
                              @if($invoice->status == 3)
                                <div class="timeline-item align-items-start">
                                  <!--begin::Badge-->
                                  <div class="timeline-badge col-1">
                                    <i class="fa fa-genderless text-danger icon-xl"></i>
                                  </div>
                                  <!--end::Badge-->
                                  <!--begin::Text-->
                                  <div class="timeline-content font-weight-mormal font-size-lg text-muted pl-3 pl-3 fw-bolder">
                                    Pesanan Batal
                                  </div>
                                  <!--end::Text-->
                                </div>
                              @endif
                            </div>
                              <!--end::Item-->
                            </div>
                            <!--end::Timeline-->
                        <!--end: List Widget 9-->
                      </div>
                    </div>
  
                      <hr/>
                      @php
                        $subtotal = 0;
                        $total = 0;
                        $fee = 2000;  
                        $ongkir = 0; 
                      @endphp
                      @foreach($invoice->invoiceDetail as $invoice_detail)
                        @php
                          $subtotal += ($invoice_detail->harga * $invoice_detail->jumlah);
                          $total = ($subtotal + $fee);
                        @endphp
                        <div class="row border-bottom border-top mt-4 mb-4">
                          <div class="col-4 mt-4 mb-4">
                            @if($invoice_detail->produk->produkFoto->first())
                              <img src="{{ $invoice_detail->produk->produkFoto->first()->foto }}" width="50"  class="mt-4"/>
                            @else
                              <img src="/assets/images/default1.png" width="50"/>
                            @endif
                            <div>
                              {{$invoice_detail->produk->nama}}
                            </div>
                          </div>
                          <div class="col-4 mt-4 mb-4">
                            <div class="d-flex justify-content-start">
                              <div class="fw-bolder">{{$invoice_detail->harga_with_addons_formatted}} X {{$invoice_detail->jumlah}} Pcs</div>
                            </div>
                            @foreach($invoice_detail->invoiceDetailAddons->filter(fn($item) => $item->harga > 0) as $invoiceDetailAddons)
                              <div class="fw-light">{{ $invoiceDetailAddons->produkAddons->nama }}</div>
                            @endforeach
                          </div>
                          <div class="col-4 mt-4 mb-4">
                            <div class="d-flex justify-content-end row">
                              <div class="d-flex justify-content-end fw-bold">Subtotal </div>
                              <div class="d-flex justify-content-end"> {{$invoice_detail->subtotal_formatted}}</div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                        <div class="d-flex justify-content-end mb-5">
                          <div class="mw-300px">
                            <div class="d-flex flex-stack mb-3">
                              <div class="fw-semibold pe-10 text-gray-600 fs-7">Subtotal:</div>
                              <div class="text-end fw-bold fs-6 text-gray-800">{{$invoice->total_formatted}}</div>
                            </div>
                            <div class="d-flex flex-stack mb-3">
                              <div class="fw-semibold pe-10 text-gray-600 fs-7">Ongkir</div>
                              <div class="text-end fw-bold fs-6 text-gray-800">{{$invoice->ongkir_formatted}}</div>
                            </div>
                            {{-- <div class="d-flex flex-stack mb-3">
                              <div class="fw-semibold pe-10 text-gray-600 fs-7">Fee</div>
                              <div class="text-end fw-bold fs-6 text-gray-800">Rp. {{$fee}}</div>
                            </div> --}}
                            <div class="d-flex flex-stack">
                              <div class="fw-semibold pe-10 text-gray-600 fs-7">Total</div>
                              <div class="text-end fw-bold fs-6 text-gray-800">{{$invoice->total_formatted}}</div>
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
@endsection

@section('script')
<script>
    $(".btn-bayar").click(function(e){
        e.preventDefault();
        
        const id = $(this).data('invoice_bayar_id')

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Sudah Bayar!'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = '{{ route("invoice.bayar") }}?id='+id                
            }
        })
    })
</script>
<script>
  $(".btn-hapus").click(function(e){
      e.preventDefault();
      
      const id = $(this).data('invoice_batal_id')

      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, cancel it!'
      }).then((result) => {
          if (result.isConfirmed) {
              location.href = '{{ route("invoice.batal") }}?id='+id                
          }
      })
  })
</script>
@endsection