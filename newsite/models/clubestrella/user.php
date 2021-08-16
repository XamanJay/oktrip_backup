<?php

abstract class user2
{

	public $id;
	public $username;
	public $email;
	public $password;
	public $isDeleted;

	function __construct(){}
	
	public function getId(){ return $this->id; }
	public function setId($id){ $this->id = $id; }

	public function getUsername(){ return $this->username; }
	public function setUsername($username){ $this->username = $username; }

	public function getEmail(){ return $this->email; }
	public function setEmail($email){ $this->email = $email; }

	public function getPassword(){ return $this->password; }
	public function setPassword($password){ $this->password = $password; }

	public function getIsDeleted(){ return $this->isDeleted; }
	public function setIsDeleted($isDeleted){ $this->isDeleted = $isDeleted; }

}


?>