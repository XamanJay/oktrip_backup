<?php

class estatus
{
	
	public $id;
	public $nombre;

	function __construct(){}

	public function setId($id){ $this->id = $id;}
	public function getId(){return $this->id;}

	public function setNombre($nombre){ $this->nombre = $nombre;}
	public function getNombre(){return $this->nombre;}

}


?>