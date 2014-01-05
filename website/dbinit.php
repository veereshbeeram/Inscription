<?php
// Database connection opening.....
$sqlcon = mysql_connect("localhost","enginee8_userins","Pass!@3");
if(!$sqlcon){
die ("Connection to db failed.. :( please hold on while we fix the problem");
}
mysql_select_db("enginee8_finalinsc",$sqlcon);
?>
