<?php

class coupon
{
	
	public $Id;
	public $Name;
	public $Provider;
	public $Key;
	public $HourPickup;
	public $Hotel;
	public $Room;
	public $NoPax;
	public $NetRate;
	public $PublicRate;
	public $Payment;
	public $Comments;
	public $lastUpdate;

	function __construct(){}

	public function setId($Id){ $this->Id = $Id; }
	public function getId(){ return $this->Id; }

	public function setName($Name){ $this->Name = $Name; }
	public function getName(){ return $this->Name; }

	public function setProvider($Provider){ $this->Provider = $Provider; }
	public function getProvider(){ return $this->Provider; }

	public function setKey_($Key){ $this->Key = $Key; }
	public function getKey_(){ return $this->Key; }

	public function setHourPickup($HourPickup){ $this->HourPickup = $HourPickup; }
	public function getHourPickup(){ return $this->HourPickup; }

	public function setHotel($Hotel){ $this->Hotel = $Hotel; }
	public function getHotel(){ return $this->Hotel; }

	public function setRoom($Room){ $this->Room = $Room; }
	public function getRoom(){ return $this->Room; }

	public function setNoPax($NoPax){ $this->NoPax = $NoPax; }
	public function getNoPax(){ return $this->NoPax; }

	public function setNetRate($NetRate){ $this->NetRate = $NetRate; }
	public function getNetRate(){ return $this->NetRate; }

	public function setPublicRate($PublicRate){ $this->PublicRate = $PublicRate; }
	public function getPublicRate(){ return $this->PublicRate; }

	public function setPayment($Payment){ $this->Payment = $Payment; }
	public function getPayment(){ return $this->Payment; }

	public function setComments($Comments){ $this->Comments = $Comments; }
	public function getComments(){ return $this->Comments; }

	public function setlastUpdate($lastUpdate){ $this->lastUpdate = $lastUpdate; }
	public function getlastUpdate(){ return $this->lastUpdate; }

}

?>