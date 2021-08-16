<?php

require(realpath($_SERVER['DOCUMENT_ROOT']."/models/clubestrella/persona.php"));

class cliente extends persona2
{
	
	public $numeroSocio;
	public $empresa;
	public $telefono;
	public $pais;
	public $ciudad;
	public $estado;
	public $codigoPostal;
	public $direccion;
	public $puntos;
	public $fecha;
	public $isActive;
	/*Contiene los articulos y sus cantidades*/
	public $carrito;

	function __construct(){}
	public function setPuntos($puntos){ $this->puntos=$puntos;}
	public function getPuntos(){return $this->puntos;}

	public function getNumeroSocio(){ return $this->numeroSocio;}
	public function setNumeroSocio($numeroSocio){ $this->numeroSocio=$numeroSocio;}

	public function getEmpresa(){ return $this->empresa; }
	public function setEmpresa($empresa){ $this->empresa = $empresa; }

	public function getTelefono(){ return $this->telefono; }
	public function setTelefono($telefono){ $this->telefono = $telefono; }

	public function getPais(){ return $this->pais; }
	public function setPais($pais){ $this->pais = $pais; }

	public function getCiudad(){ return $this->ciudad; }
	public function setCiudad($ciudad){ $this->ciudad = $ciudad; }

	public function getEstado(){ return $this->estado; }
	public function setEstado($estado){ $this->estado = $estado; }

	public function getCodigoPostal(){ return $this->codigoPostal; }
	public function setCodigoPostal($codigoPostal){ $this->codigoPostal = $codigoPostal; }

	public function getDireccion(){ return $this->direccion; }
	public function setDireccion($direccion){ $this->direccion = $direccion; }

	public function setFecha($fecha){ $this->fecha=$fecha;}
	public function getFecha(){ return $this->fecha;}

	public function setCarrito($carrito){ $this->carrito=$carrito;}
	public function getCarrito(){ return $this->carrito;}

	public function setIsActive($isActive){ $this->isActive=$isActive;}
	public function getIsActive(){ return $this->isActive;}

}


?>