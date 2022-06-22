<?php

class UsuarioModelo
{

    public $idusuario;
    public $nombre;
    public $tipo_documento;
    public $num_documento;
    public $direccion;
    public $telefono;
    public $email;
    public $cargo;
    public $login;
    public $clave;
    public $imagen;
    public $condicion;
    public $ip;

    public function getIdusuario()
    {
        return $this->idusuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getTipo_documento()
    {
        return $this->tipo_documento;
    }

    public function getNum_documento()
    {
        return $this->num_documento;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCargo()
    {
        return $this->cargo;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getCondicion()
    {
        return $this->condicion;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setTipo_documento($tipo_documento)
    {
        $this->tipo_documento = $tipo_documento;
    }

    public function setNum_documento($num_documento)
    {
        $this->num_documento = $num_documento;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function setClave($clave)
    {
        $this->clave = $clave;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function setCondicion($condicion)
    {
        $this->condicion = $condicion;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }
}
