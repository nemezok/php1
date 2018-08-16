<?php
/**
* @author S
* @copyright 2018
* @param add
* @param remove
* @return Inspection Object
*/
class Inspection
{
	protected $ID = 0;
	protected $realtor_id = 0;
	protected $realtor = '';
	protected $object_id = 0;
	protected $address = '';
	protected $date = '';
	protected $time = 0;
	protected $clients = '';

	function __construct ($data)
	{
		$this->__set('ID', $data['ID']);
		$this->__set('realtor_id', $data['realtor_id']);
		$this->__set('object_id', $data['object_id']);

		$this->realtor = $data['realtor'];
		$this->address = $data['address'];
		$this->date = $data['date'];
		$this->time = $data['time'];
		foreach (explode('||', $data['clients']) as $val) {
			$c = explode('|', $val);
			$this->clients[] = new Client(array('name'=>$c[0], 'phone'=>$c[1]));
		}
	}
	public function __get ($property)
	{
        switch ($property)
        {
            default:
                return $this->$property;
        }

    }
 
    public function __set ($property, $value)
    {
        switch ($property)
        {
            case 'ID':
            case 'realtor_id':
            case 'object_id':
                if(is_numeric($value)) $this->$property = $value;
                break;
            default:
            	$this->$property = $value;
        }
    }
	static function add ($inspection)
	{
		global $DB;
		$p1 = $DB->conn->prepare('INSERT INTO inspections (realtor_id,object_id,date,time) VALUES (?,?,?,?)');
		$p2 = $DB->conn->prepare('INSERT INTO inspection_clients (inspection_id,client_id) VALUES (?,?)');
		try {
			$DB->conn->beginTransaction();
			$p1->execute( array(
				$inspection['realtor_id'],
				$inspection['object_id'],
				$inspection['date'],
				$inspection['time']
			) );
			$inspection['id'] = $DB->conn->lastInsertId();
			foreach($inspection['clients'] as $client_id)
				$p2->execute( array($inspection['id'], $client_id) );
			$DB->conn->commit();
		} catch(PDOExecption $e) {
			$DB->conn->rollback();
			print "Error!: " . $e->getMessage() . "</br>";
		}
	}
	static function remove ($inspection)
	{
		global $DB;
		$p1 = $DB->conn->prepare('DELETE FROM inspections WHERE ID = ?');
		$p2 = $DB->conn->prepare('DELETE FROM inspection_clients WHERE inspection_id = ?');
		try {
	        $DB->conn->beginTransaction();
	        $p1->execute( array($inspection['inspection_id']) );
	        $p2->execute( array($inspection['inspection_id']) );
	        $DB->conn->commit();
	    } catch(PDOExecption $e) {
	        print "Error!: " . $e->getMessage() . "</br>"; 
	    }
	}
}
#if(isset($_POST['add_inspection'])) Inspection::add($_POST);
#if(isset($_POST['remove_inspection'])) Inspection::remove($_POST);
?>