<?php
session_start();
	if(!session_is_registered("INSUSER") || $_SESSION['ISADMIN']=='0'){
	// already logged in.....
	die("denied");	
}
?>


<?php

if(isset($_POST['send'])){

$sqlstat = "SELECT t.team_id,t.team_name,t.teampass  FROM team_users u, teams t WHERE u.user_email = '$_POST[email]' AND u.team_id = t.team_id AND t.event_id = '5'";
$sqlres = mysql_query($sqlstat);
$arow=mysql_fetch_array($sqlres);
?>
<form action='helpme.php' method='post'>
<p>TeamID<input type='text' name='tid' readonly='readonly' value=<?php echo "'$arow[team_id]'"?> /></p>
<p>TeamName<input type='text' name='tname'  value=<?php echo "'$arow[team_name]'"?> /></p>
<p>TeamPass<input type='text' name='tpass'  value=<?php echo "'$arow[teampass]'"?> /></p>
<input id="send" name="sendchange" type="submit" value="Change" />

</form>

<?php } 
else {

if(isset($_POST['sendchange'])){
$sqlstat = "update teams set team_name='$_POST[tname]' and teampass='$_POST[tpass]';";
$sqlres = mysql_query($sqlstat);

}
?>
<form action='helpme.php' method='post'>
<p>E-mail<input type='text' name='email' /></p>
<input id="send" name="send" type="submit" value="Get Details" />
<?php
}
?>


