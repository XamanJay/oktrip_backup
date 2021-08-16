
<?php

class sale_row
{
	
	public $Id;
	public $Customers_Name;
	public $LastNam;
	public $SecondLastName;
	public $Status_payments;
	public $Services_Name;
	public $DateTo;
	public $DateFrom;
	public $Total;
	public $Subtotal;
	public $type_vending;
	public $TypeService;
	public $NameProvider;
    public $NoPeople;
	public $Date;

	function __construct(){}

	public function setId($Id){ $this->Id = $Id;}
	public function getId(){return $this->Id;}

	public function setCustomer($Customers_Name){ $this->Customers_Name = $Customers_Name;}
	public function getCustomer(){return $this->Customers_Name;}

	public function setLastName($LastNam){ $this->LastNam = $LastNam;}
	public function getLastName(){return $this->LastNam;}

	public function setSecondName($SecondLastName){ $this->SecondLastName = $SecondLastName;}
	public function getSecondName(){return $this->SecondLastName;}

	public function setStatus($Status_payments){ $this->Status_payments = $Status_payments;}
	public function getStatus(){return $this->Status_payments;}

	public function setService($Services_Name){ $this->Services_Name = $Services_Name;}
	public function getService(){return $this->Services_Name;}

	public function setDateTo($DateTo){ $this->DateTo = $DateTo;}
	public function getDateTo(){return $this->DateTo;}

	public function setDateFrom($DateFrom){ $this->DateFrom = $DateFrom;}
	public function getDateFrom(){return $this->DateFrom;}

	public function setTotal($Total){ $this->Total = $Total;}
	public function getTotal(){return $this->Total;}

	public function setSubTotal($Subtotal){ $this->Subtotal = $Subtotal;}
	public function getSubTotal(){return $this->Subtotal;}

	public function setTypeVending($type_vending){ $this->type_vending = $type_vending;}
	public function getTypeVending(){return $this->type_vending;}

	public function setTypeService($TypeService){ $this->TypeService = $TypeService;}
	public function getTypeService(){return $this->TypeService;}

	public function setProvider($NameProvider){ $this->NameProvider = $NameProvider;}
	public function getProvider(){return $this->NameProvider;}
    
    public function setPaxxx($Paxxx){ $this->Paxxx = $Paxxx;}
	public function getPaxxx(){return $this->Paxxx;}
	
	public function setDate($Date){ $this->Date = $Date;}
	public function getDate(){return $this->Date;}
    
    
}  ?>