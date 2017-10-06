<?php
include_once("log.php");
include_once("api_fields_list.php");
$url = 'https://www.webnames.ru:81/RegTimeSRS.pl';

$REQUEST=$_POST;
//if (!isset($REQUEST['username'])) {
//	echo "Empty request";
//        exit;
//    } else {
	$trid=uniqid();
	$extendedlog=$REQUEST['extendedlog'];
	$supresslogin=$REQUEST['supresslogin'];
	unset($REQUEST['extendedlog']);
	unset($REQUEST['supresslogin']);

if ($supresslogin=="true") {
    $REQUEST['username']="test";
    $REQUEST['password']="test";
}
//    }

$fields_string=(http_build_query($REQUEST));
writelog("request.log",$trid." ".$fields_string);
$result=send_request($url, $fields_string);
//writelog("request.log",$trid." ".$result);
writebinlog("request.log",$result,$trid);

if ($extendedlog=="true") extended_log($REQUEST,$trid);

echo $result;
    
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

function extended_log($REQUEST,$trid) {
include("api_fields_list.php");
    echo date(DATE_ATOM)." транзакция ".$trid."\n";
    var_export($REQUEST);
    echo "\n";
    echo "Отсутствуют переменные:\n";
    echo "Основные:\n";
    var_export(array_diff_key($common_fields,$REQUEST));    
    echo "\n";
    echo "Необязательные:\n";
    var_export(array_diff_key($optional_fields,$REQUEST));    
    echo "\n";
}
?>