<?php
// Database connection opening.....
$sqlcon = mysql_connect("localhost","enginee8_rdonly","Pass123");
if(!$sqlcon){
echo "01";
}
mysql_select_db("enginee8_engix",$sqlcon);
$pvar = $_GET;
//echo $pvar[xkcd]."::".$pvar[waste];
$sqlstat = "SELECT * from teams where event_id='5' and team_name='$pvar[xkcd]';";
//echo "<br/>".$sqlstat;
$sqlres = mysql_query($sqlstat);
//echo mysql_num_rows($sqlres);
if(mysql_num_rows($sqlres)>0){
$arow=mysql_fetch_array($sqlres);
if(strlen($arow[teampass])<5){
echo "02";
}
else if(md5($arow[teampass])!=$pvar[waste]){ 
echo "04";
}
else
echo '1';
}
else{
 echo "03";
}

?>
