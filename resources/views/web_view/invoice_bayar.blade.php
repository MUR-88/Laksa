@extends('web_view/index')
@section('content')
{{-- @if(count($invoice)>0)
  @foreach($invoice as $item) --}}
    <div id="kt_app_content" class="app-content flex-column-fluid-sm bg-success mb-10">
      <div >
        <div class="card">
          <div class="card-body px-10">
            <div class="row">
              <div class="col-md-12">
                <div class="flex mb-10">
                  <div class="mt-n1">
                      <button class="btn btn-info">
                        <p>
                          <a class="fas fa-chevron-circle-down text-light " data-bs-toggle="collapse" href="#bRI" role="button" aria-expanded="false" aria-controls="invoice_{{$item->id}}">
                            Lihat Selengkap nya
                          </a>
                        </p>
                      </button>
                      <div class="collapse" id="bRI">
                        <div class="flex-grow-1">
                          <div class="table-responsive border-bottom mb-9">
                            {{-- <table class="table mb-3">
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
                                  $fee = 2000;  
                                  $ongkir = 0; 
                                @endphp
                                @foreach($item->invoiceDetail as $item)
                                  @php
                                    $subtotal += ($item->harga * $item->jumlah);
                                    $total = ($subtotal + $fee);
                                  @endphp
                                  <tr class="fw-bold text-gray-700 fs-5 text-end ms-2">
                                    <td class="d-flex align-items-center pt-6">
                                      <i class="fa fa-genderless text-danger fs-2 me-2"></i>
                                        {{$item->produk->nama}}
                                    </td>
                                    <td class="pt-6">
                                        {{$item->jumlah}}
                                    </td>
                                    <td class="pt-6">{{$item->harga}}</td>
                                    <td class="pt-6 text-dark fw-bolder">Rp.  {{ $item->harga * $item->jumlah }}</td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table> --}}
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
  {{-- @endforeach
@else
  <div>
    <a>
      <img  src="/assets/images/lost_signal.png" />
      Tidak ada Transaksi
    </a>
  </div>
@endif --}}

@endsection

{{-- @section('script')
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
@endsection --}}