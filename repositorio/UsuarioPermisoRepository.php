<?php
//incluir la conexion de base de datos

require_once "../modelo/UsuarioModelo.php";
require_once "../config/Conexion.php";

class UsuarioPermisoRepository
{


    
	//implementamos nuestro constructor
	public function __construct()
	{
	}

    //metodo para listar permmisos marcados de un usuario especifico
	public function ListarPermisos($idusuario)
	{
		if ($idusuario == null || $idusuario == '') {
			$idusuario = 0;
		}

		clearStoredResults();
		// $sql = "SELECT * FROM usuario_permiso WHERE idusuario='$idusuario'";
		$sql = "CALL usp_usuariopermiso_buscar_idusuario('$idusuario', @PO_CODE, @PO_MESSAGE);";
		return ejecutarConsulta($sql);
	}

}