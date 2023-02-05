<?php
class Turno{
	private $id;
	private $dia;
	private $hora_i;
	private $hora_f;
	private $tiempo;
	private $rut;


	public function Turno($id,$dia,$hora_i,$hora_f,$tiempo,$rut){
		$this->id  = $id;
		$this->dia = $dia;
		$this->hora_i = $hora_i;
		$this->hora_f = $hora_f;
		$this->tiempo = $tiempo;
		$this->rut = $rut;
	}

	public function getId(){
		return $this->id;
	}

	public function getDia(){
		return $this->dia;
	}

	public function getHora_I(){
		return $this->hora_i;
	}

	public function getHora_F(){
		return $this->hora_f;
	}

	public function getTiempo(){
		return $this->tiempo;
	}

	public function getRut(){
		return $this->rut;
	}
}
?>