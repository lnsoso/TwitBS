<?php
class controller_default
{
	public function index()
	{
		echo 'in controller_default->index';
	}
	
	public function update()
	{
		echo 'git pull<br />';
		exec('/home/vtwoexpc/bin/git pull', $result);
		foreach($result as $r)
		{
			echo $r . "<br />";
		}
		echo 'git finish';
	}
}