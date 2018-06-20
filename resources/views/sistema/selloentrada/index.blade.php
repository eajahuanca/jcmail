@extends('layouts.init')

@section('styles')
	
@endsection

@section('actual','Sellos de entrada')
@section('titulo','Sellos')
@section('detalle','listado de sellos de entrada registrados')

@section('cuerpo')
    <div class="form-group">
		<div class="row">
			<div class="col-md-12 pull-left">
				<a href="{{ route('entrada.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva Entrada de Sellos</a>
				<a class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Reporte</a>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
    
@endsection