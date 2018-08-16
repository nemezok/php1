<?php
class DB
{
	protected $conn = null;
	function __construct ()
	{
		try {
		    $this->conn = new PDO('mysql:dbname=test2;host=localhost', 'root', '');
		} catch (PDOException $e) {
		    echo 'Подключение не удалось: ' . $e->getMessage();
		}
	}
	function getInspections ($object_id = null, $realtor_id = null)
	{
		$res = [];
		try {
			$select = $this->conn->query('
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
			');
			foreach($select as $d) $res[] = $d;
			return $res;
		} catch(PDOExecption $e) {
			print "Error!: " . $e->getMessage() . "</br>";
			return false;
		}
	}
	function addInspection ($inspection)
	{
		$p1 = $this->conn->prepare('INSERT INTO inspections (realtor_id,object_id,date,time) VALUES (?,?,?,?)');
		$p2 = $this->conn->prepare('INSERT INTO inspection_clients (inspection_id,client_id) VALUES (?,?)');
		try {
			$this->conn->beginTransaction();
			$p1->execute( array(
				$inspection['realtor_id'],
				$inspection['object_id'],
				$inspection['date'],
				$inspection['time']
			) );
			$inspection['id'] = $this->conn->lastInsertId();
			foreach($inspection['clients'] as $client_id)
				$p2->execute( array($inspection['id'], $client_id) );
			$this->conn->commit();
		} catch(PDOExecption $e) {
			$this->conn->rollback();
			print "Error!: " . $e->getMessage() . "</br>";
		}
	}
	function removeInspection ($inspection)
	{
		$p1 = $this->conn->prepare('DELETE FROM inspections WHERE ID = ?');
		$p2 = $this->conn->prepare('DELETE FROM inspection_clients WHERE inspection_id = ?');
		try {
	        $this->conn->beginTransaction();
	        $p1->execute( array($inspection['inspection_id']) );
	        $p2->execute( array($inspection['inspection_id']) );
	        $this->conn->commit();
	    } catch(PDOExecption $e) {
			$this->conn->rollback();
	        print "Error!: " . $e->getMessage() . "</br>"; 
	    }
	}
	function getObjects ($object_id = null)
	{
		$res = [];
		try {
			$select = $this->conn->query('
				SELECT *
				FROM objects
				' . (($object_id) ? 'WHERE ID = "'.$object_id.'"' : '') . '
				GROUP BY ID
			');
			foreach($select as $d) $res[] = $d;
			return $res;
		} catch(PDOExecption $e) {
			print "Error!: " . $e->getMessage() . "</br>";
			return false;
		}
	}
	function getRealtors ($realtor_id = null)
	{
		$res = [];
		try {
			$select = $this->conn->query('
				SELECT *
				FROM realtors
				GROUP BY ID
			');
			foreach($select as $d) $res[] = $d;
			return $res;
		} catch(PDOExecption $e) {
			print "Error!: " . $e->getMessage() . "</br>";
			return false;
		}
	}
	function getClients ($client_id = null)
	{
		$res = [];
		try {
			$select = $this->conn->query('
				SELECT *
				FROM clients
				GROUP BY ID
			');
			foreach($select as $d) $res[] = $d;
			return $res;
		} catch(PDOExecption $e) {
			print "Error!: " . $e->getMessage() . "</br>";
			return false;
		}
	}
}
#global $DB;
#$DB = new DB();
?>