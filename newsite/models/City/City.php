<?php

/**
* 
*/
class City{

	public $Id;
	public $IdCity;
	public $Name;
	public $IdCountry;
	public $Country;
	public $Path;

	public $Latitude;
	public $Longitude;

	public $lastUpdate;
	public $isDeleted;

	function __construct(){ }
	
	public function setId($Id){ $this->Id=$Id;}
	public function getId(){return $this->Id;}

	public function setIdCity($IdCity){ $this->IdCity=$IdCity;}
	public function getIdCity(){return $this->IdCity;}

	public function setName($Name){ $this->Name=$Name;}
	public function getName(){return $this->Name;}

	public function setIdCountry($IdCountry){ $this->IdCountry=$IdCountry;}
	public function getIdCountry(){return $this->IdCountry;}

	public function setCountry($Country){ $this->Country=$Country;}
	public function getCountry(){return $this->Country;}

	public function setPath($Path){ $this->Path=$Path;}
	public function getPath(){return $this->Path;}

	public function setLatitude($Latitude){ $this->Latitude=$Latitude;}
	public function getLatitude(){return $this->Latitude;}

	public function setLongitude($Longitude){ $this->Longitude=$Longitude;}
	public function getLongitude(){return $this->Longitude;}

	public function setLastUpdate($lastUpdate){ $this->lastUpdate=$lastUpdate;}
	public function getLastUpdate(){return $this->lastUpdate;}

	public function setIsDeleted($isDeleted){ $this->isDeleted=$isDeleted;}
	public function getIsDeleted(){return $this->isDeleted;}


}

?>