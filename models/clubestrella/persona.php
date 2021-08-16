<?php
require(realpath($_SERVER['DOCUMENT_ROOT']."/models/clubestrella/user.php"));

class persona2 extends user2
{

	public $nombre;
	public $apellidoPaterno;
	public $apellidoMaterno;

	function __construct(){}

	public function getNombre(){ return $this->nombre; }
	public function setNombre($nombre){ $this->nombre = $nombre; }

	public function getApellidoPaterno(){ return $this->apellidoPaterno; }
	public function setApellidoPaterno($apellidoPaterno){ $this->apellidoPaterno = $apellidoPaterno; }

	public function getApellidoMaterno(){ return $this->apellidoMaterno; }
	public function setApellidoMaterno($apellidoMaterno){ $this->apellidoMaterno = $apellidoMaterno; }

}

?>