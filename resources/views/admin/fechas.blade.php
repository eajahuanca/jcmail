<?php
	function day($fecha){
		$arrayFecha = explode('-', $fecha);
		$arrayDia = explode(' ', $arrayFecha[2]);
		return (int)$arrayDia[0];
	}

	function month($fecha){
		$arrayFecha = explode('-', $fecha);
		return (int)$arrayFecha[1];	
	}

	function year($fecha){
		$arrayFecha = explode('-', $fecha);
		return (int)$arrayFecha[0];	
	}

	function formatFecha($fecha){
	    $arrayMes = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
	    $arrayFecha = explode('-', $fecha);
	    return $arrayFecha[2].'/'.$arrayMes[(int)$arrayFecha[1] - 1].'/'.$arrayFecha[0];
	}
	
	function fechaPermisoDia($fecha){
		$arrayFecha = explode('-',$fecha);
		return $arrayFecha[2];
	}

	function fechaPermisoMes($fecha){
		$arrayFecha = explode('-',$fecha);
		return $arrayFecha[1];
	}

	function fechaPermisoAnio($fecha){
		$arrayFecha = explode('-',$fecha);
		return $arrayFecha[0];
	}
?>