<?php

class exchange
{

	public $id;
	public $exchange;

	public $lastUpdate;
	public $isDeleted;
	
	function __construct(){}

	public function setId($id){ $this->id = $id;}
	public function getId(){return $this->id;}

	public function setExchange($exchange){ $this->exchange = $exchange;}
	public function getExchange(){return $this->exchange;}

	public function setLastUpdate($lastUpdate){ $this->lastUpdate=$lastUpdate;}
	public function getLastUpdate(){return $this->lastUpdate;}

	public function setIsDeleted($isDeleted){ $this->isDeleted=$isDeleted;}
	public function getIsDeleted(){return $this->isDeleted;}


}

?>