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
	* @return array
	*/
	public function edit_data($key) {

		if (!$handle = fopen(self::PATCH, 'c+')) {
			 echo "Не могу открыть файл";
			 exit;
		}
		if (filesize(self::PATCH) == 0) {
			$data = array ('count' => 1, $key => array('key' => 1, 'last' => 0));
			fwrite($handle, json_encode($data));
			fclose($handle);
			return array('last' => 0, 'new' => 1);
		}

		$contents_read = fread($handle, filesize(self::PATCH));
        $contents = json_decode($contents_read, self::JSON_AS_ARRAY);

        echo filesize(self::PATCH).PHP_EOL;

        $proc = array('last' => 0, 'new' => 0);

        if (isset($contents[$key])) {
			$contents[$key]['key']++;
            $proc['last'] = $contents[$key]['last'];
		} else {
			$contents[$key]['key'] = 1;
        };

		$contents['count']++;

		$proc['new'] = ($contents[$key]['key'] / $contents['count'] * 100);
        $contents[$key]['last'] = $proc['new'];

        rewind($handle);
		fwrite($handle, json_encode($contents));
		fclose($handle);

		return $proc;
	}
	
	/**
	* Результирующий метод класса
	*
    * @param string $key Код введенной клавиши
	*/
	public function __construct($key) {
		$proc = $this->edit_data($key);
		printf('Клавиша с кодом %s нажимается с частотой %s. Предыдущее значение %s',
            $key, $proc['new'], $proc['last']);
		return $proc['new'];
	}
}
