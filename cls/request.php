<?php
class cls_request
{
	public function dispatch()
	{
		if (empty($_SERVER["REQUEST_URI"]))
		{
			echo 'cli mode.';
			$cli = new cls_cli();
			$cli->dispatch();
			return;
		}
		
		$uri = parse_url($_SERVER['REQUEST_URI']);
		$dirs = explode('/', trim($uri['path'], '/'));
		var_dump($uri);
		var_dump($dirs);
	}
}