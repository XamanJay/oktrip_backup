<?php

class Review
{

	public $Rating;
	public $Source;
	public $Count;

	function __construct($Object)
	{
		$this->setRating($Object->Rating);
		$this->setSource($Object->Source);
		$this->setCount($Object->Count);
	}

	public function setRating($Rating){ $this->Rating=$Rating;}
	public function getRating(){return $this->Rating;}

	public function setSource($Source){ $this->Source=$Source;}
	public function getSource(){return $this->Source;}
	
	public function setCount($Count){ $this->Count=$Count;}
	public function getCount(){return $this->Count;}
}

?>