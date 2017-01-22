<?php

require_once('Scripts/Logging.php');
require_once('Scripts/Analyzer.php');

if (empty($_POST)) echo 'INPUT DATA IS EMPTY';	//Ничего не приходит
/*
$test_patch = 'log/test.txt';

$test = fopen($test_patch, 'a');

fwrite($test, ' '.$_POST['key']);

fclose($test);
*/
$data = $_POST;

$data['user_ip'] = $_SERVER['REMOTE_ADDR'];

//var_dump($data);

$log = new Logging($data);

$proc = new Analyzer($data['key']);

var_dump($proc);