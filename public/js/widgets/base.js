var jqxTheme = 'mopsv';
var localization = {};
localization.percentsymbol = "%";
localization.currencysymbol = "Bs";
localization.currencysymbolposition = "anterior";
localization.decimalseparator = ",";
localization.thousandsseparator = ".";
localization.pagergotopagestring = "Ir a página";
localization.pagershowrowsstring = "Mostrar filas";
localization.pagerrangestring = " de ";
localization.pagerpreviousbuttonstring = "Previo";
localization.pagernextbuttonstring = "Siguiente";
localization.groupsheaderstring = "Arrastre una columna para que se agrupe por ella";
localization.sortascendingstring = "Ordenar Acs";
localization.sortdescendingstring = "Ordenar Des";
localization.sortremovestring = "Quitar orden";
localization.groupbystring = "Agrupar por esta columna";
localization.groupremovestring = "Quitar de grupos";
localization.filterclearstring = "Limpiar";
localization.filterstring = "Filtro";
localization.filtershowrowstring = "Mostrar filas donde=";
localization.filtershowrowdatestring = "Mostrar filas donde fecha=";
localization.filterorconditionstring = "O";
localization.filterandconditionstring = "Y";
localization.filterselectallstring = "(Seleccionar Todo)";
localization.filterchoosestring = "Por favor seleccione:";
localization.filterstringcomparisonoperators = ['vacio', 'no vacio', 'contenga', 'contenga(coicidir Mayusculas/Minusculas)',
    'no contenga', 'no contenga(coincidir Mayusculas/Minusculas)', 'inicia con', 'inicia con(coicidir Mayusculas/Minusculas)',
    'termina con', 'termina con(coicidir Mayusculas/Minusculas)', 'igual', 'igual(coicidir Mayusculas/Minusculas)', 'null', 'no null'
]
localization.filternumericcomparisonoperators = ['=', '!=', '<', '<=', '>', '>=', 'null', 'no null'];
localization.filterdatecomparisonoperators = ['=', '!=', '<', '<=', '>', '>=', 'null', 'no null'];
localization.filterbooleancomparisonoperators = ['=', '!='];
localization.validationstring = "Valor no valido";
localization.emptydatastring = "No hay registros que mostrar";
localization.filterselectstring = "Seleccione un Filtro";
localization.loadtext = "Cargando…";
localization.clearstring = "Limpiar";
localization.todaystring = "Hoy";
localization.days = {
    names: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
    namesAbbr: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
    namesShort: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"]
};
localization.months = {
    names: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Augosto", "Septiembre", "Octubre", "Noviembre", "Diciembre", ""],
    namesAbbr: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic", ""]
};

/**
 * Retorn una grilla basica
 *
 * @param source
 * @returns {{width: string, theme: string, pageable: boolean, sortable: boolean, autorowheight: boolean, source: *, localization: {}, keyboardnavigation: boolean, filterable: boolean, showfilterrow: boolean, groupable: boolean}}
 */
function getBasicGrid(source) {
    var grid = {
        width: "100%",
        theme: jqxTheme,
        pageable: true,
        sortable: true,
        autorowheight: true,
        source: source,
        localization: localization,
        keyboardnavigation: true,
        filterable: true,
        showfilterrow: true,
        groupable: true

    };
    return grid;
}

/**
 * Retorna un treegrid bascico
 * @param source
 * @returns {{width: string, filterMode: string, source: *, localization: {}, theme: string, filterable: boolean, sortable: boolean}}
 */
function getBasicTreeGrid(source) {
    var grid = {
        width: '100%',
        filterMode: 'advanced',
        source: source,
        localization: localization,
        theme: jqxTheme,
        filterable: true,
        sortable: true
    };
    return grid;
}

getEstadoBadget = function(estado) {
    switch (estado.toUpperCase()) {
        case "ACTIVO":
            return '<span class="label label-flat border-primary text-primary-600">ACTIVO</span>';
            break;
        case "CONCLUIDO":
            return '<span class="label label-flat border-success text-success-600">CONCLUIDO</span>';
            break;
        case "SUSPENDIDO":
            return '<span class="label label-flat border-danger text-danger-600">SUSPENDIDO</span>';
            break;
        case "CANCELADO":
            return '<span class="label label-flat border-grey text-grey-600">CANCELADO</span>';
            break;

    }
};


/**
 * Funciones que renderizan informacio para el tree grid
 * @type {{date: treeRenderers.date, progress: treeRenderers.progress, usuarios: treeRenderers.usuarios}}
 */
var treeRenderers = {
    /***
     * Se encarga de renderizar un fecha con formato DD/MM/YYYY
     * @param row
     * @param column
     * @param value
     * @param defaultHtml
     */
    date: function(row, column, value, rowData, defaultHtml) {
        if (typeof(val) == "string") {
            val = moment.utc(val, "YYYY-MM-DD").toDate();
        }
        val = moment(value).format('DD/MM/YYYY');
        return val;
    },
    /**
     * Renderiza un barra de proceso con valore de 0 a 100
     * en caso que el valor este entre 0 y 70 muestra un color rojo,
     * en caso que el valor este entre 71 y 90 muestra un color naranja,
     * en caso que el valor este entre 91 y 100 muestra un color verde.
     *
     * @param row
     * @param column
     * @param value
     * @param defaultHtml
     */
    progress: function(row, column, value, rowData, defaultHtml) {

        var className = "success";

        if (value < 70) {
            className = "danger";
        }
        if (value > 70 && value < 91) {
            className = "warning";
        }

        element = '<div class="progress progress-rounded">' +
            '<div class="progress-bar progress-bar-' + className + '" style="width: ' + value + '%">' +
            '<span>' + value + '%</span>' +
            '</div>' +
            '</div>';
        return element;
    },
    /**
     * Se encarga de renderizar los datos de un usuario con su fotografia
     * @param row
     * @param column
     * @param value
     * @param html
     */
    usuarios: function(row, column, value, rowData, html) {
        var usuarioHtml = "";
        if (!value) return usuarioHtml;
        $.each(value, function(index, usuario) {
            usuarioHtml += '' +
                '<a href="#" data-popup="lightbox">' +
                '<img src="https://hades.oopp.gob.bo/media/' + usuario.fotografia + '" style="width: 30px; height: 30px;" class="img-circle img-md" alt="' + usuario.nombre_completo + '"> ' +
                '</a>';
        });
        return usuarioHtml;
    },
    /**
     * Retorna el estado con un badget para mejorar al visualizacion
     * @param row
     * @param column
     * @param value
     */
    estados: function(row, column, value) {
        return getEstadoBadget(value)
    }
};


var renderers = {
    /***
     * Se encarga de renderizar un fecha con formato DD/MM/YYYY
     * @param row
     * @param column
     * @param value
     * @param defaultHtml
     */
    date: function(row, column, value, defaultHtml) {
        var val;
        if (value === null) { val = ""; } else if (typeof(value) == "string") {
            val = moment(value, "YYYY-MM-DD").toDate();
        } else {
            val = moment(value).format('DD/MM/YYYY');
        }
        element = $(defaultHtml).html(val);
        element.css({ 'text-align': 'right' });
        return element[0].outerHTML;
    },
    /**
     * Renderiza un barra de proceso con valore de 0 a 100
     * en caso que el valor este entre 0 y 70 muestra un color rojo,
     * en caso que el valor este entre 71 y 90 muestra un color naranja,
     * en caso que el valor este entre 91 y 100 muestra un color verde.
     *
     * @param row
     * @param column
     * @param value
     * @param defaultHtml
     */
    progress: function(row, column, value, defaultHtml) {

        var className = "success";

        if (value < 70) {
            className = "danger";
        }
        if (value > 70 && value < 91) {
            className = "warning";
        }

        element = $(defaultHtml).html(
            '<div class="progress progress-rounded">' +
            '<div class="progress-bar progress-bar-' + className + '" style="width: ' + value + '%">' +
            '<span>' + value + '%</span>' +
            '</div>' +
            '</div>');
        element.css({ 'text-align': 'right' });
        return element[0].outerHTML;
    },
    /**
     * Se encarga de renderizar los datos de un usuario con su fotografia
     * @param row
     * @param column
     * @param value
     * @param html
     */
    usuarios: function(row, column, value, html) {
        var element = $(html);
        var usuarioHtml = "";
        if (!value) return html;
        $.each(value, function(index, usuario) {
            usuarioHtml += '' +
                '<a href="#" data-popup="lightbox">' +
                '<img src="https://hades.oopp.gob.bo/media/' + usuario.fotografia + '" style="width: 40px; height: 40px;" class="img-circle img-md" alt="' + usuario.nombre_completo + '" title="' + usuario.nombre_completo + '"> ' +
                '</a>' +
                '';
        });
        element.html(usuarioHtml);
        return element[0].outerHTML;
    },
    estados: function(row, column, value, html) {
        return getEstadoBadget(value)
    }
};

/***
 * Se encarga de enviar una petcion ajax al sevidor
 * @param method    Metodo de la peticio
 * @param url       url de la peticion
 * @param data      Datos que contendra la peticion
 * @param dark      Contenido html que se bloqueara mientras se realiza la peticion
 */
sendAjax = function(method, url, data, callback, dark) {
    var dark = dark || $("body");
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
                callback(data);
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
};


/***
 * Se encarga de enviar una petcion ajax al sevidor, que contenga archivos
 * @param method    Metodo de la peticio
 * @param url       url de la peticion
 * @param data      Datos que contendra la peticion
 * @param dark      Contenido html que se bloqueara mientras se realiza la peticion
 */
sendFileAjax = function(method, url, data, callback, dark) {

    var dark = dark || $("body");
    $.ajax({
        type: method,
        data: data,
        url: url,
        contentType: false,
        cache: false,
        processData: false,
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
                callback(data);
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
};

/**
 * Retorna un paramtro de la url
 * @param name
 * @returns {string}
 */
function getParameterByName(name) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}