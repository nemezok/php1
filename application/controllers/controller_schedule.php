<?php
class Controller_schedule extends Controller
{
	function __construct ()
	{
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