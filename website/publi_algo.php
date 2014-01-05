<?php

$sqlcon = mysql_connect("localhost","enginee8_rdonly","Pass123");
if(!$sqlcon){
die ("DB con failed");
}
mysql_select_db("enginee8_inscriptionalpha",$sqlcon);

$output="";
$sqlstat = "select * from publi where event='2'";
$sqlres = mysql_query($sqlstat);
while($arow=mysql_fetch_array($sqlres)){
$output = $output.','.$arow[email];
}

print $output;

mysql_close($sqlcon);
?>
