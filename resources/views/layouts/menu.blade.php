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

	@endif

	<ul class="active nav">
		<a href="">
			<i class="menu-icon fa fa-book"></i>
			<span class="menu-text"> Sellos</span>
		</a>
		<li class="active">
			<a href="{{ url('/entrada') }}">
			<i class="menu-icon  fa fa-building"></i>
			<span class="menu-text"> Entradas</span>
		</a>
		<b class="arrow"></b>
		</li>

		<li class="active">
			<a href="{{ url('/salida') }}">
			<i class="menu-icon  fa fa-building"></i>
			<span class="menu-text"> Salidas</span>
		</a>
		<b class="arrow"></b>
		</li>
	</ul>
	
</ul>
