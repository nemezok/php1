<?php
class Inspection{
	public $ID = 0;
	public $realtor_id = 0;
	public $realtor = '';
	public $object_id = 0;
	public $address = '';
	public $date = '';
	public $time = 0;
	public $clients = '';
	function __construct($data){
		$this->ID = $data['ID'];
		$this->realtor_id = $data['realtor_id'];
		$this->realtor = $data['realtor'];
		$this->object_id = $data['object_id'];
		$this->address = $data['address'];
		$this->date = $data['date'];
		$this->time = $data['time'];
		foreach(explode('||', $data['clients']) as $val) $this->clients[] = explode('|', $val);
	}
	static function list ($object_id = null, $realtor_id = null) {
		global $mysqli;
		if ($result = $mysqli->query('
			SELECT
				i.*,
				r.name as realtor,
				o.address as address,
				ic.clients
			FROM inspections i
				LEFT JOIN realtors r ON r.ID = i.realtor_id
				LEFT JOIN objects o ON o.ID = i.object_id
				LEFT JOIN (
					SELECT
						ic.inspection_id,
						GROUP_CONCAT(DISTINCT CONCAT_WS("|", c.name, c.phone) SEPARATOR "||") as clients
					FROM inspection_clients ic
						LEFT JOIN clients c ON c.ID = ic.client_id
					GROUP BY inspection_id
				) ic ON ic.inspection_id = i.ID
			WHERE 1=1
				' . (($object_id) ? 'AND i.object_id = "' . $object_id . '"' : '') . '
				' . (($realtor_id) ? 'AND i.realtor_id = "' . $realtor_id . '"' : '') . '
			GROUP BY i.ID
		')) {
			while($row = mysqli_fetch_assoc($result)){
				$inspections[$row['date']][$row['time']] = new Inspection($row);
			}
		    $result->close();
		    return $inspections;
		} else {
			printf("Errormessage: %s\n", $mysqli->error);
		}
		return false;
	}
	static function add ($inspection) { //print_r($inspection);
		global $mysqli;
		$mysqli->begin_transaction();
			$mysqli->query('
				INSERT INTO inspections (
					realtor_id,
					object_id,
					date,
					time
				) VALUES (
					"' . $inspection['realtor_id'] . '",
					"' . $inspection['object_id'] . '",
					"' . $inspection['date'] . '",
					"' . $inspection['time'] . '"
				)
			');
			$inspection['ID'] = $mysqli->insert_id;
			foreach($inspection['clients'] as $client_id){
				$mysqli->query('
					INSERT INTO inspection_clients (
						inspection_id,
						client_id
					) VALUES (
						"' . $inspection['ID'] . '",
						"' . $client_id . '"
					)
				');
			}
			
		if(!$mysqli->commit()) printf("Errormessage: %s\n", $mysqli->error);
	}
	static function remove ($inspection) { //print_r($inspection);
		global $mysqli;
		$mysqli->begin_transaction();
			$mysqli->query('
				DELETE FROM inspections
				WHERE ID = "'.$inspection['inspection_id'].'"
			');
			$mysqli->query('
				DELETE FROM inspection_clients
				WHERE inspection_id = "'.$inspection['inspection_id'].'"
			');
		if(!$mysqli->commit()) printf("Errormessage: %s\n", $mysqli->error);
	}
}
if(isset($_POST['add_inspection'])) Inspection::add($_POST);
if(isset($_POST['remove_inspection'])) Inspection::remove($_POST);
?>