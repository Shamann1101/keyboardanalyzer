<?php

class Analyzer
{
	/**
	* Адрес файла анализатора
	*/
	const PATCH = 'log/analyzer.txt';
	
	/**
	* Функция поиска предыдущего значения ключа
	*
	* @param string $key
	* @return string
	*/
	public function edit_data($key) {
		
		if (!$handle = fopen(self::PATCH, 'c+')) {
			 echo "Не могу открыть файл";
			 exit;
		}
		if (filesize(self::PATCH) == 0) {
			$somecontent = array ('count' => '1', $key => '1');
			fwrite($handle, json_encode($somecontent));
			fclose($handle);
			return 100;
		}
		$contents = fread($handle, filesize(self::PATCH));
		$contents = json_decode($contents);	//Ругается на формат
		print_r($contents);
		
		$x = 1;
		
		if (isset($contents[$key])) {
			$x = $contents[$key];
		};
		
		$proc = ($x / $contents['count'] * 100);
		
		fclose($handle);
		
		return $proc;
	}
	
	/**
	* Результирующий метод класса
	*
	*/
	public function __construct($key) {
		echo $this->edit_data($key);
	}
}

?>