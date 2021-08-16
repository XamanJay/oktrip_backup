<?php

class Bar
{
	
	public $Id;
	public $Name;
	public $Description;
	public $Schedule;

	function __construct($object)
	{
		$this->setId($object->Id);
		$this->setName($object->Name);
		$this->setDescription($object->Description);
		$this->setSchedule($object->Schedule);
	}

	public function setId($Id){ $this->Id=$Id;}
	public function getId(){return $this->Id;}

	public function setName($Name){ $this->Name=$Name;}
	public function getName(){return $this->Name;}
	
	public function setDescription($Description){ $this->Description=$Description;}
	public function getDescription(){return $this->Description;}

	public function setSchedule($Schedule){ $this->Schedule=$Schedule;}
	public function getSchedule(){return $this->Schedule;}

}


?>