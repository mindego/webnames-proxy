<?php
// Объявляем переменные
$user = 'test';
$pass = 'test';
//$url = 'https://www.webnames.ru:81/RegTimeSRS.pl';
$url = 'http://10.0.0.6/webnames-proxy/proxy.php';
$version = 'Webnames.ru test script version 3.14.15.9.26.5';

// Фиксируем символ переноса строки в случае командной строки или <br> для отображения через вебсервер
if (substr(php_sapi_name(), 0, 3) == 'cli') $ENDLINE=PHP_EOL; else $ENDLINE='<br>';

// Объявляем параметры для отправки на сервер.
$fields = [
    'username'          => $user,
    'password'           => $pass,
'utf8' => '1',
          'interface_revision' => '1',
          'thisPage' => 'pispRenewDomain',
          'domain_name' => 'berendeevdom.ru',
	    'period'=>'1',
];

// Преобразуем список параметров в единую строку
$fields_string = http_build_query($fields);
echo $fields_string;

echo $ENDLINE;

// Отправляем запрос на сервер
echo send_request($url, $fields_string);
echo $ENDLINE;


function send_request($url, $fields_string) {
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

$result = curl_exec($ch);

curl_close($ch);
return $result;
}
?>