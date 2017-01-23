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
//			echo 'key='.$key;
//            var_dump($handle);
			return 'New file. 100';
		}

		$x = 1;
		$contents = file_get_contents(self::PATCH);
/*
		$contents = fread($handle, filesize(self::PATCH));
        $contents = json_decode($contents, self::JSON_AS_ARRAY);
*/
//        $contents = str_split($contents);
        var_dump($contents);
        echo PHP_EOL.'---------'.PHP_EOL;

        if (isset($contents[$key])) {
            echo $contents[$key];
			$x = intval($contents[$key]);
		} else {
            echo 'Nope '.$key.PHP_EOL;
			$contents[$key] = 1;
		};

		$contents['count'] = intval($contents['count']) + 1;
		
		$proc = ($contents[$key] / $contents['count'] * 100);

        rewind($handle);
		fwrite($handle, json_encode($contents));
		fclose($handle);

//        echo 'key='.$key.' ';
		return $proc;
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
