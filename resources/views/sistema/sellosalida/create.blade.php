@extends('layouts.init')

@section('styles')
	
@endsection

@section('actual','Salida de Sellos')
@section('titulo','Sellos')
@section('detalle','nuevo registro de sello de salida')

@section('cuerpo')
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            {!! Form::open(['route' => 'salida.store', 'method' => 'post']) !!}
            <div class="clearfix">
                <div class="pull-left">
                    <button class="btn btn-primary btn-round" type="submit">
                        <i class="ace-icon fa fa-save align-center"></i>
                        <b>Guardar</b>
                    </button>
                    <a class="btn btn-danger btn-round" href="{{ route('salida.index') }}">
                        <i class="ace-icon fa fa-exchange align-center"></i>
                        <b>Cancelar</b>
                    </a>
                </div>
            </div>
            <br>
            <div class="col-xs-12 col-sm-12">
                <div class="widget-box">
                    <div class="widget-header">
                        <h4 class="widget-title">Datos a registrar (Sellos de salida)</h4>
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
                        @include('sistema.sellosalida.form')
                        </div>
                    </div>
                </div>
            </div>  
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('plugin/assets/js/chosen.jquery.min.js')}}"></script>
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
                    $("#cantidad_actual").val(data[0].saldo_actual);
                    $("#costo").val(data[0].costo);
                    $("#cantidad_salida").val("");
                    $("#total").val("");
                },
                error: function(xhr){
                    console.log('error');
                }
            });
        });

        if(!ace.vars['touch']) {
            $('.chosen-select').chosen({allow_single_deselect:true});
            $(window)
            .off('resize.chosen')
            .on('resize.chosen', function() {
                $('.chosen-select').each(function() {
                        var $this = $(this);
                        $this.next().css({'width': $this.parent().width()});
                })
            }).trigger('resize.chosen');
            $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
                if(event_name != 'sidebar_collapsed') return;
                $('.chosen-select').each(function() {
                        var $this = $(this);
                        $this.next().css({'width': $this.parent().width()});
                })
            });
        }

        $("#cantidad_salida").on("change keyup", function(){
            var total = 0;
            if (isNaN(parseFloat($("#cantidad_salida").val()))) {
                total = 0;
            } else {
                total = parseFloat($("#cantidad_salida").val()).toFixed(2) * parseFloat($("#costo").val()).toFixed(2);
            }
            $("#total").val(total);
        });
    });
    </script>
@endsection