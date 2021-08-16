<?php

class service_
{

	public $Id;
	public $Name;
	public $DateTo;
	public $DateFrom;
	public $typeService;
	public $comments;
	public $noPeople;
	public $lastUpdate;
	public $isDeleted;
	public $offline;
	public $Idproductos;
    public $Idproviders;


	function __construct(){}

	public function setId($Id){ $this->Id = $Id;}
	public function getId(){return $this->Id;}

	public function setName($Name){ $this->Name = $Name;}
	public function getName(){return $this->Name;}

	public function setTypeService($typeService){ $this->typeService = $typeService;}
	public function getTypeService(){return $this->typeService;}

	public function setDateTo($DateTo){ $this->DateTo = $DateTo;}
	public function getDateTo(){return $this->DateTo;}

	public function setDateFrom($DateFrom){ $this->DateFrom = $DateFrom;}
	public function getDateFrom(){return $this->DateFrom;}

	public function setComments($comments){ $this->comments = $comments;}
	public function getComments(){return $this->comments;}

	public function setNoPeople($noPeople){ $this->noPeople=$noPeople;}
	public function getNoPeople(){return $this->noPeople;}

	public function setlastUpdate($lastUpdate){ $this->lastUpdate=$lastUpdate;}
	public function getlastUpdate(){return $this->lastUpdate;}

	public function setIsDeleted($isDeleted){ $this->isDeleted=$isDeleted;}
	public function getIsDeleted(){return $this->isDeleted;}

	public function setOffline($offline){ $this->offline=$offline;}
	public function getOffline(){return $this->offline;}

	public function setIdproductos($Idproductos){ $this->Idproductos = $Idproductos;}
	public function getIdproductos(){return $this->Idproductos;}

	public function setIdproviders($Idproviders){ $this->Idproviders = $Idproviders;}
	public function getIdproviders(){return $this->Idproviders;} 




}

?>