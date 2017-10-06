<?php
//echo "me loaded";

function writelog($logfile,$data) {
    file_put_contents("logs/".$logfile,date(DATE_ATOM)." ".$_SERVER['REMOTE_ADDR']." ".$data."\n",FILE_APPEND);
}
function writebinlog($logfile,$data,$trid=null) {
    file_put_contents("logs/".$logfile,date(DATE_ATOM)." ".$_SERVER['REMOTE_ADDR']." ".$trid." ".base64_encode($data)."\n",FILE_APPEND);
}
?>
