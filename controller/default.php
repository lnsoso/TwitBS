<?php
class controller_default
{
	public function index()
	{
		echo 'in controller_default->index';
	}
	
	public function update()
	{
		error_reporting(E_ALL);
		ini_set('display_errors', true);

		echo '<pre>git pull' . "\n";
		exec('/home/vtwoexpc/bin/git pull', $result);
		var_dump($result);
		echo 'git finish</pre>';
	}
}