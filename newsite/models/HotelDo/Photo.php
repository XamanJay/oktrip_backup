<?php

class Photo
{
	
	public $Description;
	public $Title;
	public $URL;
	public $GroupId;
	public $GroupName;

	function __construct($object)
	{
		$this->setDescription($object->Description);
		$this->setTitle($object->Title);
		$this->setURL($object->URL);
		if(isset($object->GroupId) && isset($object->GroupId)){
			$this->setGroupId($object->GroupId);
			$this->setGroupName($object->GroupName);
		}
	}

	public function setDescription($Description){ $this->Description=$Description;}
	public function getDescription(){return $this->Description;}

	public function setTitle($Title){ $this->Title=$Title;}
	public function getTitle(){return $this->Title;}

	public function setURL($URL){ $this->URL=$URL;}
	public function getURL(){return $this->URL;}

	public function setGroupId($GroupId){ $this->GroupId=$GroupId;}
	public function getGroupId(){return $this->GroupId;}

	public function setGroupName($GroupName){ $this->GroupName=$GroupName;}
	public function getGroupName(){return $this->GroupName;}
}

?>