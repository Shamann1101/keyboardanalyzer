﻿<?php

class Analyzer
{
    /**
     * Директория с файлами лога
     */
    const DIR = 'log/';

    /**
      * Возвращает JSON как массив
      */
    const JSON_AS_ARRAY = true;

    /**
     * Возвращает процент появления ключа в логе пользователя
     *
     * @param $key
     * @param $user_id
     * @return float|int
     */
    function byUserID ($key, $user_id) {
        $data_array = $this->getData($key, $user_id);
        $count_data = count($data_array) + 1;
        $count_keys = 1;

        foreach ($data_array as $pressure) {
            foreach ($pressure as $item) {
                if ($item == $key) {
                    $count_keys++;
                }
            }
        }

        $percent = $count_keys / $count_data * 100;

        return $percent;
    }

    /**
     * Преобразование файла в многомерный массив по id
     *
     * @param $key
     * @param $user_id
     * @return array
     */
    function getData ($key, $user_id) {
        $patch = $this->getFileName($user_id);

        if (!is_file($patch)) {
            return array(array('key' => $key));
        }

        $data_array = file_get_contents($patch);
        $data_array = explode(';', $data_array);
        $count_data = count($data_array);

        for ($i = 0; $i < $count_data; $i++) {
            $data_array[$i] = json_decode($data_array[$i], self::JSON_AS_ARRAY);
        }

        return $data_array;
    }

    /**
     * На случай сложного формирования пути
     *
     * @param $user_id
     * @return string
     */
    function getFileName ($user_id) {
        $patch = self::DIR.$user_id.'.txt';
        return $patch;
    }

    function __construct() {
    }
}
