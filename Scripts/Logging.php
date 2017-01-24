<?php

class Logging
{
	/**
     * Возвращает JSON как массив
     */
    const JSON_AS_ARRAY = true;
	
	/**
	* Директория с файлами лога
	*/
	const DIR = 'log/';
	
	/**
	* Преобразует JSON в массив PHP
	*
	* @param string $param входные данные в формате JSON
	* @return array
	*/
	public function jsonDecoder($param) {
		$result = json_decode($param, self::JSON_AS_ARRAY);
        if (json_last_error()) {
            echo('Не удается прочитать JSON');
        }
        return $result;
	}
	
	/**
	* Запись данных в лог-файл
	*
	* @param array $param входной массив PHP
	*/
	public function writing($param) {
//		$fileName = str_replace('.', '_', $param['user_ip']).'.txt';
		$fileName = $param['user_id'].'.txt';
		$fileDir = self::DIR.$fileName;

		$arrkey = array_keys($param);
		$arrval = array_values($param);
		$data = '';
		for ($i = 0; $i < count($arrval); $i++) {
			if ($arrkey[$i] == 'user_id') {
				continue;
			}
			$data .= $arrval[$i].' ';
		}

		$data .= PHP_EOL;

		if (!$handle = fopen($fileDir, 'a')) {
			 echo "Не могу открыть файл ($fileDir)";
			 exit;
		}

		if (fwrite($handle, $data) === FALSE) {
			echo "Не могу произвести запись в файл ($fileDir)";
			exit;
		}

		fclose($handle);
	}
	
	/**
	* Результирующий метод класса
	*
	* @param array $input входной массив Json
	*/
//	public function run($input) {
	public function __construct($input) {
		$this->writing($input);
	}
}