@extends('layouts.init')

@section('styles')
	
@endsection

@section('actual','Salida de Sellos')
@section('titulo','Sellos')
@section('detalle','listado de sellos registrados')

@section('cuerpo')
    

<div class="row">
    <div class="col-xs-12 col-sm-4">
        <div class="{{ $errors->has('f_salida')?' has-error':'' }}">
            {{ Form::label('f_salida', 'Fecha') }}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-calendar"></i>
                </span>
                {{ Form::text('f_salida',null, ['class' => 'form-control', 'placeholder' => 'Fecha']) }}
            </div>
            @if($errors->has('f_salida'))
                <span style="color:red;">
                    <strong>{{ $errors->first('f_salida') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="{{ $errors->has('n_cite')?' has-error':'' }}">
            {{ Form::label('n_cite', 'Cite') }}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-newspaper-o"></i>
                </span>
                {{ Form::text('n_cite',null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Nro de Cite']) }}
            </div>
            @if($errors->has('n_cite'))
                <span style="color:red;">
                    <strong>{{ $errors->first('n_cite') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div>
            {{ Form::label('u_solicitante', 'Unidad Solicitante') }}
            {{ Form::select('u_solicitante', ['0' => 'Seleccione una Unidad', '1' => 'Direccion General Ejecutiva', '2' => 'Direccion Administrativa Financiera', '3' => 'Operaciones'],null, ['class' => 'chosen-select form-control']) }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-4">
        <div>
            {{ Form::label('s_regional', 'Regional') }}
            {{ Form::select('s_regional', ['0' => 'Seleccione una Regional', '1' => 'Regional La Paz', '2' => 'Regional Cochabamaba', '3' => 'Regional Santa Cruz'],null, ['class' => 'chosen-select form-control']) }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div>
            {{ Form::label('s_tematica', 'Tematica') }}
            {{ Form::select('s_tematica', ['0' => 'Pajarito', '1' => 'PapaNoel', '2' => 'Evo Morales', '3' => 'Naturaleza'],null, ['class' => 'chosen-select form-control']) }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="{{ $errors->has('s_cantidad')?' has-error':'' }}">
            {{ Form::label('s_cantidad', 'Cantidad') }}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-dropbox"></i>
                </span>
                {{ Form::text('s_cantidad',null, ['class' => 'form-control', 'placeholder' => 'Ingrese la cantidad']) }}
            </div>
            @if($errors->has('s_cantidad'))
                <span style="color:red;">
                    <strong>{{ $errors->first('s_cantidad') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-4">
      <div class="{{ $errors->has('v_facial')?' has-error':'' }}">
          {{ Form::label('v_facial', 'Valor Facial') }}
          <div class="input-group">
              <span class="input-group-addon">
                  <i class="ace-icon fa fa-credit-card"></i>
              </span>
              {{ Form::text('v_facial',null, ['class' => 'form-control']) }}
          </div>
          @if($errors->has('v_facial'))
              <span style="color:red;">
                  <strong>{{ $errors->first('v_facial') }}</strong>
              </span>
          @endif
      </div>
    </div>
    <div class="col-xs-12 col-sm-4">
      <div class="{{ $errors->has('m_total')?' has-error':'' }}">
          {{ Form::label('m_total', 'Monto Total') }}
          <div class="input-group">
              <span class="input-group-addon">
                  <i class="ace-icon fa fa-money"></i>
              </span>
              {{ Form::text('m_total',null, ['class' => 'form-control']) }}
          </div>
          @if($errors->has('m_total'))
              <span style="color:red;">
                  <strong>{{ $errors->first('m_total') }}</strong>
              </span>
          @endif
      </div>
    </div>
    
</div>


@endsection

@section('scripts')
    
@endsection