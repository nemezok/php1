<?php
class Realtor{
	protected $ID = 0;
	protected $name = '';
	function __construct ($data) {
		$this->ID = $data['ID'];
		$this->name = $data['name'];
	}
	function __get ($property) {
		return $this->$property;
	}
}
?>