<?php
class Route
{
	static function start () {
		// контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		if ( !empty($routes[1]) ) $controller_name = $routes[1];
		if ( !empty($routes[2]) ) if(!substr_count($routes[2], '?')) $action_name = $routes[2];

		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		$model_path = 'application/models/' . strtolower($model_name) . '.php';
		$controller_path = 'application/controllers/' . strtolower($controller_name) . '.php';

		if (file_exists($model_path)) include $model_path;
		if (file_exists($controller_path)) include $controller_path;
		else Route::ErrorPage404();
		
		$controller = new $controller_name;
		
		if (method_exists($controller, $action_name)) $controller->$action_name();
		else Route::ErrorPage404();
	}

	function ErrorPage404 () {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
}
?>