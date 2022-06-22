<?php
class ArticuloModelo
{

    public $idarticulo;
    public $idcategoria;
    public $codigo;
    public $nombre;
    public $stock;
    public $descripcion;
    public $imagen;
    public $condicion;

    public function getIdarticulo()
    {
        return $this->idarticulo;
    }

    public function getIdcategoria()
    {
        return $this->idcategoria;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getCondicion()
    {
        return $this->condicion;
    }

    public function setIdarticulo($idarticulo)
    {
        $this->idarticulo = $idarticulo;
    }

    public function setIdcategoria($idcategoria)
    {
        $this->idcategoria = $idcategoria;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function setCondicion($condicion)
    {
        $this->condicion = $condicion;
    }
}
