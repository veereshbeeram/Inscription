<?php
session_start();

if(isset($_POST['sendlogin'])){
if($_POST['userid'] == 'publicity' && $_POST['password'] == 'yeah'){
session_register("USER");
$_SESSION['USER']='true';

}
}
if(isset($_SESSION['USER']) && $_SESSION['USER'] == 'true'){
print "<p>Logged in</p>";
if(isset($_POST['sendemail'])){
$sqlcon = mysql_connect("localhost","enginee8_rdonly","Pass123");

if(!$sqlcon){

die ("DB con failed");

}

mysql_select_db("enginee8_inscriptionalpha",$sqlcon);

$events = array('OnlineMath'=>'1','OnlineAlgo'=>'2','Inscription'=>'3');
$splitted = explode(',',$_POST[emails]);
$email = array_shift($splitted);
while($email){

if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)){
$eventid = $events[$_POST['event']];
print "insert $eventid and $email<br/>";

$sqlstat = "insert into publi values('$eventid','$email');";
//echo $sqlstat;
$sqlres = mysql_query($sqlstat);
}
$email = array_shift($splitted);
}
mysql_close($sqlcon);
}
else{
?>
<form action='publi.php' method='post'>
<select name='event'>
<option>OnlineMath</option>
<option>OnlineAlgo</option>
<option>Inscription</option>
</select>
Emails as csv
<textarea name='emails'></textarea>
 <input type="submit" name='sendemail' value="Submit"/>
</form>
<?php
}
}
else {
?>
<form action="publi.php" method="post">

<p> User Name :: <input type="text" name="userid" maxlength="20"/></p>
<p> Password :: <input type="password" name="password" maxlength="30"/></p>
<p> <input type="submit" name='sendlogin' value="Submit"/></p>
</form>
<?php
}
?>
