<?php

class Admin
{

	public $Id;
	public $Username;
	public $Email;
	public $Password;

	function __construct(){}
	
	public function setId($Id){ $this->Id = $Id; }
	public function getId(){ return $this->Id; }

	public function setUsername($Username){ $this->Username = $Username; }
	public function getUsername(){ return $this->Username; }

	public function setEmail($Email){ $this->Email = $Email; }
	public function getEmail(){ return $this->Email; }

	public function setPassword($Password){ $this->Password = $Password; }
	public function getPassword(){ return $this->Password; }

}

?>