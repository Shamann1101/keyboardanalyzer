<?php

require_once('Scripts/Logging.php');
require_once('Scripts/Analyzer.php');

try {
    if (empty($_POST)) {
        throw new Exception('Нет входных данных');
    }
    $data = $_POST;
    $data['user_ip'] = $_SERVER['REMOTE_ADDR'];

    $analyzer = new Analyzer();
    $percent = $analyzer->byUserID($data['key'], $data['user_id']);
    $data['result'] = $percent;
    $log = new Logging($data);
    printf('Клавиша %s нашимается с частотой %s', $data['key'], $percent);
} catch (Exception $e) {
    echo 'Поймано исключение: ',  $e->getMessage(), "\n";
}
