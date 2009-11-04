<?php
class cls_debug
{
	private static $singleton = null;
	
	public function singleton()
	{
		if (empty(cls_debug::singleton))
		{
			cls_debug::$singleton = new __self__();
		}
		
		return cls_debug::$singleton;
	}
	
	private function __construct()
	{
		
	}

	public function cost_time($msg, $time)
	{
		echo $msg;
		echo time()-(float)$time;
	}
	
	public function dump($msg, $value)
	{
		echo $msg;
		var_dump($value);
		echo "<br />";
	}
}