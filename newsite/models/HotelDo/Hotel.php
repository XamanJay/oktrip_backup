<?php


include 'models/HotelDo/Address.php';
include 'models/HotelDo/AllInclusive.php';
include 'models/HotelDo/Bar.php';
include 'models/HotelDo/Comfort.php';
include 'models/HotelDo/Photo.php';
include 'models/HotelDo/Restaurant.php';
include 'models/HotelDo/Review.php';
include 'models/HotelDo/Room.php';
include 'models/HotelDo/Service.php';
include 'models/HotelDo/Theme.php';
include 'models/HotelDo/MealPlan.php';

class Hotel
{

	public $Id;
	public $Name;
	public $Description;
	public $CityName;
	public $Category;
	public $CategoryId;
	public $Stars;
		public $AllInclusive; //Model AllInclusive
		public $CheckIn;
		public $CheckOut;
		public $Address; //Model Address
		public $Latitude; 
		public $Longitude;
		public $AirportReference;
		public $ThumbnailUrl;
		public $Gallery; //Lista de Photo
		public $Themes; //Lista de Theme
		public $Services; //Lista de Service
		public $Rooms; //Lista de Room
		public $Facilities; //Lista de Comfort
		public $Restaurants; //Lista de Restaurant
		public $Bars; //Lista de Bar
		public $Review; //Model Review
		public $Error; //Model Review

		function __construct(){}

		public function setId($Id){ $this->Id=$Id;}
		public function getId(){return $this->Id;}

		public function setName($Name){ $this->Name=$Name;}
		public function getName(){return $this->Name;}

		public function setDescription($Description){ $this->Description=$Description;}
		public function getDescription(){return $this->Description;}

		public function setCityName($CityName){ $this->CityName=$CityName;}
		public function getCityName(){return $this->CityName;}

		public function setCategory($Category){ $this->Category=$Category;}
		public function getCategory(){return $this->Category;}

		public function setCategoryId($CategoryId){ $this->CategoryId=$CategoryId;}
		public function getCategoryId(){return $this->CategoryId;}

		public function setStars($Stars){ $this->Stars=$Stars;}
		public function getStars(){return $this->Stars;}

		public function setAllInclusive($AllInclusive){ $this->AllInclusive=$AllInclusive;}
		public function getAllInclusive(){return $this->AllInclusive;}

		public function setCheckIn($CheckIn){ $this->CheckIn=$CheckIn;}
		public function getCheckIn(){return $this->CheckIn;}

		public function setCheckOut($CheckOut){ $this->CheckOut=$CheckOut;}
		public function getCheckOut(){return $this->CheckOut;}

		public function setAddress($Address){ $this->Address=$Address;}
		public function getAddress(){return $this->Address;}

		public function setLatitude($Latitude){ $this->Latitude=$Latitude;}
		public function getLatitude(){return $this->Latitude;}	

		public function setLongitude($Longitude){ $this->Longitude=$Longitude;}
		public function getLongitude(){return $this->Longitude;}

		public function setAirportReference($AirportReference){ $this->AirportReference=$AirportReference;}
		public function getAirportReference(){return $this->AirportReference;}	

		public function setThumbnailUrl($ThumbnailUrl){ $this->ThumbnailUrl=$ThumbnailUrl;}
		public function getThumbnailUrl(){return $this->ThumbnailUrl;}

		public function setGallery($Gallery){ $this->Gallery=$Gallery;}
		public function getGallery(){return $this->Gallery;}

		public function setThemes($Themes){ $this->Themes=$Themes;}
		public function getThemes(){return $this->Themes;}

		public function setServices($Services){ $this->Services=$Services;}
		public function getServices(){return $this->Services;}

		public function setRooms($Rooms){ $this->Rooms=$Rooms;}
		public function getRooms(){return $this->Rooms;}

		public function setFacilities($Facilities){ $this->Facilities=$Facilities;}
		public function getFacilities(){return $this->Facilities;}

		public function setRestaurants($Restaurants){ $this->Restaurants=$Restaurants;}
		public function getRestaurants(){return $this->Restaurants;}

		public function setBars($Bars){ $this->Bars=$Bars;}
		public function getBars(){return $this->Bars;}

		public function setReviews($Reviews){ $this->Reviews=$Reviews;}
		public function getReviews(){return $this->Reviews;}

		public function setError($Error){ $this->Error=$Error;}
		public function getError(){return $this->Error;}

	}


	?>