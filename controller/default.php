<?php
class controller_default
{
	public function index()
	{
		echo 'in controller_default->index';
	}
	
	public function update()
	{
		echo '[GIT] pulling ...<br />';
		exec('/home/vtwoexpc/bin/git pull', $result);
		foreach($result as $r)
		{
			echo '[GIT] ' . $r . '<br />';
		}
		echo '[GIT] pulling finish<br />';
	}
}