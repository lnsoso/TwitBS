<?php
require_once 'config.php';

$req = new cls_request();
$req->dispatch();

if (defined('DEBUG') && DEBUG)
{
	$debug = cls_debug::singleton();
	$debug->cost_time('<br />[TIME] total runtime : ', TIME);
}