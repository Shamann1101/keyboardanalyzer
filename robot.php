<?php

require_once('Scripts/Logging.php');
require_once('Scripts/Analyzer.php');

if (empty($_POST)) echo 'INPUT DATA IS EMPTY';

$data = $_POST;

$data['user_ip'] = $_SERVER['REMOTE_ADDR'];

$log = new Logging($data);

$proc = new Analyzer($data['key']);


