<?php
error_reporing(E_ALL);
ini_set('display_errors', true);

echo '<pre>git pull' . "\n";
exec('git pull', $result);
echo $result;
echo 'git finish</pre>';