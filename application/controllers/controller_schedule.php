<?php
class Controller_schedule extends Controller
{
	function __construct ()
	{
		global $DB;
		if(isset($_POST['add_inspection'])) $DB->addInspection($_POST);
		if(isset($_POST['remove_inspection'])) $DB->removeInspection($_POST);

		$this->model = new Model_Schedule();
		$this->view = new View();
	}

	function action_index ()
	{
		$data = $this->model->get_data();
		$this->view->generate('schedule_view.php', 'template_view.php', $data);
	}
}
?>