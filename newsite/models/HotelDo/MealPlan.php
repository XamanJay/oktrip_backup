<?php

class MealPlan
{
	
	public $Id;
	public $Name;
	public $AgencyPublic;
	public $Contract;
	public $MarketId;
	public $Normal;
	public $Total;
	public $RateKey;
	public $RateDetails;

	function __construct($object)
	{
		$this->setId($object->Id);
		$this->setName($object->Name);
		$this->setAgencyPublic($object->AgencyPublic);
		$this->setContract($object->Contract);
		$this->setMarketId($object->MarketId);
		$this->setNormal($object->Normal);
		$this->setTotal($object->Total);
		$this->setRateKey($object->RateKey);
		$this->setRateDetails($object->RateDetails);
	}

	public function setId($Id){ $this->Id=$Id;}
	public function getId(){return $this->Id;}

	public function setName($Name){ $this->Name=$Name;}
	public function getName(){return $this->Name;}

	public function setAgencyPublic($AgencyPublic){ $this->AgencyPublic=$AgencyPublic;}
	public function getAgencyPublic(){return $this->AgencyPublic;}

	public function setContract($Contract){ $this->Contract=$Contract;}
	public function getContract(){return $this->Contract;}

	public function setMarketId($MarketId){ $this->MarketId=$MarketId;}
	public function getMarketId(){return $this->MarketId;}

	public function setNormal($Normal){ $this->Normal=$Normal;}
	public function getNormal(){return $this->Normal;}

	public function setTotal($Total){ $this->Total=$Total;}
	public function getTotal(){return $this->Total;}
	
	public function setRateKey($RateKey){ $this->RateKey=$RateKey;}
	public function getRateKey(){return $this->RateKey;}

	public function setRateDetails($RateDetails){ $this->RateDetails=$RateDetails;}
	public function getRateDetails(){return $this->RateDetails;}


}

?>