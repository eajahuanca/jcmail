
<div class="row">
    <div class="col-xs-12 col-sm-4">
        <div class="{{ $errors->has('us_nombre')?' has-error':'' }}">
            {{ Form::label('us_nombre', 'Nombre completo') }}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-user"></i>
                </span>
                {{ Form::text('us_nombre',null, ['class' => 'form-control', 'placeholder' => 'nombre']) }}
            </div>
            @if($errors->has('us_nombre'))
                <span style="color:red;">
                    <strong>{{ $errors->first('us_nombre') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="{{ $errors->has('us_paterno')?' has-error':'' }}">
            {{ Form::label('us_paterno', 'Apellido Paterno') }}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-user"></i>
                </span>
                {{ Form::text('us_paterno',null, ['class' => 'form-control', 'placeholder' => 'Ap. paterno']) }}
            </div>
            @if($errors->has('us_paterno'))
                <span style="color:red;">
                    <strong>{{ $errors->first('us_paterno') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="{{ $errors->has('us_materno')?' has-error':'' }}">
            {{ Form::label('us_materno', 'Apellido Materno') }}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-user"></i>
                </span>
                {{ Form::text('us_materno',null, ['class' => 'form-control', 'placeholder' => 'Ap. materno']) }}
            </div>
            @if($errors->has('us_materno'))
                <span style="color:red;">
                    <strong>{{ $errors->first('us_materno') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-xs-12 col-sm-4">
        <div>
            {{ Form::label('us_genero', 'Género') }}
            {{ Form::select('us_genero', ['Masculino' => 'Masculino', 'Femenina' => 'Femenina'],null, ['class' => 'chosen-select form-control']) }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="{{ $errors->has('email')?' has-error':'' }}">
            {{ Form::label('email', 'Correo Electrónico') }}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-send"></i>
                </span>
                {{ Form::text('email',null, ['class' => 'form-control', 'placeholder' => 'nombre.apellido@correos.gob.bo']) }}
            </div>
            @if($errors->has('email'))
                <span style="color:red;">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

    </div>
    <div class="col-xs-12 col-sm-4">
        <div class="{{ $errors->has('us_cuenta')?' has-error':'' }}">
            {{ Form::label('us_cuenta', 'Cuenta de Usuario') }}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-user"></i>
                </span>
                {{ Form::text('us_cuenta',null, ['class' => 'form-control', 'placeholder' => 'nombre.apellido']) }}
            </div>
            @if($errors->has('us_cuenta'))
                <span style="color:red;">
                    <strong>{{ $errors->first('us_cuenta') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-4">
        <div>
            {{ Form::label('us_tipo', 'Tipo de Usuario') }}
            {{ Form::select('us_tipo', ['SOLICITANTE' => 'SOLICITANTE',
                                        'ADMINISTRADOR' => 'ADMINISTRADOR',
                                        'TESORERO' => 'TESORERO'],null, ['class' => 'chosen-select form-control']) }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
        <div>
            {{ Form::label('us_estado', 'Estado') }}
            {{ Form::select('us_estado', [true => 'Activo', false => 'Bloqueado'],null, ['class' => 'chosen-select form-control']) }}
        </div>
    </div>
    <?php error_reporting(0); ?>
    @if(!$user->id)
    <div class="col-xs-12 col-sm-4">
        <div class="{{ $errors->has('password')?' has-error':'' }}">
            {{ Form::label('password', 'Contraseña') }}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-lock"></i>
                </span>
                {{ Form::password('password',null, ['class' => 'form-control', 'placeholder' => 'aaaaaaa']) }}
            </div>
            @if($errors->has('password'))
                <span style="color:red;">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
    @endif
</div>

<div class="row">
    <div class="col-xs-12 col-sm-4">
      <div class="{{ $errors->has('us_ci')?' has-error':'' }}">
          {{ Form::label('us_ci', 'Carnet de Identidad') }}
          <div class="input-group">
              <span class="input-group-addon">
                  <i class="ace-icon fa fa-user"></i>
              </span>
              {{ Form::text('us_ci',null, ['class' => 'form-control', 'placeholder' => 'C.I.']) }}
          </div>
          @if($errors->has('us_ci'))
              <span style="color:red;">
                  <strong>{{ $errors->first('us_ci') }}</strong>
              </span>
          @endif
      </div>
    </div>
                                 
    <?php error_reporting(0); ?>
    @if(!$user->id)
    <div class="col-xs-12 col-sm-4">
      <div>
          {{ Form::label('us_estadociv', 'Estado Civil') }}
          {{ Form::select('us_estadociv', ['SOLTERO' => 'SOLTERO(A)',
                                      'CASADO' => 'CASADO(A)',
                                      'VIUDO' => 'VIUDO(A)',
                                      'DIVORCIADO' => 'DIVORCIADO(A)'
                                      ],null, ['class' => 'chosen-select form-control']) }}
      </div>
    </div>
    @endif
</div>

<div class="row">
    <div class="col-xs-12 col-sm-4">
      <div>
          {{ Form::label('us_condicion', 'Condición') }}
          {{ Form::select('us_condicion', ['PERMANENTE' => 'PERMANENTE',
                                      'EVENTUAL' => 'EVENTUAL',
                                      'CONSULTOR' => 'CONSULTOR INDIVIDUAL EN LINEA',
                                      'PRODUCTO' => 'CONSULTOR POR PRODUCTO'
                                      ],null, ['class' => 'chosen-select form-control']) }}
      </div>
    </div>
    <div class="col-xs-12 col-sm-4">

      <div class="{{ $errors->has('us_sueldo')?' has-error':'' }}">
          {{ Form::label('us_sueldo', 'Haber Básico') }}
          <div class="input-group">
              <span class="input-group-addon">
                  <i class="ace-icon fa fa-money"></i>
              </span>
              {{ Form::text('us_sueldo',null, ['class' => 'form-control', 'placeholder' => 'Bs.']) }}
          </div>
          @if($errors->has('us_sueldo'))
              <span style="color:red;">
                  <strong>{{ $errors->first('us_nombre') }}</strong>
              </span>
          @endif
      </div>

    </div>

    <div class="col-xs-12 col-sm-4">
      <div class="{{ $errors->has('us_cargo')?' has-error':'' }}">
          {{ Form::label('us_cargo', 'Cargo') }}
          <div class="input-group">
              <span class="input-group-addon">
                  <i class="ace-icon fa fa-graduation-cap"></i>
              </span>
              {{ Form::text('us_cargo',null, ['class' => 'form-control', 'placeholder' => 'Cargo que Ocupa']) }}
          </div>
          @if($errors->has('us_cargo'))
              <span style="color:red;">
                  <strong>{{ $errors->first('us_cargo') }}</strong>
              </span>
          @endif
      </div>

    </div>

</div>

<div class="row">
    <div class="col-xs-12 col-sm-4">
      <div>
          {{ Form::label('us_direccion', 'DIRECCION') }}
          {{ Form::select('us_direccion', ['DIRECCION' => 'DIRECCION GENERAL EJECUTIVA',
                                      'DAF' => 'DIRECCION ADMINISTRATIVA FINANCIERA',
                                      'CPYEP' => 'COORDINACION DE PLANIFICACION Y EVALUACION DE PROYECTOS'
                                      ],null, ['class' => 'chosen-select form-control']) }}
      </div>
    </div>
    <div class="col-xs-12 col-sm-4">
      <div>
          {{ Form::label('us_unidad', 'UNIDAD') }}
          {{ Form::select('us_unidad', ['LEGAL' => 'ASESORIA LEGAL',
                                      'COMUNICACION' => 'COMUNICACION',
                                      'AUDITORIA' => 'AUDITORIA INTERNA',
                                      'ADMINISTRATIVA' => 'UNIDAD ADMNISTRATIVA'
                                      ],null, ['class' => 'chosen-select form-control']) }}
      </div>


    </div>

</div>



