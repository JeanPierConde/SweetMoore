<?php
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Permiso
{


	//implementamos nuestro constructor
	public function __construct()
	{
	}

	//listar registros
	public function listar()
	{
		//$sql = "SELECT * FROM permiso";
		$sql = "CALL usp_permiso_listar(@PO_CODE,@PO_MESSAGE)";
		return ejecutarConsulta($sql);
	}
}
