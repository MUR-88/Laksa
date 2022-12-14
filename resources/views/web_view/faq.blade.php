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
                    <button class="col-12 btn btn-secondary btn-sm text-black-600" data-bs-toggle="collapse" href="#faq1" role="button" aria-expanded="false" aria-controls="faq1">
                      <a class="fas fa-chevron-circle-down text-black">
                      </a>
                      Bagaimana Melakukan pembayaran
                    </button>
                    {{-- <button class="col-12 btn btn-secondary btn-sm text-black-600">
                      <a class="fas fa-chevron-circle-down text-black" data-bs-toggle="collapse" href="#bRI" role="button" aria-expanded="false" aria-controls="bRI">
                      </a>
                      Cara Pembayaran
                    </button> --}}
                  <div class="collapse mb-5 " id="faq1">
                    <div>
                      <h2 class="mt-10">BANK BCA</h2>
                      <div class="flex-d-flex justify-content-between align-items-center mt-5">
                        <h2 class="badge badge-square badge-secondary px-4 py-5 fs-1"  id="myInput">123123176253</h2>
                        <button class="btn btn-primary ms-4" onclick="copyToClipboard()"> 
                          copy
                        </button>
                      </div>
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
    {{-- <script>
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
    </script> --}}
	</body>


</html>