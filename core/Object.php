<?php
class Object{
	public $ID = 0;
	public $address = '';
	function __construct($data){
		$this->ID = $data['ID'];
		$this->address = $data['address'];
	}
	static function list ($oid = null) {
		global $mysqli;
		if ($result = $mysqli->query('
			SELECT *
			FROM objects
			' . (($oid) ? 'WHERE ID = "'.$oid.'"' : '') . '
			GROUP BY ID
		')) {
			while($row = mysqli_fetch_assoc($result)){
				$objects[$row['ID']] = new Object($row);
			}
		    $result->close();
		    if(empty($objects)) return;
		    return (($oid) ? array_shift($objects) : $objects);
		} else {
			printf("Errormessage: %s\n", $mysqli->error);
		}
		return false;
	}
}
?>