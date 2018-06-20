@extends('layouts.init')

@section('styles')
	
@endsection

@section('actual','Salida de Sellos')
@section('titulo','Sellos')
@section('detalle','nueva salida de sellos')

@section('cuerpo')
    
<div class="row">
    <div class="col-xs-12 col-sm-4">
        <div>
            {{ Form::label('cbotematica', 'Tematica') }}
            {{ Form::select('cbotematica', ['Pajarito' => 'Pajarito', 'Navidad' => 'PapaNoel', 'Evo' =>'Evo Morales'],null, ['class' => 'chosen-select form-control']) }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="{{ $errors->has('c_actual')?' has-error':'' }}">
            {{ Form::label('c_actual', 'Cantidad Actual (Stock)') }}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-image"></i>
                </span>
                {{ Form::text('c_actual',500, ['class' => 'form-control']) }}
            </div>
            @if($errors->has('c_actual'))
                <span style="color:red;">
                    <strong>{{ $errors->first('c_actual') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="{{ $errors->has('c_nueva')?' has-error':'' }}">
            {{ Form::label('c_nueva', 'Nuevo Ingreso') }}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-money"></i>
                </span>
                {{ Form::text('c_nueva',null, ['class' => 'form-control', 'placeholder' => 'Ingrese la nueva cantidad de sellos']) }}
            </div>
            @if($errors->has('c_nueva'))
                <span style="color:red;">
                    <strong>{{ $errors->first('c_nueva') }}</strong>
                </span>
            @endif
        </div>
    </div>

    
@endsection

@section('scripts')
    
@endsection