<?php

class product
{
	
	public $Id;
	public $Name;
	public $TypeService_id;
	public $Provider_id;

	public $lastUpdate;
	public $isDeleted;

	function __construct(){}

	public function setId($Id){ $this->Id = $Id;}
	public function getId(){return $this->Id;}

	public function setName($Name){ $this->Name = $Name;}
	public function getName(){return $this->Name;}

	public function setTypeServiceId($TypeService_id){ $this->TypeService_id = $TypeService_id;}
	public function getTypeServiceId(){return $this->TypeService_id;}

	public function setProviderId($Provider_id){ $this->Provider_id = $Provider_id;}
	public function getProviderId(){return $this->Provider_id;}


	public function setLastUpdate($lastUpdate){ $this->lastUpdate=$lastUpdate;}
	public function getLastUpdate(){return $this->lastUpdate;}

	public function setIsDeleted($isDeleted){ $this->isDeleted=$isDeleted;}
	public function getIsDeleted(){return $this->isDeleted;}


}


?>