<?php
class Usuaria{
	private $rut;
    private $nombre;
    private $clave;


	public function Usuaria($rut,$nombre,$clave){
		$this->rut = $rut;
        $this->nombre = $nombre;
        $this->clave = $clave;
	}

	public function getRut(){
		return $this->rut;
	}
    public function getNombre(){
		return $this->nombre;
	}
    public function getClave(){
		return $this->clave;
	}
}
?>