<?php

require_once('Scripts/Logging.php');
require_once('Scripts/Analyzer.php');

$params = array ('user_ip' => '127.0.0.1', 'key' => 'a', 'date_load' => '19-1-2017');

$params_json = json_encode($params);

echo $params['key'];
$test = new Analyzer($params['key']);
