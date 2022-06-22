<?php

class PermisoModelo
{

    public $idpermiso;
    public $nombre;

    public function getIdpermiso()
    {
        return $this->idpermiso;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setIdpermiso($idpermiso)
    {
        $this->idpermiso = $idpermiso;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
}
