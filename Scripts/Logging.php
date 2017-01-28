<?php

class Logging
{
	/**
	 * Директория с файлами лога
	 */
	const DIR = 'log/';
	
	/**
 	 * Запись данных в лог-файл
	 *
	 * @param array $param входной массив PHP
     * @throws string входные параметры
	 */
	public function writing($param) {
        $filePatch = '';
		foreach ($param as $key => $value) {
            if (empty($param[$key]) && $key != 'result') {
                throw new Exception('Не хватает данных "'.$key.'"');
            }
		    if ($key == 'user_id') {
                $fileName = $param['user_id'] . '.txt';
                $filePatch = self::DIR . $fileName;
                unset($param[$key]);
            }
        }

        if (empty($filePatch)) {
            throw new Exception('Нет файла для лога');
        }

        $put_content = json_encode($param);

        if (is_file($filePatch)) {
            if (filesize($filePatch) > 0) {
                $put_content = ';'.PHP_EOL.json_encode($param);
            }
        }

        file_put_contents($filePatch, $put_content, FILE_APPEND);

	}

    /**
     * Проверка существования директории для лога
     *
     * @param string $dir
     */
	function checkDir ($dir = self::DIR) {
	    if (!is_dir($dir)) {
	        mkdir($dir);
        }
    }
	
	/**
	 * Результирующий метод класса
	 *
	 * @param array $input входной массив Json
	 */
	public function __construct($input) {
	    $this->checkDir();
		$this->writing($input);
	}
}