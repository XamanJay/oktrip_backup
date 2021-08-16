<?php

class payment
{
	
	public $Id;
	public $Reference;
	public $AuthorizationNo;
	public $subtotal;
	public $discount;
	public $XmlResponse;
	public $XmlRequest;
	public $Total;
	public $PaymentMethod;
	public $Status;
	public $Currency;
	public $ExchangeRate;
	public $Sale;

	public $lastUpdate;
	public $isDeleted;

	function __construct(){}

	public function setId($Id){ $this->Id = $Id; }
	public function getId(){ return $this->Id; }

	public function setReference($Reference){ $this->Reference = $Reference; }
	public function getReference(){ return $this->Reference; }

	public function setSubtotal($subtotal){ $this->subtotal = $subtotal; }
	public function getSubtotal(){ return $this->subtotal; }

	public function setDiscount($discount){ $this->discount = $discount; }
	public function getDiscount(){ return $this->discount; }

	public function setAuthorizationNo($AuthorizationNo){ $this->AuthorizationNo = $AuthorizationNo; }
	public function getAuthorizationNo(){ return $this->AuthorizationNo; }

	public function setXmlResponse($XmlResponse){ $this->XmlResponse = $XmlResponse; }
	public function getXmlResponse(){ return $this->XmlResponse; }

	public function setXmlRequest($XmlRequest){ $this->XmlRequest = $XmlRequest; }
	public function getXmlRequest(){ return $this->XmlRequest; }

	public function setTotal($Total){ $this->Total = $Total; }
	public function getTotal(){ return $this->Total; }

	public function setPaymentMethod($PaymentMethod){ $this->PaymentMethod = $PaymentMethod; }
	public function getPaymentMethod(){ return $this->PaymentMethod; }
	
	public function setStatus($Status){ $this->Status = $Status; }
	public function getStatus(){ return $this->Status; }

	public function setCurrency($Currency){ $this->Currency = $Currency; }
	public function getCurrency(){ return $this->Currency; }

	public function setExchangeRate($ExchangeRate){ $this->ExchangeRate = $ExchangeRate; }
	public function getExchangeRate(){ return $this->ExchangeRate; }

	public function setSale($Sale){ $this->Sale = $Sale; }
	public function getSale(){ return $this->Sale; }

	public function setLastUpdate($lastUpdate){ $this->lastUpdate=$lastUpdate;}
	public function getLastUpdate(){return $this->lastUpdate;}

	public function setIsDeleted($isDeleted){ $this->isDeleted=$isDeleted;}
	public function getIsDeleted(){return $this->isDeleted;}


}

?>