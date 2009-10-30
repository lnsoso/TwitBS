<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

echo '<pre>git pull' . "\n";
exec('git pull', $result);
var_dump($result);
echo 'git finish</pre>';