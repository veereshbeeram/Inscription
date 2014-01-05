<?php


$sqlcon = mysql_connect("localhost","enginee8_rdonly","EngiPass123");

if(!$sqlcon){

die ("My SQL connection failed, contact admin");

}

mysql_select_db("enginee8_engix",$sqlcon);



$sqlstat = "select count(*) as total,event_id from `registration` group by event_id ORDER by total DESC ";
$sqlres = mysql_query($sqlstat);
$i=1;
print "<table><tr><th>Rank</th<th>Name<th></th><th>Total</th></tr>";

while($arow=mysql_fetch_array($sqlres)){
$sqlstat2 = "select * from events_info where event_id=$arow[event_id]";
$sqlres2 = mysql_query($sqlstat2);
$arow2= mysql_fetch_array($sqlres2);
print "<tr><td>$i</td><td>$arow2[event_name]</td><td>$arow[total]</td></tr>";
$i++;
}

print "</table>";

mysql_close($sqlcon);
?>