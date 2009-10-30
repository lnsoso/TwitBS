<?php
require_once 'config.php';

$req = new cls_request();
$req->dispatch();

if (defined('DEBUG') && DEBUG)
{
	$debug = new cls_debug();
	$debug->cost_time("\n\n" . 'total runtime:', TIME);
}