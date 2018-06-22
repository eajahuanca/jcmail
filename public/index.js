$(document).ready(function() {
    /**
     * Se encarga de inicializar los componentes
     */
    function initComponents() {
        $('.datepicker').datepicker({
            dateFormat: "dd/mm/yyyy",
            changeMonth: true,
            autoclose: true
        });
        $('#responsable').select2({
            dropdownCssClass: 'border-primary',
            containerCssClass: 'border-primary text-success-800'
        });
    }

    /***
     * Se encarga de cargar el formulario de acuerdo al espacio que fue seleccionado
     * @param espacioId
     */
    $("#listaEspaciosDisponibles").find('a').on('click', function(ev) {
        var buttonTarget = ev.currentTarget;
        if (buttonTarget) {
            var espacioId = buttonTarget.dataset['espacio'];
            $("#modalBodyFrmProyecto").load('/proyectos/form/' + espacioId, function() {
                $("#modalFormProyecto").modal("show");
            });
        }
    });

    var source = {
        datatype: "json",
        datafields: [
            { name: 'id', type: 'int' },
            { name: 'proyecto', type: 'string' },
            { name: 'descripcion', type: 'string' },
            { name: 'espacio', type: 'string' },
            { name: 'avatar ', type: 'string' },
            { name: 'aparezcoen', type: 'string' },
            { name: 'fecha_inicio', type: 'date' },
            { name: 'fecha_fin', type: 'date' },
            { name: 'fecha_finalizacion', type: 'date' },
            { name: 'avance', type: 'int' },
            { name: 'estado', type: 'string' },
            { name: 'espacio', type: 'string' },
            { name: 'responsables', type: 'string' }
        ],
        url: "/proyectos/listar"
    };

    var dataAdapter = new $.jqx.dataAdapter(source);
    var options = getBasicGrid(dataAdapter);
    options.height = 600;
    options.columns = [
        { text: 'Responsables', datafield: 'responsables', cellsrenderer: renderers.usuarios, sortable: false, filterable: false, groupable: false, width: '150px' },
        { text: 'Lista', datafield: 'aparezcoen', width: '120px', filtertype: 'checkedlist' },
        { text: 'Nombre Proyecto', datafield: 'proyecto' },
        { text: 'Espacio', datafield: 'espacio' },
        { text: 'Fecha Inicio', datafield: 'fecha_inicio', cellsrenderer: renderers.date, width: '85px', filtertype: 'range' },
        { text: 'Fecha Fin', datafield: 'fecha_fin', cellsrenderer: renderers.date, width: '85px', filtertype: 'range' },
        { text: 'Avance', datafield: 'avance', width: '110px', cellsalign: 'right', cellsrenderer: renderers.progress },
        { text: 'Estado', datafield: 'estado', width: '120px', filtertype: 'checkedlist' },
        {
            text: '',
            datafield: 'id',
            width: '130px',
            sortable: false,
            filterable: false,
            groupable: false,
            cellsrenderer: function(row, col, value, html, other) {
                var element = $(html).html("" +
                    "<button onclick='editarProyecto(" + value + ")' class='btn btn-xs btn-primary btn-icon btn-rounded legitRipple'><i class='icon-pen'></i></button> " +
                    "<button onclick='eliminarProyecto(" + value + ")' class='btn btn-xs btn-warning  btn-icon btn-rounded legitRipple'><i class='icon-trash'></i></button> " +
                    "<button onclick='concluirProyecto(" + value + ")' class='btn btn-xs btn-success  btn-icon btn-rounded legitRipple'><i class='icon-check'></i></button> " +
                    "");
                return element[0].outerHTML;
            }
        }
    ];

    $("#gridProyectos").jqxGrid(options);

    /**
     * Evento para redireccionar al detalle de un proyecto
     */
    $("#gridProyectos").on("rowdoubleclick", function(event) {
        var args = event.args;
        var proyectoId = args.row.bounddata.id;
        if (proyectoId) {
            window.location.href = '/proyectos/detalle/' + proyectoId;
        }
    });

    /**
     * Cuando se envia el formulario para el registro de nuevos proyectos
     */
    $("#frmProyecto").submit(function(ev) {
        ev.preventDefault();
        $("#dtfFechaInicio").val(moment($("#dtfFechaInicio").val(), 'DD/MM/YYYY').format("YYYY-MM-DD") + 'T00:00:00');
        $("#dtfFechaFin").val(moment($("#dtfFechaFin").val(), 'DD/MM/YYYY').format("YYYY-MM-DD") + 'T00:00:00');
        var idProyecto = $("#txtIdProyecto").val();
        var data = $("#frmProyecto").serialize();
        //$("#modalFormProyecto").modal("hide");
        var dark = $("body");

        var url = "/proyectos/save/";
        var method = "POST";

        if (parseInt(idProyecto) > 0) {
            url = "/proyectos/editar/" + idProyecto;
            method = "POST";
        }

        $.ajax({
            type: method,
            data: data,
            url: url,
            beforeSend: function() {
                $(dark).block({
                    message: '<i class="icon-spinner spinner"></i>',
                    overlayCSS: {
                        backgroundColor: '#1B2024',
                        opacity: 0.85,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'none',
                        color: '#fff'
                    }
                });
            },
            success: function(data) {
                $(dark).unblock();
                swal({
                    title: data.message,
                    type: data.type
                }, function() {
                    location.reload();
                });
            },
            error: function(xhr) {
                var errorMsg = xhr.responseJSON;
                swal({
                    title: errorMsg.message,
                    text: formErrorDataToHTML(errorMsg.data),
                    confirmButtonColor: "#EF5350",
                    type: 'error',
                    html: true
                });
                $(dark).unblock();
            }
        });

    });


    /**
     * Cuando se muestra el el modal para agregar los proyectos
     */
    $("#modalFormProyecto").on('shown.bs.modal', function() {
        initComponents();
    });

    /**
     * Cuando se cierra el el modal para agregar los proyectos
     */
    $("#modalFormProyecto").on('hidden.bs.modal', function() {
        $("#frmProyecto")[0].reset();
        $("#resposable").select2('destroy');
        $("#btnSubmit").val("Agregar Proyecto");
    });

    /**
     * Cuando se trata de eliminar un proyecto
     * @param proyectoId
     */
    eliminarProyecto = function(proyectoId) {
        proyectoData = $("#gridProyectos").jqxGrid("getrows").filter(function(el) { return el.id === proyectoId })[0];
        swal({
            title: 'Eliminar Proyectos',
            text: '<p class="text-center">Esta usted seguro de eliminar el proyecto:</p><p class="text-center"><strong>' + proyectoData.proyecto + '</strong></p>',
            type: 'warning',
            confirmButtonColor: "#ef5350",
            confirmButtonText: "Si",
            html: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    url: "/proyectos/eliminar/" + proyectoId,
                    success: function(data) {
                        swal({
                            title: data.message,
                            type: data.type
                        });
                        $("#gridProyectos").jqxGrid("deleterow", proyectoData.uid);
                    },
                    error: function(xhr) {
                        const data = xhr.responseJSON;
                        swal({
                            title: data.message,
                            type: data.type
                        });
                    }
                });
            }
        });

    };

    /**
     * Cuando se quiere concluir un proyecto
     * @param proyectoId
     */
    concluirProyecto = function(proyectoId) {
        var proyectoData = $("#gridProyectos").jqxGrid("getrows").filter(function(el) { return el.id === proyectoId })[0];
        swal({
            title: 'Concluir Proyectos',
            text: '<p class="text-center">Esta usted seguro de concluir el proyecto:</p><p class="text-center"><strong>' + proyectoData.proyecto + '</strong></p>',
            type: 'success',
            confirmButtonColor: "#4caf50",
            confirmButtonText: "Si",
            html: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    method: "POST",
                    url: "/proyectos/concluir/" + proyectoId,
                    success: function(data) {
                        swal({
                            title: data.message,
                            type: data.type
                        });
                    },
                    error: function(xhr) {
                        const data = xhr.responseJSON;
                        swal({
                            title: data.message,
                            type: data.type
                        });
                    }
                });
            }
        });
    };

    /**
     * Cuando se quiere editar un proyecto
     * @param proyectoId
     */
    editarProyecto = function(proyectoId) {
        $.ajax({
            type: "GET",
            url: "/proyectos/editar/" + proyectoId,
            success: function(data) {
                var responsables = data.responsables.map(function(responsable) {
                    return responsable.id;
                });
                $("#modalBodyFrmProyecto").load('/proyectos/form/' + data.espacio_id, function() {
                    $("#btnSubmit").val("Editar Proyecto");
                    $("#txtIdProyecto").val(data.id);
                    $("#txtProyecto").val(data.proyecto);
                    $("#txtDescripcion").val(data.descripcion);
                    $("#dtfFechaInicio").val(moment(data.fecha_inicio, 'YYYY-MM-DDTHH:mm:SS').format('DD/MM/YYYY'));
                    $("#dtfFechaFin").val(moment(data.fecha_fin, 'YYYY-MM-DDTHH:mm:SS').format('DD/MM/YYYY'));
                    $("#responsable").val(responsables);
                    $("#modalFormProyecto").modal("show");
                });
            }
        });

    };

});