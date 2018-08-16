<?php
class Model_Schedule extends Model
{
	protected $data = [
		'object_list' => [],
		'realtor_list' => [],
		'client_list' => [],

		'current_object' => [],
		'current_object_inspections' => [],
		'current_realtor_inspections' => [],
	];
	public function __construct ()
	{
		global $DB;

		foreach($DB->getObjects() as $o) $this->data['object_list'][$o['ID']] = new Object($o);
		foreach($DB->getRealtors() as $r) $this->data['realtor_list'][$r['ID']] = new Realtor($r);
		foreach($DB->getClients() as $c) $this->data['client_list'][$c['ID']] = new Client($c);
		
		if ($_GET['oid']) {
			$this->data['current_object'] = new Object($DB->getObjects($_GET['oid'])[0]);
			
			foreach($DB->getInspections($_GET['oid']) as $insp)
				$this->data['current_object_inspections'][$insp['date']][$insp['time']] = new Inspection($insp);
		}

		if ($_GET['rid']) {
			foreach($DB->getInspections(null, $_GET['rid']) as $insp)
				$this->data['current_realtor_inspections'][$insp['date']][$insp['time']] = new Inspection($insp);
		}
	}
	public function get_data ()
	{
		return $this->data;
	}
}
?>