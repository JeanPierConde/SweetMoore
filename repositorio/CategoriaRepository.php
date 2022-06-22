<?php 
//incluir la conexion de base de datos
require_once "../modelo/CategoriaModelo.php";
require_once "../config/Conexion.php";
class Categoria{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar(CategoriaModelo $datos){
	//$sql="INSERT INTO categoria (nombre,descripcion,condicion) VALUES ('$datos->nombre','$datos->descripcion','1')";
	$sql = "CALL usp_categoria_insertar('$datos->nombre',
									    '$datos->descripcion',
									    '1',
									    @PO_CODE,
									    @PO_MESSAGE)";
	return ejecutarConsulta($sql);
}

public function editar(CategoriaModelo $datos){
	//$sql="UPDATE categoria SET nombre='$datos->nombre',descripcion='$datos->descripcion' 
	//WHERE idcategoria='$datos->idcategoria'";

	$sql = "CALL usp_categoria_actualizar('$datos->idcategoria',
										  '$datos->nombre',
										  '$datos->descripcion',
										  @PO_CODE,
										  @PO_MESSAGE)";

	return ejecutarConsulta($sql);
}

public function desactivar(CategoriaModelo $idcategoria){
	//$sql="UPDATE categoria SET condicion='0' WHERE idcategoria='$idcategoria->idcategoria'";
	$sql = "CALL usp_categoria_actualizar_condicion('$idcategoria->idcategoria',
												    '0', 
												    @PO_CODE,
													@PO_MESSAGE)";
	return ejecutarConsulta($sql);
}

public function activar(CategoriaModelo $idcategoria){
	//$sql="UPDATE categoria SET condicion='1' WHERE idcategoria='$idcategoria->idcategoria'";
	$sql = "CALL usp_categoria_actualizar_condicion('$idcategoria->idcategoria',
													'1', 
													@PO_CODE,
													@PO_MESSAGE)";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar(CategoriaModelo $idcategoria){
	//$sql="SELECT * FROM categoria WHERE idcategoria='$idcategoria->idcategoria'";
	$sql = "CALL usp_categoria_buscar_id('$idcategoria->idcategoria',
										 @PO_CODE,
										 @PO_MESSAGE)";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar(){
	//$sql="SELECT * FROM categoria";
	$sql = "CALL usp_categoria_listar(@PO_CODE,@PO_MESSAGE)";
	return ejecutarConsulta($sql);
}

//listar y mostrar en selct
public function select(){
	//$sql="SELECT * FROM categoria WHERE condicion=1";
	$sql = "CALL usp_categoria_buscar_activo(@PO_CODE,@PO_MESSAGE)";
	return ejecutarConsulta($sql);
}

}
