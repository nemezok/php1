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
	static function list ()
	{
		global $dbh;
		if (
			$result = $dbh->query('
				SELECT *
				FROM clients
				GROUP BY ID
			')
		) {
			foreach($result as $row){
				$clients[$row['ID']] = new Realtor($row);
			}
		    return $clients;
		} else {
			printf("Errormessage: %s\n", $dbh->error);
		}
		return false;
	}
}
?>