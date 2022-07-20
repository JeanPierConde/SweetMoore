<?php
require_once "../modelo/ArticuloModelo.php";
require_once "../repositorio/ArticuloRepository.php";
require_once "../config/util.php";

$articulo = new Articulo();
$util = new Util();

$idarticulo = isset($_POST["idarticulo"]) ? limpiarCadena($_POST["idarticulo"]) : "";
$idcategoria = isset($_POST["idcategoria"]) ? limpiarCadena($_POST["idcategoria"]) : "";
$codigo = isset($_POST["codigo"]) ? limpiarCadena($_POST["codigo"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$stock = isset($_POST["stock"]) ? limpiarCadena($_POST["stock"]) : "";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";
$imagen = isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]) : "";

$idarticulo = $util->xss_clean($idarticulo);
$idcategoria = $util->xss_clean($idcategoria);
$codigo = $util->xss_clean($codigo);
$nombre = $util->xss_clean($nombre);
$descripcion = $util->xss_clean($descripcion);

$objarticulomodelo = new ArticuloModelo();

switch ($_GET["op"]) {
	case 'guardaryeditar':

		$objarticulomodelo->setIdarticulo($idarticulo);
		$objarticulomodelo->setIdcategoria($idcategoria);
		$objarticulomodelo->setCodigo($codigo);
		$objarticulomodelo->setNombre($nombre);
		$objarticulomodelo->setStock($stock);
		$objarticulomodelo->setDescripcion($descripcion);

		if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
			$imagen = $_POST["imagenactual"];
		} else {
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png") {
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/articulos/" . $imagen);
			}
		}

		$objarticulomodelo->setImagen($imagen);

		if (empty($idarticulo)) {
			$rspta = $articulo->insertar($objarticulomodelo);
			echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
		} else {
			$rspta = $articulo->editar($objarticulomodelo);
			echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
		}
		break;


	case 'desactivar':
		$objarticulomodelo->setIdarticulo($idarticulo);
		$rspta = $articulo->desactivar($objarticulomodelo);
		echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
		break;

	case 'activar':
		$objarticulomodelo->setIdarticulo($idarticulo);
		$rspta = $articulo->activar($objarticulomodelo);
		echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
		break;

	case 'mostrar':
		$objarticulomodelo->setIdarticulo($idarticulo);
		$rspta = $articulo->mostrar($objarticulomodelo);
		echo json_encode($rspta);
		break;

	case 'listar':
		$rspta = $articulo->listar();
		$data = array();

		while ($reg = $rspta->fetch_object()) {
			$data[] = array(
				"0" => ($reg->condicion) ? '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->idarticulo . ')"><i class="fa fa-pencil"></i></button>' . ' ' . '<button class="btn btn-danger btn-xs" onclick="desactivar(' . $reg->idarticulo . ')"><i class="fa fa-close"></i></button>' : '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->idarticulo . ')"><i class="fa fa-pencil"></i></button>' . ' ' . '<button class="btn btn-primary btn-xs" onclick="activar(' . $reg->idarticulo . ')"><i class="fa fa-check"></i></button>',
				"1" => $reg->nombre,
				"2" => $reg->categoria,
				"3" => $reg->codigo,
				"4" => $reg->stock,
				"5" => "<img src='../files/articulos/" . $reg->imagen . "' height='50px' width='50px'>",
				"6" => $reg->descripcion,
				"7" => ($reg->condicion) ? '<span class="label bg-green">Activado</span>' : '<span class="label bg-red">Desactivado</span>'
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

	case 'selectCategoria':
		require_once "../repositorio/CategoriaRepository.php";
		$categoria = new Categoria();

		$rspta = $categoria->select();

		while ($reg = $rspta->fetch_object()) {
			echo '<option value=' . $reg->idcategoria . '>' . $reg->nombre . '</option>';
		}
		break;
	case 'aleatoriocodigo':
		$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$longitud = 6;
		echo substr(str_shuffle($caracteres), 0, $longitud);
		break;
}
