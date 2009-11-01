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
			$GLOBAL['debug']->dump('[URI]', $uri);
			$GLOBAL['debug']->dump('[DIRS]', $dirs);
			$GLOBAL['debug']->dump('[CONTROLLER]', $controller);
			$GLOBAL['debug']->dump('[METHOD]', $method);
		}
	}
}