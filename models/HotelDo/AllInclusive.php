<?php

class AllInclusive
{
	
	public $MealsDescription;
	public $BeverageDescription;
	public $ActivitiesDescription;
	public $EntertainmentDescription;
	public $ServicesDescription;
	public $Taxes;
	public $Limitations;

	function __construct($object)
	{
		$this->setMealsDescription($object->MealsDescription);
		$this->setBeverageDescription($object->BeverageDescription);
		$this->setActivitiesDescription($object->ActivitiesDescription);
		$this->setEntertainmentDescription($object->EntertainmentDescription);
		$this->setServicesDescription($object->ServicesDescription);
		$this->setTaxes($object->Taxes);
		$this->setLimitations($object->Limitations);
	}

	public function setMealsDescription($MealsDescription){ $this->MealsDescription=$MealsDescription;}
	public function getMealsDescription(){return $this->MealsDescription;}

	public function setBeverageDescription($BeverageDescription){ $this->BeverageDescription=$BeverageDescription;}
	public function getBeverageDescription(){return $this->BeverageDescription;}

	public function setActivitiesDescription($ActivitiesDescription){ $this->ActivitiesDescription=$ActivitiesDescription;}
	public function getActivitiesDescription(){return $this->ActivitiesDescription;}

	public function setEntertainmentDescription($EntertainmentDescription){ $this->EntertainmentDescription=$EntertainmentDescription;}
	public function getEntertainmentDescription(){return $this->EntertainmentDescription;}

	public function setServicesDescription($ServicesDescription){ $this->ServicesDescription=$ServicesDescription;}
	public function getServicesDescription(){return $this->ServicesDescription;}

	public function setTaxes($Taxes){ $this->Taxes=$Taxes;}
	public function getTaxes(){return $this->Taxes;}
	
	public function setLimitations($Limitations){ $this->Limitations=$Limitations;}
	public function getLimitations(){return $this->Limitations;}

}



?>