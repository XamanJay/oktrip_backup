<?php

include("models/Sale/customer.php");
include("models/Sale/payment.php");
include("models/Sale/service_.php");
include("models/Sale/commission.php");
include("models/Sale/provider.php");
include("models/Sale/typeService.php");
include("models/Sale/coupon.php");
include("models/Sale/agent.php");

include("models/Sale/services/transportation.php");
include("models/Sale/services/hotel_.php");
include("models/Sale/services/tours.php");

class sale
{
	
	public $Id;
	public $Past_id;
	public $key;
	public $xml;
	public $provider;
	public $Date;

	public $Customer;
	public $Customer_id;
	public $Commission;
	public $Commission_id;
	public $Service;
	public $Service_id;
	public $Payment;
	public $Payment_id;

	public $lastUpdate;
	public $isDeleted;

	function __construct(){}
	
	public function setId($Id){ $this->Id = $Id;}
	public function getId(){return $this->Id;}

	public function setKey($key){ $this->key = $key;}
	public function getKey(){return $this->key;}

	public function setXml($xml){ $this->xml = $xml;}
	public function getXml(){return $this->xml;}

	public function setProvider($provider){ $this->provider = $provider;}
	public function getProvider(){return $this->provider;}

	public function setPastId($Past_id){ $this->Past_id = $Past_id;}
	public function getPastId(){return $this->Past_id;}

	public function setDate($Date){ $this->Date = $Date;}
	public function getDate(){return $this->Date;}

	public function setCustomer_id($Customer_id){ $this->Customer_id = $Customer_id;}
	public function getCustomer_id(){return $this->Customer_id;}

	public function setCustomer($Customer){ $this->Customer = $Customer;}
	public function getCustomer(){ return $this->Customer;}

	public function setCommission_id($Commission_id){ $this->Commission_id = $Commission_id;}
	public function getCommission_id(){return $this->Commission_id;}

	public function setCommission($Commission){ $this->Commission = $Commission;}
	public function getCommission(){ return $this->Commission;}

	public function setService_id($Service_id){ $this->Service_id = $Service_id;}
	public function getService_id(){return $this->Service_id;}

	public function setService($Service){ $this->Service = $Service;}
	PUBLIC function getService(){ return $this->Service;}

	public function setPayment_id($Payment_id){ $this->Payment_id = $Payment_id;}
	public function getPayment_id(){return $this->Payment_id;}

	public function setPayment($Payment){ $this->Payment = $Payment;}
	public function getPayment(){return $this->Payment;}

	public function setLastUpdate($lastUpdate){ $this->lastUpdate=$lastUpdate;}
	public function getLastUpdate(){return $this->lastUpdate;}

	public function setIsDeleted($isDeleted){ $this->isDeleted=$isDeleted;}
	public function getIsDeleted(){return $this->isDeleted;}


}

class EnumTypeService extends BasicEnum {

	const __default = self::Product;
	const Hotel = 0;
	const Tour = 1;
	const Transportation = 2;
	const VehicleRental = 3;
	const Flight = 4;
	const Product = 5;

}

class EnumPaymentMethods extends BasicEnum
{

	const __default = self::Other;
	const CreditCard = 0;
	const DebitCard = 1;
	const WireTransfer = 2;
	const BankDeposit = 3;
	const Paypal = 4;
	const Cash = 5;
	const Other = 6;

	public $value;
	public $key;

	function __construct($key = null)
	{
		$this->key = $key;
		switch ($key) {
			case 0: $this->value = "Tarjeta de crédito";
			break;
			case 1: $this->value = "Tarjeta de débito";
			break;
			case 2: $this->value = "Transferecia bancaria";
			break;
			case 3: $this->value = "Depósito bancario";
			break;
			case 4: $this->value = "Paypal";
			break;
			case 5: $this->value = "Efectivo";
			break;
			case 6: $this->value = "Otro";
			break;
			default: 
			$this->value = "Otro";
			$this->key = 6;
			break;
		}
	}

}

class EnumStatusPayments extends BasicEnum
{
	
	const __default = self::Other;
	const Pending = 0;
	const Declined = 1;
	const Authorized = 2;
	const NotEffective = 3;
	const InProcess = 4;
	const Canceled = 5;
	const Other = 6;

	public $value;
	public $key;
	
	function __construct($key = null)
	{
		$this->key = $key;
		switch ($key) {
			case 0: $this->value = "Pendiente";
			break;
			case 1: $this->value = "Declinada";
			break;
			case 2: $this->value = "Autorizada";
			break;
			case 3: $this->value = "No efectiva";
			break;
			case 4: $this->value = "En proceso";
			break;
			case 5: $this->value = "Cancelada";
			break;
			case 6: $this->value = "Otro";
			break;
			default: 
			$this->value = "Otro";
			$this->key = 6;
			break;
		}
	}
}


class EnumCurrency extends BasicEnum
{
	
	const __default = self::Other;
	const MXN = 0;
	const USD = 1;
	const EUR = 2;
	const Other = 3;

	function __construct($key = null)
	{
		$this->key = $key;
		switch ($key) {
			case 0: $this->value = "MXN";
			break;
			case 1: $this->value = "USD";
			break;
			case 2: $this->value = "EUR";
			break;
			case 3: $this->value = "Otro";
			break;
			default: 
			$this->value = "Otro";
			$this->key = 3;
			break;
		}
	}
}
?>