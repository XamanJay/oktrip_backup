<?php

class Service
{

	public $Id;
	public $Name;
	public $Description;
	public $ExtraCharge;
	public $Order;

	function __construct($object)
	{
		$this->setId($object->Id);
		$this->setName($object->Name);
		$this->setDescription($object->Description);
		$this->setExtraCharge($object->ExtraCharge);
		$this->setOrder($object->Order);
	}

	public function setId($Id){ $this->Id=$Id;}
	public function getId(){return $this->Id;}

	public function setName($Name){ $this->Name=$Name;}
	public function getName(){return $this->Name;}
	
	public function setDescription($Description){ $this->Description=$Description;}
	public function getDescription(){return $this->Description;}

	public function setExtraCharge($ExtraCharge){ $this->ExtraCharge=$ExtraCharge;}
	public function getExtraCharge(){return $this->ExtraCharge;}

	public function setOrder($Order){ $this->Order=$Order;}
	public function getOrder(){return $this->Order;}
}

?>