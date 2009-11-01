<?php
require_once 'config.php';

$req = new cls_request();
$req->dispatch();

if (defined('DEBUG') && DEBUG)
{
	global $debug = new cls_debug();
	$debug->cost_time('<br />total runtime:', TIME);
}