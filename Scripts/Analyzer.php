<?php

class Analyzer
{
	/**
	* Адрес файла анализатора
	*/
	const PATCH = 'log/analyzer.txt';

    /**
     * Возвращает JSON как массив
     */
    const JSON_AS_ARRAY = true;

	/**
	* Функция поиска предыдущего значения ключа
	*
	* @param string $key Код введенной клавиши
	* @return string
	*/
	public function edit_data($key) {
		
		if (!$handle = fopen(self::PATCH, 'c+')) {
			 echo "Не могу открыть файл";
			 exit;
		}
		if (filesize(self::PATCH) == 0) {
			$data = array ('count' => 1, $key => 1);
			fwrite($handle, json_encode($data));
			fclose($handle);
			return '100';
		}

		$x = 1;

		$contents = fread($handle, filesize(self::PATCH));
        $contents = json_decode($contents, self::JSON_AS_ARRAY);

        if (isset($contents[$key])) {
			$contents[$key]++;
		} else {
			$contents[$key] = 1;
		};

		$contents['count']++;
		
		$proc = ($contents[$key] / $contents['count'] * 100);

        rewind($handle);
		fwrite($handle, json_encode($contents));
		fclose($handle);
		
		return (string) $proc;
	}
	
	/**
	* Результирующий метод класса
	*
    * @param string $key Код введенной клавиши
	*/
	public function __construct($key) {
		$proc = $this->edit_data($key);
		printf('Клавиша с кодом %s нажимается с частотой %s', $key, $proc);
	}
}
