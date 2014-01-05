<?php
session_start();
	if(!session_is_registered("INSUSER") || $_SESSION['ISADMIN']=='0'){
	// already logged in.....
	die("denied");	
}
?>

<?php
include("../dbinit.php");
if($_GET[todo] == 0){
	$sqlstat = "delete from comments where commentID='$_GET[id]'";
	$resp = "<p> Deleted</p>";
}
else if($_GET[todo] == 1){
	$sqlstat = "update comments set isapproved='1' where commentID='$_GET[id]'";
		$resp = "<p> Approved</p>";
}
	
$sqlres = mysql_query($sqlstat);
mysql_close($sqlcon);

echo $resp;
?>