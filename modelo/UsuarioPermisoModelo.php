<?php

class UsuarioPermisoModelo {

    public $idusuario_permiso;
    public $idusuario;
    public $idpermiso ;
   
    public function getIdusuario_permiso() {
        return $this->idusuario_permiso;
    }

    public function getIdusuario() {
        return $this->idusuario;
    }

    public function getIdpermiso() {
        return $this->idpermiso;
    }

    public function setIdusuario_permiso($idusuario_permiso) {
        $this->idusuario_permiso = $idusuario_permiso;
    }

    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function setIdpermiso($idpermiso) {
        $this->idpermiso = $idpermiso;
    }

}
