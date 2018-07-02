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
		<div class="{{ $errors->has('cantidad_reversion')?' has-error':'' }}">
			{{ Form::label('cantidad_reversion', 'Cantidad a Revertir') }}
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-money"></i>
				</span>
				{{ Form::text('cantidad_reversion',null, ['class' => 'form-control', 'placeholder' => 'Ingrese la cantidad revertida de sellos']) }}
			</div>
			@if($errors->has('cantidad_reversion'))
				<span style="color:red;">
					<strong>{{ $errors->first('cantidad_reversion') }}</strong>
				</span>
			@endif
		</div>
	</div>
	<div class="col-xs-12 col-sm-4">
		<div class="{{ $errors->has('cite_manual')?' has-error':'' }}">
			{{ Form::label('cite_manual', 'Cite de Reversion') }}
			<div class="input-group">
				<span class="input-group-addon">
					<i class="ace-icon fa fa-money"></i>
				</span>
				{{ Form::text('cite_manual',null, ['class' => 'form-control', 'placeholder' => 'Ingrese el cite de la reversion']) }}
			</div>
			@if($errors->has('cite_manual'))
				<span style="color:red;">
					<strong>{{ $errors->first('cite_manual') }}</strong>
				</span>
			@endif
		</div>
	</div>

	<div class="col-xs-12 col-sm-4">
		<div class="{{ $errors->has('observaciones')?' has-error':'' }}">
			{{ Form::label('cite_manual', 'Observaciones') }}
			{{ Form::textarea('Observaciones',null,['rows' => '3'])}}
			@if($errors->has('Observaciones'))
				<span style="color:red;">
					<strong>{{ $errors->first('Observaciones') }}</strong>
				</span>
			@endif
		</div>
	</div>

</div>