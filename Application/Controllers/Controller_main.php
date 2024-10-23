<?php
class Controller_main extends Controller {
  function __construct() {
    $this->model = new Model_main;
    $this->view = new View;
  }

	function action_index() {
		session_start();
    // $data = $this->model->get_data();
    $data = [];
		$data["isauth"] = $_COOKIE["isauth"];
		$data["role"] = $_COOKIE["role"];

		$this->view->generate('main_view.php', 'template_view.php', $data);
	}
} 