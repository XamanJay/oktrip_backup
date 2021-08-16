<?php

/**
* 
*/
class HotelCity{

	public $Id;
	public $IdHotel;
	public $Name;
	public $ZoneName;
	public $Category;
	public $Address;

	public $City;

	public $lastUpdate;
	public $isDeleted;

	function __construct(){ }
	
	public function setId($Id){ $this->Id=$Id;}
	public function getId(){return $this->Id;}

	public function setIdHotel($IdHotel){ $this->IdHotel=$IdHotel;}
	public function getIdHotel(){return $this->IdHotel;}

	public function setName($Name){ $this->Name=$Name;}
	public function getName(){return $this->Name;}

	public function setZoneName($ZoneName){ $this->ZoneName=$ZoneName;}
	public function getZoneName(){return $this->ZoneName;}

	public function setCategory($Category){ $this->Category=$Category;}
	public function getCategory(){return $this->Category;}

	public function setAddress($Address){ $this->Address=$Address;}
	public function getAddress(){return $this->Address;}

	public function setCity($City){ $this->City=$City;}
	public function getCity(){return $this->City;}

	public function setLastUpdate($lastUpdate){ $this->lastUpdate=$lastUpdate;}
	public function getLastUpdate(){return $this->lastUpdate;}

	public function setIsDeleted($isDeleted){ $this->isDeleted=$isDeleted;}
	public function getIsDeleted(){return $this->isDeleted;}


}

?>