<?php

require_once('Scripts/Logging.php');
require_once('Scripts/Analyzer.php');

if (empty($_POST)) echo 'ERROR';	//Ничего не приходит

$http=fopen("php://stdin","r");
$tmp='';
while($s=fread($http,1024))
	$tmp.=$s;
fclose($http);

var_dump($tmp);

$log = new Logging($_POST);
?>