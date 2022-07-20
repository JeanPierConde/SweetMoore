<?php
require_once "../modelo/CategoriaModelo.php";
require_once "../repositorio/CategoriaRepository.php";
require_once "../config/util.php";

$categoria = new Categoria();
$util = new Util();

$idcategoria = isset($_POST["idcategoria"]) ? limpiarCadena($_POST["idcategoria"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";

$idcategoria = $util->xss_clean($idcategoria);
$nombre = $util->xss_clean($nombre);
$descripcion = $util->xss_clean($descripcion);

$objcategoriamodelo = new CategoriaModelo();

switch ($_GET["op"]) {
	case 'guardaryeditar':

		$idcategoria = $util->xss_clean($idcategoria);
		$nombre = $util->xss_clean($nombre);
		$descripcion = $util->xss_clean($descripcion);


		$objcategoriamodelo->setIdcategoria($idcategoria);
		$objcategoriamodelo->setNombre($nombre);
		$objcategoriamodelo->setDescripcion($descripcion);

		if (empty($idcategoria)) {
			$rspta = $categoria->insertar($objcategoriamodelo);
			echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
		} else {
			$rspta = $categoria->editar($objcategoriamodelo);
			echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
		}
		break;


	case 'desactivar':
		$objcategoriamodelo->setIdcategoria($idcategoria);
		$rspta = $categoria->desactivar($objcategoriamodelo);
		echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
		break;
	case 'activar':
		$objcategoriamodelo->setIdcategoria($idcategoria);
		$rspta = $categoria->activar($objcategoriamodelo);
		echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
		break;

	case 'mostrar':
		$objcategoriamodelo->setIdcategoria($idcategoria);
		$rspta = $categoria->mostrar($objcategoriamodelo);
		echo json_encode($rspta);
		break;

	case 'listar':
		$rspta = $categoria->listar();
		$data = array();

		while ($reg = $rspta->fetch_object()) {
			$data[] = array(
				"0" => ($reg->condicion) ? '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->idcategoria . ')"><i class="fa fa-pencil"></i></button>' . ' ' . '<button class="btn btn-danger btn-xs" onclick="desactivar(' . $reg->idcategoria . ')"><i class="fa fa-close"></i></button>' : '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->idcategoria . ')"><i class="fa fa-pencil"></i></button>' . ' ' . '<button class="btn btn-primary btn-xs" onclick="activar(' . $reg->idcategoria . ')"><i class="fa fa-check"></i></button>',
				"1" => $reg->nombre,
				"2" => $util->xss_clean($reg->descripcion),
				"3" => ($reg->condicion) ? '<span class="label bg-green">Activado</span>' : '<span class="label bg-red">Desactivado</span>'
			);
		}
		$results = array(
			"sEcho" => 1, //info para datatables
			"iTotalRecords" => count($data), //enviamos el total de registros al datatable
			"iTotalDisplayRecords" => count($data), //enviamos el total de registros a visualizar
			"aaData" => $data
		);
		echo json_encode($results);
		break;
}
