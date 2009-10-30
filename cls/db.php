<?php
class cls_db
{
	public function __construct($s = null)
	{
		if ($s == null)
		{
			$s = $this->get_default_config();
		}
		elseif (is_string($s))
		{
			$s = $this->parse_config($s);
		}
		elseif (!is_array($s))
		{
			echo 'wrong $s = ';
			var_dump($s);
			die();
		}
		
	}
	
	public function get_default_config()
	{
		if (!empty($_GLOBAL['config']['db']))
		{
			return $_GLOBAL['config']['db'];
		}
	}

	public function parse_config($s)
	{
		
	}
}