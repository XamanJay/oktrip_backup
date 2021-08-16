<?php

class Customer
{

	public $id;
	public $name;
	public $lastName;
	public $secondLastName;
	public $phone;
	public $email;
	public $country;
	public $state;
	public $city;
	public $postalCode;
	public $address;
	public $comments;
	public $Sale;

	public $lastUpdate;
	public $isDeleted;

	function __construct(){}

	public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }

	public function getName(){ return $this->name; }
	public function setName($name){ $this->name = $name; }

	public function getLastName(){ return $this->lastName; }
	public function setLastName($lastName){ $this->lastName = $lastName; }

	public function getSecondLastName(){ return $this->secondLastName; }
	public function setSecondLastName($secondLastName){ $this->secondLastName = $secondLastName; }

	public function getPhone(){ return $this->phone; }
	public function setPhone($phone){ $this->phone = $phone; }

	public function getEmail(){ return $this->email; }
	public function setEmail($email){ $this->email = $email; }

	public function getCountry(){ return $this->country; }
	public function setCountry($country){ $this->country = $country; }

	public function getState(){ return $this->state; }
	public function setState($state){ $this->state = $state; }

	public function getCity(){ return $this->city; }
	public function setCity($city){ $this->city = $city; }

	public function getPostalCode(){ return $this->postalCode; }
	public function setPostalCode($postalCode){ $this->postalCode = $postalCode; }

	public function getAddress(){ return $this->address; }
	public function setAddress($address){ $this->address = $address; }

	public function getComments(){ return $this->comments; }
	public function setComments($comments){ $this->comments = $comments; }

	public function getSale(){ return $this->Sale; }
	public function setSale($Sale){ $this->Sale = $Sale; }

	public function setLastUpdate($lastUpdate){ $this->lastUpdate=$lastUpdate;}
	public function getLastUpdate(){return $this->lastUpdate;}

	public function setIsDeleted($isDeleted){ $this->isDeleted=$isDeleted;}
	public function getIsDeleted(){return $this->isDeleted;}


}

?>