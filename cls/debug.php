<?php
class cls_debug
{
	public function cost_time($msg, $time)
	{
		echo $msg;
		echo time()-(float)$time;
	}
}