<?php
class cls_request
{
	public function dispatch()
	{
		if (empty($_SERVER["REQUEST_URI"]))
		{
			echo '[MODE] cli-mode running.' . "\n";

			$cli = new cls_cli();
			$cli->dispatch();
	
			return;
		}
		
		$uri = parse_url($_SERVER['REQUEST_URI']);
		$dirs = pathinfo(trim($uri['path'], '/'));
		$controller = 'controller_' . str_replace('/', '_', $dirs['dirname']);
		$method = $dirs['filename'];

		// $controller = new $controller();
		// $controller->$method();

		var_dump($uri, $dirs, $controller, $method);
		// require_once $controller . '.php';
	}
}