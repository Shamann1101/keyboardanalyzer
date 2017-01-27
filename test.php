<?php

require_once('Scripts/Logging.php');
require_once('Scripts/Analyzer.php');
$key = '32';
$data = array('date_load' => '27-1-2017', 'time_load' => '19:10:24', 'key' => $key, 'user_id' => '27-1-2017-19-10-24',
    'result' => 0);

$data['user_ip'] = $_SERVER['REMOTE_ADDR'];

try {
    $analyzer = new Analyzer();
    $percent = $analyzer->byUserID($key, '27-1-2017-19-10-24');
    $data['result'] = $percent;
    $log = new Logging($data);
} catch (Exception $e) {
    echo 'Поймано исключение: ',  $e->getMessage(), "\n";
}
