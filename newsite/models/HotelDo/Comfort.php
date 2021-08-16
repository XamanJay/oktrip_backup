<?php

class Comfort
{
	
	public $Id;
	public $Name;
	public $Description;
	public $ExtraCharge;
	public $Image;
	public $Order;

	function __construct($object)
	{
		$this->setId($object->Id);
		$this->setName($object->Name);
		$this->setDescription($object->Description);
		$this->setExtraCharge($object->ExtraCharge);
		$this->setImage( (isset($object->Image)) ? $object->Image : "" );
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

	public function setImage($Image){ $this->Image=$Image;}
	public function getImage(){return $this->Image;}

	public function setOrder($Order){ $this->Order=$Order;}
	public function getOrder(){return $this->Order;}

}

?>