<?php
define('CACHE', true);
define('DEBUG', true);
define('TIME', time());

function __autoload($clsname)
{
	$clsname = str_replace('_', '/', $clsname);
	require_once $clsname . '.php';
}