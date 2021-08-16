<?php 

class mapa{

	public $idCity;
	public $nombre;
	public $pais;
	public $latitud;
	public $longitud;

	public function setId($idCity){ $this->idCity = $idCity;}
	public function getId(){ return $this->idCity;}

	public function setNombre($nombre){ $this->nombre = $nombre;}
	public function getNombre(){ return $this->nombre;}

	public function setPais($pais){ $this->pais = $pais;}
	public function getPais(){ return $this->pais;}

	public function setLatitud($latitud){ $this->latitud = $latitud;}
	public function getLatitud(){ return $this->latitud; }

	public function setLongitud($longitud){ $this->longitud = $longitud;}
	public function getLongitud(){ return $this->longitud;}
}

?>