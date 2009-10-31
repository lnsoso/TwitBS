<?php
define('CACHE', true);
define('DEBUG', true);
define('TIME', time());

if (DEBUG)
{
	error_reporting(E_ALL);
	ini_set('display_errors', true);
}

function __autoload($clsname)
{
	$clsname = str_replace('_', '/', $clsname);
	require_once $clsname . '.php';
}