<ul class="nav nav-list">
	<li class="">
		<a href="{{ url('/home') }}">
			<i class="menu-icon fa fa-home"></i>
			<span class="menu-text"> Principal </span>
		</a>
		<b class="arrow"></b>
	</li>

	@if(strcmp(Auth::user()->us_tipo,'ADMINISTRADOR')==0)
	<li class="">
		<a href="{{ url('/user') }}">
			<i class="menu-icon fa fa-user"></i>
			<span class="menu-text"> Registro Usuarios</span>
		</a>
		<b class="arrow"></b>
	</li>
	@endif

	<li class="active open">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-pencil-square-o"></i>
			<span class="menu-text"> Sellos </span>
			<b class="arrow fa fa-angle-down"></b>
		</a>
		<b class="arrow"></b>
		<ul class="submenu">
			<li class="active">
				<a href="{{ url('/entrada') }}">
					<i class="menu-icon fa fa-caret-right"></i>
					Entradas
				</a>
				<b class="arrow"></b>
			</li>
			<li class="active">
				<a href="{{ url('/salida') }}">
					<i class="menu-icon fa fa-caret-right"></i>
					Salidas
				</a>
				<b class="arrow"></b>
			</li>
		</ul>
	</li>
</ul>
