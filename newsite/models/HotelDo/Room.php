<?php

class Room
{
	
	public $Id;
	public $Name;
	public $CapacityAdults;
	public $CapacityKids;
	public $CapacityTotal;
	public $RoomView;
	public $Bedding;
	public $ImageUrl;
	public $MealPlans; //Lista de MealPlan

	function __construct($object)
	{
		$this->setId($object->Id);
		$this->setName($object->Name);
		$this->setCapacityAdults($object->CapacityAdults);
		$this->setCapacityKids($object->CapacityKids);
		$this->setCapacityTotal($object->CapacityTotal);
		$this->setRoomView($object->RoomView);
		$this->setBedding($object->Bedding);
		$this->setImageUrl($object->ImageURL);
		
		if(is_array($object->MealPlans->MealPlan)){
			$arrayMealPlans = array();
			foreach ($object->MealPlans->MealPlan as $mealPlan) {
				array_push($arrayMealPlans, new MealPlan($mealPlan));
			}
			$this->setMealPlans($arrayMealPlans);
		}
		else
		{
			$this->setMealPlans(array(new MealPlan($object->MealPlans->MealPlan)));
		}
	}

	public function setId($Id){ $this->Id=$Id;}
	public function getId(){return $this->Id;}

	public function setName($Name){ $this->Name=$Name;}
	public function getName(){return $this->Name;}

	public function setCapacityAdults($CapacityAdults){ $this->CapacityAdults=$CapacityAdults;}
	public function getCapacityAdults(){return $this->CapacityAdults;}

	public function setCapacityKids($CapacityKids){ $this->CapacityKids=$CapacityKids;}
	public function getCapacityKids(){return $this->CapacityKids;}

	public function setCapacityTotal($CapacityTotal){ $this->CapacityTotal=$CapacityTotal;}
	public function getCapacityTotal(){return $this->CapacityTotal;}

	public function setRoomView($RoomView){ $this->RoomView=$RoomView;}
	public function getRoomView(){return $this->RoomView;}

	public function setBedding($Bedding){ $this->Bedding=$Bedding;}
	public function getBedding(){return $this->Bedding;}

	public function setImageUrl($ImageUrl){ $this->ImageUrl=$ImageUrl;}
	public function getImageUrl(){return $this->ImageUrl;}
	
	public function setMealPlans($MealPlans){ $this->MealPlans=$MealPlans;}
	public function getMealPlans(){return $this->MealPlans;}

}

?>