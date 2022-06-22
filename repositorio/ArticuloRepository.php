<?php 
//incluir la conexion de base de datos
require_once "../modelo/ArticuloModelo.php";
require_once "../config/Conexion.php";
class Articulo{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar registro
public function insertar(ArticuloModelo $datos){
	//$sql="INSERT INTO articulo (idcategoria,codigo,nombre,stock,descripcion,imagen,condicion)
	 //VALUES ('$datos->idcategoria','$datos->codigo','$datos->nombre','$datos->stock','$datos->descripcion','$datos->imagen','1')";
	
	$sql = "CALL usp_producto_insertar('$datos->idcategoria',
									   '$datos->codigo',
									   '$datos->nombre',
									   '$datos->stock',
									   '$datos->descripcion',
									   '$datos->imagen',
									   '1', 
										@PO_CODE,
										@PO_MESSAGE)";
	
	return ejecutarConsulta($sql);
}

public function editar(ArticuloModelo $datos){
	//$sql="UPDATE articulo SET idcategoria='$datos->idcategoria',codigo='$datos->codigo', nombre='$datos->nombre',stock='$datos->stock',descripcion='$datos->descripcion',imagen='$datos->imagen' 
	//WHERE idarticulo='$datos->idarticulo'";

	$sql = "CALL usp_producto_actualizar('$datos->idarticulo',
										 '$datos->idcategoria',
										 '$datos->codigo',
										 '$datos->nombre',
										 '$datos->stock',
										 '$datos->descripcion',
										 '$datos->imagen',
										 @PO_CODE,
										 @PO_MESSAGE)";

	return ejecutarConsulta($sql);
}

public function desactivar(ArticuloModelo $idarticulo){
	//$sql="UPDATE articulo SET condicion='0' WHERE idarticulo='$idarticulo->idarticulo'";
	$sql = "CALL usp_producto_actualizar_condicion('$idarticulo->idarticulo',
												   '0', 
												   @PO_CODE,
												   @PO_MESSAGE)";
	return ejecutarConsulta($sql);
}

public function activar(ArticuloModelo $idarticulo){
	//$sql="UPDATE articulo SET condicion='1' WHERE idarticulo='$idarticulo->idarticulo'";
	$sql = "CALL usp_producto_actualizar_condicion('$idarticulo->idarticulo',
												   '1', 
												   @PO_CODE,
												   @PO_MESSAGE)";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar(ArticuloModelo $idarticulo){
	//$sql="SELECT * FROM articulo WHERE idarticulo='$idarticulo->idarticulo'";
	$sql = "CALL usp_producto_buscar_id('$idarticulo->idarticulo',
										@PO_CODE,
										@PO_MESSAGE)";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros 
public function listar(){
	//$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo, a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria";
	$sql = "CALL usp_producto_listar(@PO_CODE,@PO_MESSAGE)";
	return ejecutarConsulta($sql);
}

//listar registros activos
public function listarActivos(){
	//$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo, a.nombre,a.stock,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
	$sql = "CALL usp_producto_listar_activos(@PO_CODE,@PO_MESSAGE)";
	return ejecutarConsulta($sql);
}

//implementar un metodo para listar los activos, su ultimo precio y el stock(vamos a unir con el ultimo registro de la tabla detalle_ingreso)
public function listarActivosVenta(){
	//$sql="SELECT a.idarticulo,a.idcategoria,c.nombre as categoria,a.codigo, a.nombre,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE idarticulo=a.idarticulo ORDER BY iddetalle_ingreso DESC LIMIT 0,1) AS precio_venta,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
	$sql = "CALL usp_producto_listar_ventas_activo(@PO_CODE,@PO_MESSAGE)";
	return ejecutarConsulta($sql);
}


}
