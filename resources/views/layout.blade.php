<!DOCTYPE html>
<html lang="en">
	<head><base href="">
		<title>{{ $title }}</title>
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta charset="utf-8" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Admin Laksa" />
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
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
				<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
					<div class="aside-menu flex-column-fluid">
						<div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
							<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
								<div class="menu-item">
									<a class="menu-link @if($active == 'dashboard') active @endif" href="{{ route('dashboard')}}">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-coffee"></i>
											</span>
										</span>
										<span class="menu-title">Dashboard</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link @if($active == 'invoice') active @endif" href="{{ route('invoice')}}">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-coffee"></i>
											</span>
										</span>
										<span class="menu-title">Invoice</span>
									</a>
								</div>
								<div class="menu-item">	
									<a class="menu-link @if($active == 'produk') active @endif" href="{{ route('produk')}}">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-coffee"></i>
											</span>
										</span>
										<span class="menu-title">Produk</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link @if($active == 'voucher') active @endif" href="{{ route('voucher')}}">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-percentage"></i>
											</span>
										</span>
										<span class="menu-title">Voucher</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link @if($active == 'voucher_user') active @endif" href="{{ route('voucher_user')}}">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-percentage"></i>
											</span>
										</span>
										<span class="menu-title">Voucher User</span>
									</a>
								</div>
                                <div class="menu-item">
									<a class="menu-link @if($active == 'kategori') active @endif" href="{{ route('kategori')}}">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-list"></i>
											</span>
										</span>
										<span class="menu-title">Kategori</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link @if($active == 'addons') active @endif" href="{{ route('addons')}}">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-plus"></i>
											</span>
										</span>
										<span class="menu-title">Addons</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link @if($active == 'produk_foto') active @endif" href="{{ route('produk_foto')}}">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-cart-plus"></i>
											</span>
										</span>
										<span class="menu-title">Produk Foto</span>
									</a>
								</div>
                                <div class="menu-item">
									<a class="menu-link @if($active == 'stamp') active @endif" href="{{ route('stamp')}}">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-stamp"></i>
											</span>
										</span>
										<span class="menu-title">Stamp</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link" href="wwww.laksacoffee.com">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="black" />
													<path d="M19 10.4C19 10.3 19 10.2 19 10C19 8.9 18.1 8 17 8H16.9C15.6 6.2 14.6 4.29995 13.9 2.19995C13.3 2.09995 12.6 2 12 2C11.9 2 11.8 2 11.7 2C12.4 4.6 13.5 7.10005 15.1 9.30005C15 9.50005 15 9.7 15 10C15 11.1 15.9 12 17 12C17.1 12 17.3 12 17.4 11.9C18.6 13 19.9 14 21.4 14.8C21.4 14.8 21.5 14.8 21.5 14.9C21.7 14.2 21.8 13.5 21.9 12.7C20.9 12.1 19.9 11.3 19 10.4Z" fill="black" />
													<path d="M12 15C11 13.1 10.2 11.2 9.60001 9.19995C9.90001 8.89995 10 8.4 10 8C10 7.1 9.40001 6.39998 8.70001 6.09998C8.40001 4.99998 8.20001 3.90005 8.00001 2.80005C7.30001 3.10005 6.70001 3.40002 6.20001 3.90002C6.40001 4.80002 6.50001 5.6 6.80001 6.5C6.40001 6.9 6.10001 7.4 6.10001 8C6.10001 9 6.80001 9.8 7.80001 10C8.30001 11.6 9.00001 13.2 9.70001 14.7C7.10001 13.2 4.70001 11.5 2.40001 9.5C2.20001 10.3 2.10001 11.1 2.10001 11.9C4.60001 13.9 7.30001 15.7 10.1 17.2C10.2 18.2 11 19 12 19C12.6 20 13.2 20.9 13.9 21.8C14.6 21.7 15.3 21.5 15.9 21.2C15.4 20.5 14.9 19.8 14.4 19.1C15.5 19.5 16.5 19.9 17.6 20.2C18.3 19.8 18.9 19.2 19.4 18.6C17.6 18.1 15.7 17.5 14 16.7C13.9 15.8 13.1 15 12 15Z" fill="black" />
												</svg>
											</span>
										</span>
										<span class="menu-title">Landing Page</span>
									</a>
								</div>
								<div class="menu-item">
									<div class="menu-content pt-8 pb-2">
										<span class="menu-section text-muted text-uppercase fs-8 ls-1">Crafted</span>
									</div>
								</div>
                                <div class="menu-item">
									<a class="menu-link @if($active == 'profile') active @endif" href="{{ route('profile')}}">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-users"></i>
											</span>
										</span>
										<span class="menu-title">Profile</span>
									</a>
								</div>
                                <div class="menu-item">
									<a class="menu-link @if($active == 'alamat_user') active @endif" href="{{ route('alamat_user')}}">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-map-marker-alt"></i>
											</span>
										</span>
										<span class="menu-title">Alamat</span>
									</a>
								</div>
                                <div class="menu-item">
									<a class="menu-link @if($active == 'transaksi_delivered') active @endif" href="{{ route('transaksi_delivered')}}">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-truck"></i>
											</span>
										</span>
										<span class="menu-title">Transaksi Deliv</span>
									</a>
								</div>
                                <div class="menu-item">
									<a class="menu-link @if($active == 'transaksi_pickup') active @endif" href="{{ route('transaksi_pickup')}}">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-hand-holding-heart"></i>
											</span>
										</span>
										<span class="menu-title">Transaksi Pickup</span>
									</a>
								</div>
                                <div class="menu-item">
									<a class="menu-link @if($active == 'transaksi_reservasi') active @endif"  href="{{ route('transaksi_reservasi')}}">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-bookmark"></i>
											</span>
										</span>
										<span class="menu-title">Transaksi Reservasi</span>
									</a>
								</div>
								<div class="menu-item">
										<a class="menu-link @if($active == 'History') active @endif" href="{{ route('invoice.history')}}"> 
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-receipt"></i>
											</span>
										</span>
										<span class="menu-title">History Invoice</span>
									</a>
								</div>
								<div class="menu-item">
									<div class="menu-content pt-8 pb-2">
										<span class="menu-section text-muted text-uppercase fs-8 ls-1">Driver</span>
									</div>
								</div>
                                <div class="menu-item">
									<a class="menu-link @if($active == 'driver') active @endif" href="{{ route('driver') }}">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-users"></i>
											</span>
										</span>
										<span class="menu-title">Driver</span>
									</a>
								</div>
                                <div class="menu-item">
									<a class="menu-link @if($active == 'index_driver') active @endif" href="{{ route('index.driver') }}">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-users"></i>
											</span>
										</span>
										<span class="menu-title">Driver Order</span>
									</a>
								</div>
								<div class="menu-item">
									<div class="menu-content pt-8 pb-2">
										<span class="menu-section text-muted text-uppercase fs-8 ls-1">Notifikasi</span>
									</div>
								</div>
                                <div class="menu-item">
									<a class="menu-link @if($active == 'notifikasi') active @endif" href="{{ route('notifikasi') }}">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-users"></i>
											</span>
										</span>
										<span class="menu-title">Notifikasi</span>
									</a>
								</div>
								<div class="menu-item">
									<div class="menu-content pt-8 pb-2">
										<span class="menu-section text-muted text-uppercase fs-8 ls-1">Akun</span>
									</div>
								</div>
                                <div class="menu-item">
									<a class="menu-link" href="{{ route('logout') }}">
										<span class="menu-icon">
											<span class="svg-icon svg-icon-2">
												<i class="fa fa-chevron-right"></i>
											</span>
										</span>
										<span class="menu-title">Logout</span>
									</a>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<div id="kt_header" style="" class="header align-items-stretch">
						<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
								<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
									<span class="svg-icon svg-icon-2x mt-1">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
											<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
										</svg>
									</span>
								</div>
							</div>
							<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
								<a href="../../demo1/dist/index.html" class="d-lg-none">
									<img alt="Logo" src="/assets/media/logos/logo-2.svg" class="h-30px" />
								</a>
							</div>
							<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
								<div class="d-flex align-items-stretch flex-shrink-0">
									<div class="d-flex align-items-stretch flex-shrink-0">
										<div class="d-flex align-items-stretch ms-1 ms-lg-3">
											<div id="kt_header_search" class="d-flex align-items-stretch" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="menu" data-kt-menu-trigger="auto" data-kt-menu-overflow="false" data-kt-menu-permanent="true" data-kt-menu-placement="bottom-end">
												<div data-kt-search-element="content" class="menu menu-sub menu-sub-dropdown p-7 w-325px w-md-375px">
													<div data-kt-search-element="wrapper">
													</div>
												</div>
											</div>
										</div>
										<div class="d-flex align-items-center ms-1 ms-lg-3 d-flex justify-content-end" id="kt_header_user_menu_toggle">
											<div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
												<img src="/assets/media/avatars/150-26.jpg" alt="user" />
											</div>
											<div class=" menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
												<div class="d-flex justify-content-end menu-item px-3">
													<div class="menu-content d-flex align-items-center px-3">
														<div class="symbol symbol-50px me-5">
															<img alt="Logo" src="/assets/media/avatars/150-26.jpg" />
														</div>
														<div class="d-flex flex-column">
															<div class="fw-bolder d-flex align-items-center fs-5">Max Smith
															<span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Pro</span></div>
															<a href="#" class="fw-bold text-muted text-hover-primary fs-7">max@kt.com</a>
														</div>
													</div>
												</div>
												<div class="separator my-2"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="content d-flex flex-column flex-column-fluid mt-0" id="kt_content">
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<div id="kt_content_container" class="container-xxl">
								<div class="d-flex bd-highlight ">
									<div class="p-2 bd-highlight">
										<h1 class="d-flex align-items-center text-dark fw-bolder fs-1 my-1 mb-10">
											{{ $title }}
										</h1>
									</div>
								</div>
								@if($errors->any())
									<div class="alert alert-danger d-flex flex-row">
										<span class="svg-icon svg-icon-2hx svg-icon-danger me-3">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
												<path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
											</svg>
										</span>
										<div class="d-flex flex-column">
											<h4 class="mb-1 text-dark">Gagal!</h4>
											<ul class="mb-0">
												@foreach($errors->all() as $error)
													<li>{{ $error }}</li>
												@endforeach
											</ul>
										</div>
									</div>
								@endif
								@yield('content')
							</div>
						</div>
					</div>
					<div class="footer py-4 d-flex  flex-lg-column " id="kt_footer">
						<div class="container-fluid d-flex flex-column flex-md-row justify-content-end">
							<div class="text-dark order-2 order-md-1">
								<a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Made By Frans</a>
								<span class="text-muted fw-bold me-1"> **2022**</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		
		
		
		<script src="/assets/plugins/global/plugins.bundle.js"></script>
		<script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>

		<script src="/assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		{{-- <script src="/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script> --}}
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		{{-- <script src="/assets/js/custom/widgets.js"></script> --}}
		{{-- <script src="/assets/js/custom/apps/chat/chat.js"></script> --}}
		{{-- <script src="/assets/js/custom/modals/create-app.js"></script> --}}
		{{-- <script src="/assets/js/custom/modals/upgrade-plan.js"></script> --}}
		<script src="https://code.jquery.com/jquery-3.5.1.js
		"></script>
		<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

		@yield('script')
		@if(session('error'))
			<script>
				$(document).ready(function(){
					toastr.error('{{ session("error") }}')
				})
			</script>
		@endif
		@if(session('success'))
			<script>
				$(document).ready(function(){
					toastr.success('{{ session("success") }}')
				})
			</script>
		@endif
	</body>
</html>