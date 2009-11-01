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

		if (empty($dirs['dirname']) || $dirs['dirname'] == '.')
		{
			$dirs['dirname'] = 'default';
		}

		if (empty($dirs['filename']))
		{
			$dirs['filename'] = 'index';
		}
		
		$controller = 'controller_' . str_replace('/', '_', $dirs['dirname']);
		$method = $dirs['filename'];

		$controller = new $controller();
		$controller->$method();

		if (DEBUG)
		{
			$GLOBALS['debug']->dump('[URI]', $uri);
			$GLOBALS['debug']->dump('[DIRS]', $dirs);
			$GLOBALS['debug']->dump('[CONTROLLER]', $controller);
			$GLOBALS['debug']->dump('[METHOD]', $method);
		}
	}
}