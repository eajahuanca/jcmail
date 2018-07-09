@extends('layouts.init')

@section('styles')
	
@endsection

@section('actual','Sellos de entrada')
@section('titulo','Sellos')
@section('detalle','nuevo registro de sello de entrada')

@section('cuerpo')

    <div class="row">
        <div class="col-xs-12 col-sm-12">
            
            <div class="clearfix">
                <div class="pull-left">
                    <button class="btn btn-primary btn-round" type="submit" id="btnsubmit">
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
                        <h4 class="widget-title">Datos a registrar (Sellos de ingreso)</h4>
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
            <div class="col-xs-12 col-sm-12" id="div-detalle">
                <div class="widget-box">
                    <div class="widget-header">
                        <h4 class="widget-title">Detalle de registro</h4>
                        <span class="widget-toolbar">
                            <a href="#" data-action="settings">
                                <i class="ace-icon fa fa-cog"></i>
                            </a>
                            <a href="#" data-action="reload">
                                <i class="ace-icon fa fa-refresh"></i>
                            <a href="#" data-action="collapse">
                            </a>
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </span>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main">
                            {!! Form::open(['route' => 'entrada.store', 'method' => 'post', "id" => "formingreso"]) !!}
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color:#A9D0F5">
                                    <th> Nro. </th>
                                    <th>Temática</th>
                                    <th>Cantidad Actual</th>
                                    <th>Cantidad Ingreso</th>
                                    <th>Total</th>
                                    <th></th>
                                </thead>
                                <tbody>
                            
                                </tbody>
                            </table>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('plugin/assets/js/chosen.jquery.min.js')}}"></script>
@endsection

@section('codigoscript')
    <script>
    $(document).ready(function(){
        $("#idtematica").append("<option selected>Seleccione ...</option>");
        $("#idtematica").change(function(){
            $.ajax({
                type: "GET",
                url: "{{ url('/saldotematica') }}" + "/" + $("#idtematica").val(),
                dataType: "JSON",
                success: function(data){
                    $("#cantidad_actual").val(data[0].saldo_actual);
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

        $("#div-detalle").hide();
        $("#bt_add").click(function(){
            agregar();
        });

        var cont = 1;
        agregar = function(){
            var tematica = $("#idtematica option:selected").text();
            var idtematica = $("#idtematica").val();
            var cantidadActual = $("#cantidad_actual").val();
            var cantidadNueva = $("#cantidad_nueva").val();
            var total = parseFloat(cantidadActual) + parseFloat(cantidadNueva);
           
            if (cantidadNueva!="" && cantidadActual != ""){
                if (parseFloat(cantidadNueva) > 0){
                    var fila =  '<tr class="selected" id="fila'+cont+'">' +
                                    '<td align="center">'+cont+'</td>' +
                                    '<td><input type="hidden" name="idtematica[]" value="'+idtematica+'">'+tematica+'</td>' +
                                    '<td align="center"><input type="hidden" name="cantidad_actual[]" value="'+parseFloat(cantidadActual).toFixed(2)+'">'+ parseFloat(cantidadActual).toFixed(2) +'</td>' +
                                    '<td align="center"><input type="hidden" name="cantidad_nueva[]" value="'+parseFloat(cantidadNueva).toFixed(2)+'">'+ parseFloat(cantidadNueva).toFixed(2) +'</td>' +
                                    '<td align="right">'+ total.toFixed(2) +'</td>'+
                                    '<td align="center"><button type="button" class="btn btn-danger" onclick="eliminar('+cont+');"><i class="ace-icon fa fa-trash"></i></button></td>' +
                                '</tr>';
                    cont++;
                    $("#cantidad_nueva").val("");
                    $("#cantidad_actual").val("");
                    $("#detalles").append(fila);
                }                
            }
             if(cont > 1){
                $("#div-detalle").show();
            }
        } 

        eliminar = function(index){
            $("#fila" + index).remove();
        }

        $("#btnsubmit").on("click", function(){
            $("#formingreso").submit();
        });
    });
    </script>
@endsection