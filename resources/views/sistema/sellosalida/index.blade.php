@extends('layouts.init')

@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/jqwidgets/styles/jqx.base.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/assets/jqwidgets/styles/jqx.mopsv.min.css') }}" type="text/css" />
    <style>
        .gridEntradas{
            font-family:arial !important;
            font-size:14px !important;
        }
    </style>
@endsection

@section('actual','Salida de Sellos')
@section('titulo','Sellos')
@section('detalle','listado de sellos registrados')

@section('cuerpo')
    <div class="form-group">
		<div class="row">
			<div class="col-xs-12 pull-left">
				<a href="{{ route('salida.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva Salida de Sellos</a>
				<a class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Reporte</a>
			</div>
		</div>
		<div class="row">
            <div class="col-xs-12">
                <div class="jqxgrid-container" style="margin-top: 20px">
                    <div id="gridSalidas"></div>
                </div>
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
                    { name: 'fecha_salida', type: 'date' },
                    { name: 'cite_manual', type: 'string' },
                    { name: 'unidad', type: 'string' },
                    { name: 'regional', type: 'string' },
                    { name: 'tematica', type: 'string' },
                    { name: 'cantidad_actual', type: 'int' },
                    { name: 'cantidad_salida', type: 'int' },
                    { name: 'costo' },
                    { name: 'total' },
                    { name: 'created_at', type: 'date' }
                ],
                url: "{{ url('/listadosalida') }}"
            };

            var dataAdapter = new $.jqx.dataAdapter(source);
            var options = getBasicGrid(dataAdapter);
            options.height = 500;
            options.columns = [
                { text: 'Fecha Salida', datafield: 'fecha_salida', sortable: true, filterable: false, width: '120px' },
                { text: 'Cite Manual', datafield: 'cite_manual', sortable: true, filterable: false, width: '120px' },
                { text: 'Unidad Solicitante', datafield: 'unidad', sortable: true, filtertype: 'checkedlist', width: '160px' },
                { text: 'Regional', datafield: 'regional', sortable: true, filtertype: 'checkedlist', width: '160px' },
                { text: 'Temática', datafield: 'tematica', sortable: true, filtertype: 'checkedlist' },
                { text: 'Costo (Bs.)', datafield: 'costo', width: '80px', filterable: false, cellsalign: 'center' },
                { text: 'Cantidad Actual', datafield: 'cantidad_actual', width: '120px', filterable: false, cellsalign: 'center' },
                { text: 'Cantidad Salida', datafield: 'cantidad_salida', width: '120px', filterable: false, cellsalign: 'center' },
                { text: 'Total', datafield: 'total', width: '150px', filterable: false, cellsalign: 'center' },
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
                            "<button onclick='editarSalida(" + value + ")' class='btn btn-primary' title='Editar Salida'><i class='fa fa-edit'></i></button> " +
                            "<button onclick='eliminarSalida(" + value + ")' class='btn btn-warning' title='Eliminar Salida'><i class='fa fa-trash'></i></button> " +
                            "<button onclick='notaSalida(" + value + ")' class='btn btn-danger' title='Nota de Remisión'><i class='fa fa-file-pdf-o'></i></button> ");
                        return element[0].outerHTML;
                    }
                }
            ];

            $("#gridSalidas").jqxGrid(options);
        });
    </script>
@endsection