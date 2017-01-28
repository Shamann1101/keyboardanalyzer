<?php

require_once('Scripts/Logging.php');
require_once('Scripts/Analyzer.php');

if (empty($_POST)) echo 'INPUT DATA IS EMPTY';

$data = $_POST;

$data['user_ip'] = $_SERVER['REMOTE_ADDR'];

try {
    $analyzer = new Analyzer();
    $percent = $analyzer->byUserID($data['key'], $data['user_id']);
    $data['result'] = $percent;
    $log = new Logging($data);
    printf('Клавиша %s нашимается с частотой %s', $data['key'], $percent);
} catch (Exception $e) {
    echo 'Поймано исключение: ',  $e->getMessage(), "\n";
}
