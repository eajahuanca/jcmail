@extends('layouts.init')

@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/jqwidgets/styles/jqx.base.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/assets/jqwidgets/styles/jqx.energyblue.css') }}" type="text/css" />
    
@endsection

@section('actual','Sellos de entrada')
@section('titulo','Sellos')
@section('detalle','listado de sellos de entrada registrados')

@section('cuerpo')
    <div class="form-group">
		<div class="row">
			<div class="col-xs-12 pull-left">
				<a href="{{ route('entrada.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva Entrada de Sellos</a>
				<a class="btn btn-danger" id="btnreporte_ingreso"><i class="fa fa-file-pdf-o"></i> Reporte</a>
			</div>
		</div>
		<div class="row">
            <div class="col-xs-12">
                <div id="jqxWidget" style="font-size: 9px; font-family: Verdana;margin-top: 10px;">
                    <div id="gridEntradas"></div>
                </div>
            </div>
		</div>
	</div>

    <div class="modal fade" id="modalFechaIngreso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {!! Form::open(["name"=>"formFechaEntrada", "id"=>"formFechaEntrada"]) !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-calendar"></i> Fecha de Reporte de Entradas</h5>
                </div>
                <div class="modal-body">
                    <label for="fecha_reporte"><code>(*)</code> Ingrese una fecha de entrada</label>
                    <input type="date" name="fecha_reporte" id="fecha_reporte" class="form-control" required />
                    <code>Nota.- Los campos con (*) son requeridos</code>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btnEnviarFechaEntrada">Obtener Reporte de Ingreso</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/assets/jqwidgets/jqxcore.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/jqwidgets/jqxdata.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/jqwidgets/jqxbuttons.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/jqwidgets/jqxscrollbar.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/jqwidgets/jqxmenu.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/jqwidgets/jqxgrid.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/jqwidgets/jqxgrid.grouping.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/jqwidgets/jqxgrid.selection.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/jqwidgets/jqxgrid.filter.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/jqwidgets/jqxgrid.sort.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/jqwidgets/jqxdropdownlist.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/jqwidgets/jqxlistbox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/jqwidgets/jqxcheckbox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/jqwidgets/jqxgrid.pager.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/jqwidgets/jqxdatetimeinput.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/jqwidgets/jqxcalendar.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/widgets/base.js') }}"></script>

@endsection
@section('codigoscript')
    <script>
        $(document).ready(function () {
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'id', type: 'int' },
                    { name: 'tematica', type: 'string' },
                    { name: 'cantidad_actual', type: 'int' },
                    { name: 'cantidad_nueva', type: 'int' },
                    { name: 'costo' },
                    { name: 'cantidad_total' },
                    { name: 'created_at', type: 'string' }
                ],
                url: "{{ url('/listadoentrada') }}"
            };

            var dataAdapter = new $.jqx.dataAdapter(source);
            var options = getBasicGrid(dataAdapter);
            options.height = 500;
            options.theme = 'energyblue';
            options.columns = [
                { text: 'Temática', datafield: 'tematica', sortable: true, filterable: true, groupable: false, cellsalign: 'center' },
                { text: 'Cantidad Actual', datafield: 'cantidad_actual', width: '150px', filterable: false, cellsalign: 'center' },
                { text: 'Cantidad Nueva', datafield: 'cantidad_nueva', width: '150px', filterable: false, cellsalign: 'center' },
                { text: 'Costo (Bs.)', datafield: 'costo', width: '150px', filterable: false, cellsalign: 'center' },
                { text: 'Total', datafield: 'cantidad_total', width: '150px', filterable: false, cellsalign: 'center' },
                { text: 'Fecha de Registro', datafield: 'created_at', width: '150px', filterable: false, cellsalign: 'center' },
                {
                    text: '',
                    datafield: 'id',
                    width: '150px',
                    sortable: false,
                    filterable: false,
                    groupable: false,
                    cellsrenderer: function(row, col, value, html, other) {
                        var element = $(html).html("" +
                            "<button onclick='notaEntrada(" + value + ")' class='btn btn-danger btn-rounded' title='Nota de Entrada'><i class='fa fa-file-pdf-o'></i></button> ");
                        return element[0].outerHTML;
                    }
                    //"<button onclick='editarEntrada(" + value + ")' class='btn btn-primary' title='Editar Entrada'><i class='fa fa-edit'></i></button> " +
                    //"<button onclick='eliminarEntrada(" + value + ")' class='btn btn-warning' title='Eliminar Entrada'><i class='fa fa-trash'></i></button> ");
                }
            ];

            $("#gridEntradas").jqxGrid(options);

            $('#btnreporte_ingreso').on('click', function(){
                $('#modalFechaIngreso').modal('show');
            });

            $('#btnEnviarFechaEntrada').on('click', function(eve){
                eve.preventDefault();
                var data = $('#formFechaEntrada').serialize();
                $.ajax({
                    cache: false,
                    type: 'POST',
                    url: "{{ url('/fechaentradareporte') }}",
                    contentType: false,
                    processData: false,
                    data: data,
                    xhrFields: {
                        responseType: 'blob'
                    },
                    /*success: function(response){
                        var blob = new Blob([response.pdf_stream], { type: 'application/pdf', endings: 'native' });
                        var url = window.URL.createObjectURL(blob);
                        var a = document.createElement("a");
                        a.href = url;
                        a.target = "_blank";
                        a.download = response.filename;
                        a.click();
                        //window.URL.revokeObjectURL(url);

                    },*/
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function (response, status, xhr) {

                        var filename = "";
                        var disposition = xhr.getResponseHeader('Content-Disposition');

                        if (disposition) {
                            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                            var matches = filenameRegex.exec(disposition);
                            if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                        }
                        var linkelem = document.createElement('a');
                        try {
                            var blob = new Blob([response], { type: 'application/pdf' });

                            if (typeof window.navigator.msSaveBlob !== 'undefined') {
                                //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                                window.navigator.msSaveBlob(blob, filename);
                            } else {
                                var URL = window.URL || window.webkitURL;
                                var downloadUrl = URL.createObjectURL(blob);

                                if (filename) {
                                    // use HTML5 a[download] attribute to specify filename
                                    var a = document.createElement("a");

                                    // safari doesn't support this yet
                                    if (typeof a.download === 'undefined') {
                                        window.location = downloadUrl;
                                    } else {
                                        a.href = downloadUrl;
                                        a.download = filename;
                                        document.body.appendChild(a);
                                        a.target = "_blank";
                                        a.click();
                                    }
                                } else {
                                    window.location = downloadUrl;
                                }
                            }

                        } catch (ex) {
                            console.log(ex);
                        }
                    },
                    error: function (xhr){
                        console.log(xhr);
                    }
                });
            });
        });
    </script>
@endsection