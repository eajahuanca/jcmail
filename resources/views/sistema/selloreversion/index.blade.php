@extends('layouts.init')

@section('styles')
    <link rel="stylesheet" href="{{ asset('/assets/jqwidgets/styles/jqx.base.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/assets/jqwidgets/styles/jqx.energyblue.css') }}" type="text/css" />

@endsection

@section('actual','Reversion de Sellos')
@section('titulo','Reversiones')
@section('detalle','listado de reversion de sellos')

@section('cuerpo')
    <div class="form-group">
        <div class="row">
            <div class="col-xs-12 pull-left">
                <a href="{{ route('reversion.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva Reversion</a>
                <a class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Reporte</a>
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
        });
    </script>
@endsection