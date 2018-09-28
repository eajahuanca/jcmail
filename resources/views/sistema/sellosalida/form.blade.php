<div class="row">
    <div class="col-xs-12 col-sm-4">
        <div class="{{ $errors->has('fecha_salida')?' has-error':'' }}">
            {{ Form::label('fecha_salida', 'Fecha de Salida') }}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-calendar"></i>
                </span>
                {{ Form::date('fecha_salida',null, ['class' => 'form-control', 'placeholder' => 'Fecha']) }}
            </div>
            @if($errors->has('fecha_salida'))
                <span style="color:red;">
                    <strong>{{ $errors->first('fecha_salida') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="{{ $errors->has('cite_manual')?' has-error':'' }}">
            {{ Form::label('cite_manual', 'Cite') }}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-newspaper-o"></i>
                </span>
                {{ Form::text('cite_manual',null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Nro de Cite']) }}
            </div>
            @if($errors->has('cite_manual'))
                <span style="color:red;">
                    <strong>{{ $errors->first('cite_manual') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-4">
        <div>
            {{ Form::label('idunidad', 'Unidad Solicitante') }}
            {{ Form::select('idunidad', $unidad,null, ['class' => 'chosen-select form-control']) }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-4">
        <div>
            {{ Form::label('idregional', 'Regional') }}
            {{ Form::select('idregional', $regional,null, ['class' => 'chosen-select form-control']) }}
        </div>
    </div>
</div>
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
                    <i class="ace-icon fa fa-dropbox"></i>
                </span>
                {{ Form::text('cantidad_actual',null, ['class' => 'form-control', 'placeholder' => 'Ingrese la cantidad']) }}
            </div>
            @if($errors->has('cantidad_actual'))
                <span style="color:red;">
                    <strong>{{ $errors->first('cantidad_actual') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-4">
      <div class="{{ $errors->has('costo')?' has-error':'' }}">
          {{ Form::label('costo', 'Valor Facial') }}
          <div class="input-group">
              <span class="input-group-addon">
                  <i class="ace-icon fa fa-credit-card"></i>
              </span>
              {{ Form::text('costo',null, ['class' => 'form-control']) }}
          </div>
          @if($errors->has('costo'))
              <span style="color:red;">
                  <strong>{{ $errors->first('costo') }}</strong>
              </span>
          @endif
      </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="{{ $errors->has('cantidad_salida')?' has-error':'' }}">
            {{ Form::label('cantidad_salida', 'Cantidad') }}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-dropbox"></i>
                </span>
                {{ Form::text('cantidad_salida',null, ['class' => 'form-control sumarSalida', 'placeholder' => 'Ingrese la cantidad']) }}
            </div>
            @if($errors->has('cantidad_salida'))
                <span style="color:red;">
                    <strong>{{ $errors->first('cantidad_salida') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
      <div class="{{ $errors->has('total')?' has-error':'' }}">
          {{ Form::label('total', 'Monto Total') }}
          <div class="input-group">
              <span class="input-group-addon">
                  <i class="ace-icon fa fa-money"></i>
              </span>
              {{ Form::text('total',null, ['class' => 'form-control']) }}
          </div>
          @if($errors->has('total'))
              <span style="color:red;">
                  <strong>{{ $errors->first('total') }}</strong>
              </span>
          @endif
      </div>
    </div>
    
</div>