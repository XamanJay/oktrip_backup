<?php

include("models/Sale/product.php");

class provider
{
	
	public $Id;
	public $Name;

	public $lastUpdate;
	public $isDeleted;

	function __construct(){}

	public function setId($Id){ $this->Id = $Id;}
	public function getId(){return $this->Id;}

	public function setName($Name){ $this->Name = $Name;}
	public function getName(){return $this->Name;}

	public function setLastUpdate($lastUpdate){ $this->lastUpdate=$lastUpdate;}
	public function getLastUpdate(){return $this->lastUpdate;}

	public function setIsDeleted($isDeleted){ $this->isDeleted=$isDeleted;}
	public function getIsDeleted(){return $this->isDeleted;}


}


?>