@extends('layouts.init')

@section('styles')
	
@endsection

@section('actual','Sellos de entrada')
@section('titulo','Sellos')
@section('detalle','nuevo registro de sello de entrada')

@section('cuerpo')

    <div class="row">
        <div class="col-xs-12 col-sm-12">
            {!! Form::open(['route' => 'entrada.store', 'method' => 'post']) !!}
            <div class="clearfix">
                <div class="pull-left">
                    <button class="btn btn-primary btn-round" type="submit">
                        <i class="ace-icon fa fa-save align-center"></i>
                        <b>Guardar</b>
                    </button>
                    <a class="btn btn-danger btn-round" href="{{ route('entrada.index') }}">
                        <i class="ace-icon fa fa-exchange align-center"></i>
                        <b>Cancelar</b>
                    </a>
                </div>
            </div>
            <br>
            <div class="col-xs-12 col-sm-12">
                <div class="widget-box">
                    <div class="widget-header">
                        <h4 class="widget-title">Datos a registrar (Usuarios)</h4>
                        <span class="widget-toolbar">
                            <a href="#" data-action="settings">
                                <i class="ace-icon fa fa-cog"></i>
                            </a>
                            <a href="#" data-action="reload">
                                <i class="ace-icon fa fa-refresh"></i>
                            </a>
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </span>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main">
                        @include('sistema.selloentrada.form')
                        </div>
                    </div>
                </div>
            </div>  
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('codigoscript')
    <script>
    $(document).ready(function(){
        $("#idtematica").append("<option selected>Seleccione...</option>");
        $("#idtematica").change(function(){
            $.ajax({
                type: "GET",
                url: "{{ url('/saldotematica') }}" + "/" + $("#idtematica").val(),
                dataType: "JSON",
                success: function(data){
                    console.log(data);
                    $("#cantidad_actual").val(data[0].saldo_actual);
                },
                error: function(xhr){
                    console.log('error');
                }
            });
        });
    });
    </script>
@endsection