<?php
class Realtor{
	public $ID = 0;
	public $name = '';
	function __construct($data){
		$this->ID = $data['ID'];
		$this->name = $data['name'];
	}
	static function list () {
		global $mysqli;
		if ($result = $mysqli->query('
			SELECT *
			FROM realtors
			GROUP BY ID
		')) {
			while($row = mysqli_fetch_assoc($result)){
				$realtors[$row['ID']] = new Realtor($row);
			}
		    $result->close();
		    return $realtors;
		} else {
			printf("Errormessage: %s\n", $mysqli->error);
		}
		return false;
	}
}
?>