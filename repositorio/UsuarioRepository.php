<?php
//incluir la conexion de base de datos

require_once "../modelo/UsuarioModelo.php";
require_once "../config/Conexion.php";

class Usuario
{



	//implementamos nuestro constructor
	public function __construct()
	{
	}

	//metodo insertar registro
	public function RegistrarUsuario(UsuarioModelo $objUsuario, $permisos)
	{
		//$sql = "INSERT INTO usuario (nombre,tipo_documento,num_documento,direccion,telefono,email,cargo,login,clave,imagen,condicion) VALUES ('$objUsuario->nombre','$objUsuario->tipo_documento','$objUsuario->num_documento','$objUsuario->direccion','$objUsuario->telefono','$objUsuario->email','$objUsuario->cargo','$objUsuario->login','$objUsuario->clave','$objUsuario->imagen','1')";

		 $sql = "CALL usp_usuario_insertar('$objUsuario->nombre',
		 								   '$objUsuario->tipo_documento',
										   '$objUsuario->num_documento',
										   '$objUsuario->direccion',
										   '$objUsuario->telefono',
										   '$objUsuario->email',
										   '$objUsuario->cargo',
										   '$objUsuario->login',
										   '$objUsuario->clave',
										   '$objUsuario->imagen',
										   '1', 
											@PO_CODE,
											@PO_MESSAGE)";

		$rspta = ejecutarConsultaSimpleFila($sql);

		//$idusuarionew = ejecutarConsulta_retornarID($sql);
		$idusuarionew = $rspta["idUsuario"];
		$num_elementos = 0;
		$sw = true;
		while ($num_elementos < count($permisos)) {

			clearStoredResults();
			// $sql_detalle = "INSERT INTO usuario_permiso (idusuario,idpermiso) VALUES('$idusuarionew','$permisos[$num_elementos]')";
			$sql_detalle = "CALL usp_usuariopermiso_insertar('$idusuarionew',
															 '$permisos[$num_elementos]', 
															 @PO_CODE,
															 @PO_MESSAGE)";

			ejecutarConsulta($sql_detalle) or $sw = false;

			$num_elementos = $num_elementos + 1;
		}
		return $sw;
	}

	public function ActualizarUsuario(UsuarioModelo $objUsuario, $permisos)
	{
		// 	$sql = "UPDATE usuario SET nombre='$objUsuario->nombre',tipo_documento='$objUsuario->tipo_documento',num_documento='$objUsuario->num_documento',direccion='$objUsuario->direccion',telefono='$objUsuario->telefono',email='$objUsuario->email',cargo='$objUsuario->cargo',login='$objUsuario->login',clave='$objUsuario->clave',imagen='$objUsuario->imagen' 
		// WHERE idusuario='$objUsuario->idusuario'";
		// 	ejecutarConsulta($sql);

		// 	//eliminar permisos asignados
		// 	$sqldel = "DELETE FROM usuario_permiso WHERE idusuario='$objUsuario->idusuario'";
		// 	ejecutarConsulta($sqldel);
		$sql = "CALL usp_usuario_actualizar('$objUsuario->idusuario',
											'$objUsuario->nombre',
											'$objUsuario->tipo_documento',
											'$objUsuario->num_documento',
											'$objUsuario->direccion',
											'$objUsuario->telefono',
											'$objUsuario->email',
											'$objUsuario->cargo',
											'$objUsuario->login',
											'$objUsuario->clave',
											'$objUsuario->imagen', 
											@PO_CODE,
											@PO_MESSAGE)";
		ejecutarConsulta($sql);

		$num_elementos = 0;
		$sw = true;
		while ($num_elementos < count($permisos)) {

			clearStoredResults();
			// $sql_detalle = "INSERT INTO usuario_permiso (idusuario,idpermiso) VALUES('$objUsuario->idusuario','$permisos[$num_elementos]')";
			$sql_detalle = "CALL usp_usuariopermiso_insertar('$objUsuario->idusuario',
															 '$permisos[$num_elementos]', 
															 @PO_CODE,
															 @PO_MESSAGE)";
			ejecutarConsulta($sql_detalle) or $sw = false;

			$num_elementos = $num_elementos + 1;
		}
		return $sw;
	}
	public function DesactivarUsuario(UsuarioModelo $idusuario)
	{

		// $sql = "UPDATE usuario SET condicion='0' WHERE idusuario='$idusuario->idusuario'";
		$sql = "CALL usp_usuario_actualizar_condicion('$idusuario->idusuario',
													  '0', 
													  @PO_CODE,
													  @PO_MESSAGE)";
		return ejecutarConsulta($sql);
	}
	public function ActivarUsuario(UsuarioModelo $idusuario)
	{
	
		// $sql = "UPDATE usuario SET condicion='1' WHERE idusuario='$idusuario->idusuario'";
		$sql = "CALL usp_usuario_actualizar_condicion('$idusuario->idusuario',
													  '1', 
													  @PO_CODE,
													  @PO_MESSAGE)";
		return ejecutarConsulta($sql);
	}

	//metodo para mostrar registros
	public function BuscarUsuario(UsuarioModelo $idusuario)
	{

		// $sql = "SELECT * FROM usuario WHERE idusuario='$idusuario->idusuario'";
		$sql = "CALL usp_usuario_buscar_id('$idusuario->idusuario',
										   @PO_CODE,
										   @PO_MESSAGE)";
		return ejecutarConsultaSimpleFila($sql);
	}

	//listar registros
	public function ListarUsuario()
	{
	
		// $sql = "SELECT * FROM usuario";
		$sql = "CALL usp_usuario_listar(@PO_CODE,@PO_MESSAGE)";
		return ejecutarConsulta($sql);
	}

	//funcion que verifica el acceso al sistema
	public function ValidarUsuario(UsuarioModelo $datoLogin)
	{
		 //$sql = "SELECT idusuario,nombre,tipo_documento,num_documento,telefono,email,cargo,imagen,login FROM usuario WHERE login='$datoLogin->login' AND clave='$datoLogin->clave' AND condicion='1'";
		 $sql = "CALL usp_usuario_login('$datoLogin->login',
		 								'$datoLogin->clave', 
										'$datoLogin->ip', 
										 @PO_CODE, 
										 @PO_MESSAGE);";
		//return ejecutarConsulta($sql);
		return ejecutarConsulta($sql);
		//return ejecutarConsulta($sql);
	}



}
