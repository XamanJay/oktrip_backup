<?php

class commission
{
	
	public $Id;
	public $Agent;

	public $lastUpdate;
	public $isDeleted;

	public $commission;

	function __construct(){}

	public function setId($Id){ $this->Id = $Id;}
	public function getId(){return $this->Id;}


	public function setAgent_Id($Agent){ $this->Agent = $Agent;}
	public function getAgent_Id(){return $this->Agent;}

	public function setlastUpdate($lastUpdate){ $this->lastUpdate=$lastUpdate;}
	public function getlastUpdate(){return $this->lastUpdate;}

	public function setisDeleted($isDeleted){ $this->isDeleted=$isDeleted;}
	public function getisDeleted(){return $this->isDeleted;}

	public function setCommission($commission){ $this->commission = $commission;}
	public function getCommission(){return $this->commission;}

}

?>