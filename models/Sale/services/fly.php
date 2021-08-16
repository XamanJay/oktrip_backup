<?php

class transportation extends service_
{
	
	public $id;
	public $Airline;
	public $FlightNumber;
	public $Schedule;
	public $TypeService;

	function __construct(){}

	public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }

	public function getAirline(){ return $this->Airline; }
	public function setAirline($Airline){ $this->Airline = $Airline; }

}

?>