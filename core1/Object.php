<?php
class Object {
	protected $ID = 0;
	protected $address = '';
	function __construct ($data)
	{
		$this->ID = $data['ID'];
		$this->address = $data['address'];
	}
	function __get ($property)
	{
		return $this->$property;
	}
}
?>