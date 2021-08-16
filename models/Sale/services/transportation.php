<?php

class transportation extends service_
{
	
	public $TypeTransfer;
	public $Airline;
	public $FlightNumber;
	public $Schedule;
	public $TypeService;

	function __construct(){}

	public function getTypeTransfer(){ return $this->TypeTransfer; }
	public function setTypeTransfer($TypeTransfer){ $this->TypeTransfer = $TypeTransfer; }

	public function getAirline(){ return $this->Airline; }
	public function setAirline($Airline){ $this->Airline = $Airline; }

	public function getFlightNumber(){ return $this->FlightNumber; }
	public function setFlightNumber($FlightNumber){ $this->FlightNumber = $FlightNumber; }

	public function getSchedule(){ return $this->Schedule; }
	public function setSchedule($Schedule){ $this->Schedule = $Schedule; }

	public function getTypeService(){ return $this->TypeService; }
	public function setTypeService($TypeService){ $this->TypeService = $TypeService; }

}

?>