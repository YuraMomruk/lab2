<?php
class Route
{
	static $routes;
	static function start()
	{
		$controller_name = 'Main';
		$action_name = 'index';
		
		Route::$routes = explode('/', $_SERVER['REQUEST_URI']);

		if ( !empty(Route::$routes[1]) )
		{	
			$controller_name = Route::$routes[1];
		}
		
		if ( !empty(Route::$routes[2]) )
		{
			$action_name = Route::$routes[2];
		}
		
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		$model_file = strtolower($model_name).'.php';
		$model_path = "application/models/".$model_file;
		if(file_exists($model_path))
		{
			include_once $model_path;
		}
		else
		{
        throw new Exception($model_path.' ->Model not found. 404');
		}

		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "application/controllers/".$controller_file;
		if(file_exists($controller_path))
		{
			include_once $controller_path;
		}
		else
		{
        throw new Exception($controller_path.' ->Controllers not found. 404');
		}
		
		$controller = new $controller_name;
		$action = $action_name;
		if(method_exists($controller, $action))
		{
			$controller->$action(Route::$routes[3]);
		}
		else
		{
        throw new Exception('action not found. 404');
		}
	
	}
}
?>