<?php

class tours extends service_
{
	
	public $coupon_id;

	function __construct(){}

	public function getCoupon(){ return $this->coupon_id; }
	public function setCoupon($coupon_id){ $this->coupon_id = $coupon_id; }

}

?>