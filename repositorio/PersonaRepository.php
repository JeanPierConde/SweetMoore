<?php
//incluir la conexion de base de datos
require_once "../modelo/PersonaModelo.php";
require_once "../config/Conexion.php";
class Persona
{
	//implementamos nuestro constructor
	public function __construct()
	{
	}

	//metodo insertar regiustro
	public function insertar(PersonaModelo $datos)
	{
		//$sql = "INSERT INTO persona (tipo_persona,nombre,tipo_documento,num_documento,direccion,telefono,email) VALUES ('$datos->tipo_persona','$datos->nombre','$datos->tipo_documento','$datos->num_documento','$datos->direccion','$datos->telefono','$datos->email')";
		$sql = "CALL usp_clienteproveedor_insertar('$datos->tipo_persona',
										  		    '$datos->nombre',
										  		    '$datos->tipo_documento',
										  		    '$datos->num_documento',
													'$datos->direccion',
													'$datos->telefono',
													'$datos->email',
													@PO_CODE,
													@PO_MESSAGE)";
		return ejecutarConsulta($sql);
	}

	public function editar(PersonaModelo $datos)
	{
		//$sql = "UPDATE persona SET tipo_persona='$datos->tipo_persona', nombre='$datos->nombre',tipo_documento='$datos->tipo_documento',num_documento='$datos->num_documento',direccion='$datos->direccion',telefono='$datos->telefono',email='$datos->email' 
	//WHERE idpersona='$datos->idpersona'";

		$sql = "CALL usp_clienteproveedor_actualizar('$datos->idpersona',
													 '$datos->tipo_persona',
													 '$datos->nombre',
													 '$datos->tipo_documento',
													 '$datos->num_documento',
													 '$datos->direccion',
													 '$datos->telefono',
													 '$datos->email',
													 @PO_CODE,
													 @PO_MESSAGE)";

		return ejecutarConsulta($sql);
	}
	//funcion para eliminar datos
	public function eliminar($idpersona)
	{
		//$sql = "DELETE FROM persona WHERE idpersona='$idpersona'";
		$sql = "CALL usp_clienteproveedor_eliminar('$idpersona',
												   @PO_CODE,
												   @PO_MESSAGE)";
		return ejecutarConsulta($sql);
	}

	//metodo para mostrar registros
	public function mostrar($idpersona)
	{
		//$sql = "SELECT * FROM persona WHERE idpersona='$idpersona'";
		$sql = "CALL usp_clienteproveedor_buscar_id('$idpersona',
												    @PO_CODE,
												    @PO_MESSAGE)";
		return ejecutarConsultaSimpleFila($sql);
	}

	//listar registros
	public function listarp()
	{
		//$sql = "SELECT * FROM persona WHERE tipo_persona='Proveedor'";
		$sql = "CALL usp_clienteproveedor_listar('Proveedor',
												 @PO_CODE,
												 @PO_MESSAGE)";
		return ejecutarConsulta($sql);
	}
	public function listarc()
	{
		//$sql = "SELECT * FROM persona WHERE tipo_persona='Cliente'";
		$sql = "CALL usp_clienteproveedor_listar('Cliente',
												 @PO_CODE,
												 @PO_MESSAGE)";
		return ejecutarConsulta($sql);
	}
	public function listarc2()
	{
		//$sql = "SELECT * FROM persona WHERE tipo_persona='Cliente' AND idpersona <> 8";
		$sql = "CALL usp_clienteproveedor_listar_condicion(@PO_CODE,@PO_MESSAGE)";
		return ejecutarConsulta($sql);
	}

}
