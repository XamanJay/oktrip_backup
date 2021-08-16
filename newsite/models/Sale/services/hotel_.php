<?php
##Queda pendiente las edades de los niños
class hotel_ extends service_
{

	public $idHotelDo; # HotelDo si lo requiere
	public $City;
	public $Country;
	public $NumberRooms;
	public $MealPlan;
	public $CategoryRoom;
	public $PeoplePerRoom;
	public $XmlRequest;
	public $XmlResponse;
	public $IsConfirmed;
	
	public $key;
	public $noRooms;
	public $Rooms;

	function __construct(){}

	public function getIdHotelDo(){ return $this->idHotelDo; }
	public function setIdHotelDo($idHotelDo){ $this->idHotelDo = $idHotelDo; }

	public function getCity(){ return $this->City; }
	public function setCity($City){ $this->City = $City; }

	public function getCountry(){ return $this->Country; }
	public function setCountry($Country){ $this->Country = $Country; }

	public function getNumberRooms(){ return $this->NumberRooms; }
	public function setNumberRooms($NumberRooms){ $this->NumberRooms = $NumberRooms; }

	public function getMealPlan(){ return $this->MealPlan; }
	public function setMealPlan($MealPlan){ $this->MealPlan = $MealPlan; }

	public function getCategoryRoom(){ return $this->CategoryRoom; }
	public function setCategoryRoom($CategoryRoom){ $this->CategoryRoom = $CategoryRoom; }

	public function getPeoplePerRoom(){ return $this->PeoplePerRoom; }
	public function setPeoplePerRoom($PeoplePerRoom){ $this->PeoplePerRoom = $PeoplePerRoom; }

	public function getXmlRequest(){ return $this->XmlRequest; }
	public function setXmlRequest($XmlRequest){ $this->XmlRequest = $XmlRequest; }

	public function getXmlResponse(){ return $this->XmlResponse; }
	public function setXmlResponse($XmlResponse){ $this->XmlResponse = $XmlResponse; }

	public function getIsConfirmed(){ return $this->IsConfirmed; }
	public function setIsConfirmed($IsConfirmed){ $this->IsConfirmed = $IsConfirmed; }

	public function getKey_(){ return $this->key; }
	public function setKey_($key){ $this->key = $key; }

	public function getNoRooms(){ return $this->noRooms; }
	public function setNoRooms($noRooms){ $this->noRooms = $noRooms; }

	public function getRooms(){ return $this->Rooms; }
	public function setRooms($Rooms){ $this->Rooms = $Rooms; }

}