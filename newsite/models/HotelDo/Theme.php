<?php

class Theme
{
	
	public $Id;
	public $Name;
	public $Path;

	function __construct($object)
	{
		$this->setId($object->Id);
		$this->setName($object->Name);
		$this->setPath($object->Path);
	}

	public function setId($Id){ $this->Id=$Id;}
	public function getId(){return $this->Id;}

	public function setName($Name){ $this->Name=$Name;}
	public function getName(){return $this->Name;}
	
	public function setPath($Path){ $this->Path=$Path;}
	public function getPath(){return $this->Path;}
	
}

?>