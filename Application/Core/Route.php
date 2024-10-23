<?php
class Route
{
	public static function start()
	{
		// url по умолчанию
		$url_name = 'main';
    $action_name = 'index';
		$routes = [];
		
		// var_dump($_GET['url']); die();
		if (isset($_GET['url'])) {
			$routes = $_GET['url'];
		}
		
		if ( !empty($routes) ) {	
			$url_name = $routes;
		}
		
		$model_name = 'Model_'.$url_name;
		$controller_name = 'Controller_'.$url_name;
		$action_name = 'Action_'.$action_name;
		
		$model_file = $model_name.'.php';
		$model_path = "Application/Models/".$model_file;
		
		if(file_exists($model_path)) {
			include $model_path;
		}
		
		$controller_file = $controller_name.'.php';
		$controller_path = "Application/Controllers/".$controller_file;
		if(file_exists($controller_path)) {
			include $controller_path;
		}
		else {
			Route::ErrorPage404();
		}
		
		$controller = new $controller_name;
		$action = $action_name;

		if(method_exists($controller, $action)) {
			$controller->$action();
		}
		else {
			Route::ErrorPage404();
		}
	}

	function ErrorPage404()
	{
    $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
    header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
	}
}