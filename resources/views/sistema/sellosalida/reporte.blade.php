<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Formulario de Permiso</title>
    <style type="text/css">
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size:11px;
        }
        table.tableizer-table {
            font-size: 12px;
            border: 1px solid #000000;
        }
        .tableizer-table td {
            padding: 4px;
            margin: 3px;
            border: 1px solid #000000;
        }
        .tableizer-table th {
            background-color: #104E8B;
            color: #FFF;
        }
        .tableBorder{
            border: 1px solid #000000;
            border-collapse: collapse;
        }
        .tableEspaciosTitulo{
            margin-top:-2em;
            border:1px solid green;
            border-radius:5px;
            -webkit-border-radius:5px;
            -moz-border-radius:5px;
            padding: 10px;
        }
        .tableEspacioTituloPrincipal{
            margin-top: -1.5em;
            padding: 10px;
        }
        .tableEspacios{
            margin-bottom:2em;
            margin-top:-2em;
        }
        .horas{
            margin-left:13em;
            width:60%;
            text-align:center;
            font-weight:bold;
            font-size:12px;
            color:red !important;
            padding:5px;
            border:1px red solid !important;
            border-radius:4px;
        }
        .nota,.impresion{
            font-style:italic;
            font-size:9.5px;
        }
        .nombres{
            font-size: 11px;
            color: green;
            font-weight: bold;
        }
        .cites, .cites2{
            font-size: 9px;
            color: red;
            font-weight: bold;
            text-align: center;
            padding:3px;
            border: 1px red solid;
            border-radius:3px;
        }
        .cites2{
            margin-top: -1em;
        }
        .cite{
            font-size: 10px;
            color: red;
            font-weight: bold;
            text-align: right;
            margin-top: -1em;
        }
    </style>
</head>
<body>
@include('admin.fechas')
<!--ORIGINAL Y COPIA-->

<table width="100%">
    <tr>
        <td align="left" width="25  %"><img src="{{ asset('plugin/login/img/escudo_bolivia.gif') }}" width="95px" height="80px"/></td>
        <td align="center"><b>Estado Plurinacional de Bolivia</b><br><div style="font-size:9px;">Agencia Boliviana de Correos<br><hr/></div></td>
        <td align="right" width="20%"><img src="{{ asset('plugin/login/img/logo.png') }}" width="180px" height="50px"/></td>
    </tr>
</table>
<div class="tableEspacioTituloPrincipal">
    <table width="100%">
        <tr>
            <td width="4%"></td>
            <td width="4%"></td>
            <td width="4%"></td>
            <td align="center" rowspan="3" width="65%"><h2>NOTA DE REMISION</h2></td>
            <td width="5%"><div class="cites">DIA</div></td>
            <td width="5%"><div class="cites">MES</div></td>
            <td width="5%"><div class="cites">AÑO</div></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><div class="cites2">c</div></td>
            <td><div class="cites2">m</div></td>
            <td><div class="cites2">y</div></td>
        </tr>
        <tr>
            <td colspan="3"><div class="cites">cite</div></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
</div>
<br>
<div class="tableEspaciosTitulo">
    <table width="100%">
        <tr>
            <td width="100%"><div class="nombres">En atención a su solicitud con cite: AGBC/TEs, se procede a la Remisión de los Sellos de Franqueo bajo el siguiente detalle:</div></td>
            <!--td width="40%">nombre compelto</td-->
            <!--td><div class="nombres" width="10%">CARNET DE IDENTIDAD :</div></td!-->
            <!--td width="5%">dddd</td-->
        </tr>
        <tr>
            <td><div class="nombres">DETALLE :</div></td>
            <!--td colspan="3">cargooo</td-->

        </tr>
    </table>
    <table border="2px" width="100%" class="tableizer-table">
        <tr>
            <td>TEMATICA</td>
            <td>VALOR FACIAL</td>
            <td>CANTIDAD</td>
            <td>MONTO BS.</td>
        </tr>
        <tr>
            <td>{{ $salida->tematicas->tematica }}</td>
            <td>{{ $salida->costo }}</td>
            <td>{{ $salida->cantidad_salida }}</td>
            <td>{{ $salida->total }}</td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="100%"><div class="nombres">Agradecer la devolución de la Nota de Remisión hasta las 48 Hrs., a partir de su recepción con los fines de conformidad</div></td>
            <!--td width="40%">nombre compelto</td-->
            <!--td><div class="nombres" width="10%">CARNET DE IDENTIDAD :</div></td!-->
            <!--td width="5%">dddd</td-->
        </tr>

    </table>
    <table width="100%">
        <tr>
            datos
        </tr>
    </table>
    <!--div class="horas">
        DE HORAS :
    </div-->

    <table width="100%" >
        <tr>
            <!--td colspan="2"><div class="nombres">MOTIVO DEL PERMISO</div></td-->


            <td rowspan="2">{!! DNS2D::getBarcodeHTML("VIVA MEXICO CABRONES, CHINGA TU MADRE, Estampi", "QRCODE",3,3) !!}</td>
        </tr>
        <tr>
            <td width="5%"></td>
            <!--td width="95%" valign="top">dato2</td-->
        </tr>
    </table>
</div>

</body>
</html>