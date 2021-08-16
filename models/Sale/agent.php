<?php

class agent
{
	
	public $Id;
	public $Name;
	public $LastName;
	public $EmployeeNumber;

	public $lastUpdate;
	public $isDeleted;

	public $secondLastName;
	public $noEmployee;

	function __construct(){}

	public function setId($Id){ $this->Id = $Id;}
	public function getId(){return $this->Id;}

	public function setName($Name){ $this->Name = $Name;}
	public function getName(){return $this->Name;}

	public function setLastName($LastName){ $this->LastName = $LastName;}
	public function getLastName(){return $this->LastName;}

	public function setEmployeeNumber($EmployeeNumber){ $this->EmployeeNumber = $EmployeeNumber;}
	public function getEmployeeNumber(){return $this->EmployeeNumber;}

	public function setLastUpdate($lastUpdate){ $this->lastUpdate=$lastUpdate;}
	public function getLastUpdate(){return $this->lastUpdate;}

	public function setIsDeleted($isDeleted){ $this->isDeleted=$isDeleted;}
	public function getIsDeleted(){return $this->isDeleted;}

	public function setSecondLastName($secondLastName){ $this->secondLastName = $secondLastName;}
	public function getSecondLastName(){return $this->secondLastName;}

	public function setNoEmployee($noEmployee){ $this->noEmployee = $noEmployee;}
	public function getNoEmployee(){return $this->noEmployee;}

}


?>