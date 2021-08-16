<?php

class Address
{
	
	public $City;
	public $Country;
	public $Neighborhood;
	public $State;
	public $Street;
	public $ZipCode;

	function __construct($object){
		$this->setCity($object->City);
		$this->setCountry($object->Country);
		$this->setNeighborhood($object->Neighborhood);
		$this->setState($object->State);
		$this->setStreet($object->Street);
		$this->setZipCode($object->ZipCode);
	}

	public function setCity($City){ $this->City=$City;}
	public function getCity(){return $this->City;}

	public function setCountry($Country){ $this->Country=$Country;}
	public function getCountry(){return $this->Country;}

	public function setNeighborhood($Neighborhood){ $this->Neighborhood=$Neighborhood;}
	public function getNeighborhood(){return $this->Neighborhood;}

	public function setState($State){ $this->State=$State;}
	public function getState(){return $this->State;}

	public function setStreet($Street){ $this->Street=$Street;}
	public function getStreet(){return $this->Street;}

	public function setZipCode($ZipCode){ $this->ZipCode=$ZipCode;}
	public function getZipCode(){return $this->ZipCode;}
}

?>