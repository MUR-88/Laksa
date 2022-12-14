<!DOCTYPE html>
<html lang="en">
	<head><base href="">
		<title>{{ $title }}</title>
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" 
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta charset="utf-8" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Keenthemes | Metronic" />
		<link rel="canonical" href="Https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="/assets/media/logos/favicon.ico" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
		<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>

		
	</head>
	<body class="h-100 bg-gray fs-5">
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
                      <div class="col-6 d-flex justify-content-end">
                        @if(!$invoice->gagal_at && $invoice->status == 1)
                          <button class="btn btn-danger btn-hapus" data-invoice_batal_id="{{ $invoice->id }}">Batal</button>
                        @endif
                      </div>
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
                    <button class="col-12 btn btn-secondary btn-sm text-black-600" data-bs-toggle="collapse" href="#pembayaran{{$invoice->id}}" role="button" aria-expanded="false" aria-controls="pembayaran{{$invoice->id}}">
                      <a class="fas fa-chevron-circle-down text-black">
                      </a>
                      Cara Pembayaran
                    </button>
                    {{-- <button class="col-12 btn btn-secondary btn-sm text-black-600">
                      <a class="fas fa-chevron-circle-down text-black" data-bs-toggle="collapse" href="#bRI" role="button" aria-expanded="false" aria-controls="bRI">
                      </a>
                      Cara Pembayaran
                    </button> --}}
                  <div class="collapse mb-5 " id="pembayaran{{$invoice->id}}">
                    <div>
                      <h2 class="mt-10">BANK BCA</h2>
                      <div class="flex-d-flex justify-content-between align-items-center mt-5">
                        <h2 class="badge badge-square badge-secondary px-4 py-5 fs-1"  id="myInput">123123176253</h2>
                        <button class="btn btn-primary ms-4" onclick="copyToClipboard()"> 
                          copy
                        </button>
                      </div>
                      <div>
                        {{-- <div class="flex-d-flex justify-content-between align-items-center mt-5">
                          <button class="btn btn-primary ms-4" href="https://api.whatsapp.com/send?phone=15551234567"> 
                            Konfirmasi Pembayaran
                          </button>
                        </div> --}}
                      <div class="d-flex  mb-5 d-flex justify-content-center ">
                        <div class="row d-flex justify-content-center align-item-center mb-5 mt-10">
                          <h2 >Transfer Atm</h2>
                          <span class="mt-3">1. Masukkan kartu debit ke mesin ATM </span>
                          <span class="mt-3">2. Pilih menu transfer </span>
                          <span class="mt-3">3. Pilih tujuan transfer: sesama atau antarbank </span>
                          <span class="mt-3">4. Masukkan kode bank jika memilih transfer antarbank</span>
                          <span class="mt-3">5. Masukkan nominal transfer </span>
                          <span class="mt-3">6. Konfirmasi dengan memilih “YA” atau “YES” </span>
                          <span class="mt-3">7. Ambil dan simpan struk ATM sebagai bukti transfer uang </span>
                          <span class="mt-3">8. Lalu Kirim Bukti Transfer ke Admin Laksa </span>
                          <a href="https://linktr.ee/laksa_coffee">Klik Disini</a>

                        </div>
                      </div>
                      <div class="d-flex  mb-5 d-flex justify-content-center ">
                        <div class="row d-flex justify-content-center align-item-center mb-5 mt-10">
                          <h2 >Mobile Banking</h2>
                          <span class="mt-3">1. Buka & Login Mobile Banking </span>
                          <span class="mt-3">2. Pilih menu transfer </span>
                          <span class="mt-3">3. Pilih tujuan transfer: sesama atau antarbank </span>
                          <span class="mt-3">5. Masukkan nominal transfer </span>
                          <span class="mt-3">6. Konfirmasi dengan memilih “YA” atau “YES” </span>
                          <span class="mt-3">7. Simpan struk sebagai bukti transfer </span>
                          <span class="mt-3">8. Lalu Kirim Bukti ScreenShot ke Admin Laksa </span>
                          <a href="https://linktr.ee/laksa_coffee">Klik Disini</a>

                        </div>
                      </div>
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
                                  @elseif($invoice->status_pembayaran == 3)
                                    <span class="font-weight-bolder text-dark-75 pl-3 pl-3 font-size-lg text-muted fw-bolder">Pembayaran Gagal</span>
                                  @endif
                                </div>
                                <!--end::Content-->
                              </div>
                            
                            <!--end::Item-->
                            <!--begin::Item-->
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
		<script src="/assets/plugins/global/plugins.bundle.js"></script>
		<script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
		<script>
			function copyToClipboard() {
				// return alert($('#myInput').val())
				var $temp = $("<input>");
				$("body").append($temp);
				$temp.val($('#myInput').text()).select();
				document.execCommand("copy");
				$temp.remove();
				toastr.success('Berhasil Di Copy')

			}

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
                  location.href = '{{ route("webview.invoice.batal.user") }}?id='+id                
              }
          })
      })
    </script>
	</body>


</html>
