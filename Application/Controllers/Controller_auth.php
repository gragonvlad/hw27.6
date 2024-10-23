<?php
class Controller_auth extends Controller {
  function __construct() {
    $this->model = new Model_auth;
    $this->view = new View;
  }

	function action_index() {
		session_start();

    if ($_GET['action'] == 'logout') {
      setcookie('isauth', false, time() - 3600);
      setcookie('role', '', time() - 3600);
      header("Location: index.php?url=auth"); exit();
    }

    if (!isset($_SESSION['CSRF'])) {
      $token = hash('gost-crypto', random_int(0,999999));
      $_SESSION["CSRF"] = $token;
    }
    else {
      $token = $_SESSION["CSRF"];
    }
    // $data = $this->model->get_data();
    $data = [];

		// проверка, получен ли access_token от ВК
		if (isset($_GET['code'])) {
			$this->model->authorizeVK($_GET['code']);
		}

    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
    if (isset($_REQUEST['register'])) {
			$this->model->register($login, $pass);
    }
    else if (isset($_REQUEST['authorize'])) {
      $this->model->authorize($login, $pass, $token);
    }
    else if (isset($_REQUEST['authorizeVK'])) {
      $this->model->getAuthorizeVkQuery();
    }
		$data['token'] = $token;

		$this->view->generate('auth_view.php', 'template_view.php', $data);
	}
} 