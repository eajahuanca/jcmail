<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>.:Correos:.</title>
		<link rel="icon" type="image/png" href="{{ asset('plugin/login/img/icono.png') }}" />
		<meta name="description" content="Kardex empresarial" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{asset('plugin/assets/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('plugin/assets/font-awesome/4.5.0/css/font-awesome.min.css')}}" />
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="{{asset('plugin/assets/css/jquery-ui.custom.min.css')}}" />
		<link rel="stylesheet" href="{{asset('plugin/assets/css/chosen.min.css')}}" />
		<link rel="stylesheet" href="{{asset('plugin/assets/css/bootstrap-datepicker3.min.css')}}" />
		<link rel="stylesheet" href="{{asset('plugin/assets/css/bootstrap-timepicker.min.css')}}" />
		<link rel="stylesheet" href="{{asset('plugin/assets/css/daterangepicker.min.css')}}" />
		<link rel="stylesheet" href="{{asset('plugin/assets/css/bootstrap-datetimepicker.min.css')}}" />
		<link rel="stylesheet" href="{{asset('plugin/assets/css/bootstrap-colorpicker.min.css')}}" />
		<!-- text fonts -->
		<link rel="stylesheet" href="{{asset('plugin/assets/css/fonts.googleapis.com.css')}}" />
		<!-- ace styles -->
		<link rel="stylesheet" href="{{asset('plugin/assets/css/ace.min.css')}}" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="{{asset('plugin/assets/css/ace-skins.min.css')}}" />
		<link rel="stylesheet" href="{{asset('plugin/assets/css/ace-rtl.min.css')}}" />
		@yield('styles')
		<!-- ace settings handler -->
		<script src="{{asset('plugin/assets/js/ace-extra.min.js')}}"></script>
		<link href="{{asset('plugin/toast/toastr.min.css')}}" rel="stylesheet"/>
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="navbar-header pull-left">
					<a href="" class="navbar-brand">
						<small>
							<i class="fa fa-bars"></i> RESEF - AGBC
						</small>
					</a>
				</div>
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								@if(Auth::user()->us_genero=='Femenina')
								<img class="nav-user-photo" src="{{asset('plugin/assets/images/avatars/avatarFem.png')}}" alt="Bienvenido Usuario" width="48px" height="48px" />
								@else
								<img class="nav-user-photo" src="{{asset('plugin/assets/images/avatars/avatar5.png')}}" alt="Bienvenido Usuario" />
								@endif
								<span class="user-info">
									<small>Bienvenido,</small>
									{{ Auth::user()->us_nombre }}
								</span>
								<i class="ace-icon fa fa-caret-down"></i>
							</a>
							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="{{ url('/pnew') }}">
										<i class="ace-icon fa fa-lock"></i> Contraseña
									</a>
								</li>
								<li>
									<a href="{{ route('user.show',Auth::user()->id) }}">
										<i class="ace-icon fa fa-user"></i> Mis Datos
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="ace-icon fa fa-power-off"></i> Salir
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>
			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<img src="{{ asset('plugin/login/img/logo.png') }}" width="180px" height="100px" />
					</div>
					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>
						<span class="btn btn-info"></span>
						<span class="btn btn-warning"></span>
						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				@include('layouts.menu')

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="{{ url('/home') }}">Principal</a>
							</li>
							<li>
								<a href="#">@yield('actual')</a>
							</li>
						</ul><!-- /.breadcrumb -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Buscar..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>
					<div class="page-content">
						<div class="ace-settings-container" id="ace-settings-container">
							<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
								<i class="ace-icon fa fa-cog bigger-130"></i>
							</div>

							@include('layouts.config')

						</div><!-- /.ace-settings-container -->
						<div class="page-header">
							<h1>
								@yield('titulo')
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i> @yield('detalle')
								</small>
							</h1>
						</div><!-- /.page-header -->

						@yield('cuerpo')

					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="red bolder">AGENCIA BOLIVIANA DE CORREOS</span> Unidad de Tecnologías de Información y Comunicación &copy; 2018
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->
		<script src="{{asset('plugin/assets/js/jquery-2.1.4.min.js')}}"></script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="{{asset('plugin/assets/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('plugin/assets/js/jquery-ui.custom.min.js')}}"></script>
		<script src="{{asset('plugin/assets/js/jquery.ui.touch-punch.min.js')}}"></script>
		<script src="{{asset('plugin/assets/js/spinbox.min.js')}}"></script>
		<script src="{{asset('plugin/assets/js/moment.min.js')}}"></script>
		<script src="{{asset('plugin/assets/js/jquery.knob.min.js')}}"></script>
		<script src="{{asset('plugin/assets/js/autosize.min.js')}}"></script>
		<script src="{{asset('plugin/assets/js/bootstrap-tag.min.js')}}"></script>

		@yield('scripts')

		<!-- ace scripts -->
		<script src="{{asset('plugin/assets/js/ace-elements.min.js')}}"></script>
		<script src="{{asset('plugin/assets/js/ace.min.js')}}"></script>
		<script src="{{asset('plugin/toast/toastr.min.js')}}"></script>
		{!! Toastr::render() !!}
		@yield('codigoscript')
	</body>
</html>
