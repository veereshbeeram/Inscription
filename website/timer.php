<?php
session_start();
// time is in YYYY ":" MM ":" DD " " HH ":" MM ":" SS
$sqlstat = "select * from contest LIMIT 1";
$sqlres = mysql_query($sqlstat);
$arow= mysql_fetch_array($sqlres);
//$starttime = "2010-10-13 00:00:00";
//$endtime = "2010-10-14 04:20:00";

date_default_timezone_set('Asia/Calcutta');
$starttime = $arow[starttime];
$endtime = $arow[endtime];

$start = strtotime($starttime);
$end = strtotime($endtime);
$end =$end+60;
$datenow = date("Y-m-d H:i:s");
$now = strtotime($datenow);

	$_SESSION['conteston'] = "false";
if($now < $start){
	$string = "To Start";
	$end = $start;
}
else if($now>=$start && $now <$end){
	$string = "To End";
	$_SESSION['conteston'] = "true";
}
else{
	$now = $end;
	$string = "ENDED";
}
$hrs = floor(($end - $now)/3600);
//echo $hrs;
$min = floor((($end - $now)%3600)/60);
//echo "::".$min;
$sec =(($end - $now)%60)+1;
//echo "::".$sec;


?>
