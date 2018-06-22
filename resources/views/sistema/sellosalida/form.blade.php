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
    <div class="col-xs-12 col-sm-4">
        <div>
            {{ Form::label('idtematica', 'Tematica') }}
            {{ Form::select('idtematica', $tematica,null, ['class' => 'chosen-select form-control']) }}
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