<?php
class Client
{
	public $ID = 0;
	public $name = '';
	public $phone = '';
	function __construct ($data)
	{
		$this->ID = $data['ID'];
		$this->name = $data['name'];
		$this->phone = $data['phone'];
	}
}
?>