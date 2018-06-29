<div class="row">
	<div class="col-xs-12 col-sm-4">
		<div>
			{{ Form::label('idtematica', 'Tematica') }}
			{{ Form::select('idtematica', $tematica,null, ['class' => 'chosen-select form-control']) }}
		</div>
	</div>
	<div class="col-xs-12 col-sm-4">
		<div class="{{ $errors->has('cantidad_actual')?' has-error':'' }}">
			{{ Form::label('cantidad_actual', 'Cantidad Actual (Stock)') }}
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-image"></i>
				</span>
				{{ Form::text('cantidad_actual',500, ['class' => 'form-control']) }}
			</div>
			@if($errors->has('cantidad_actual'))
				<span style="color:red;">
					<strong>{{ $errors->first('cantidad_actual') }}</strong>
				</span>
			@endif
		</div>
	</div>
	<div class="col-xs-12 col-sm-4">
		<div class="{{ $errors->has('cantidad_nueva')?' has-error':'' }}">
			{{ Form::label('cantidad_nueva', 'Nuevo Ingreso') }}
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-money"></i>
				</span>
				{{ Form::text('cantidad_nueva',null, ['class' => 'form-control', 'placeholder' => 'Ingrese la nueva cantidad de sellos']) }}
			</div>
			@if($errors->has('cantidad_nueva'))
				<span style="color:red;">
					<strong>{{ $errors->first('cantidad_nueva') }}</strong>
				</span>
			@endif
		</div>
	</div>

</div>