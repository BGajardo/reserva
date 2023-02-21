<?php
class Especialidad{
	private $id;
    private $especialidad;
  


	public function __construct($id,$especialidad){
		$this->id = $id;
        $this->especialidad = $especialidad;
	}

	public function getId(){
		return $this->id;
	}
   
    public function getEspecialidad(){
		return $this->especialidad;
	}
}
?>