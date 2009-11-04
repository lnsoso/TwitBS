<?php
/**
 * tools class
 */
class cls_util
{
	/**
	 * $target = 0 跳转到当前页
	 * $msg = 0 不显示任何信息
	 * $time = 0 立即跳转
	 * $args = 0 没有参数
	 */  
	static function go($target = 0, $msg = 0, $time = 0, $args = 0)
	{
		if (empty($target))
		{
			
		}
	}
	
	static function go_url($url, $code = 0)
	{
		header('Location: '. $url);
	}
}
