<?php
session_start();
	if(!session_is_registered("INSUSER") || $_SESSION['ISADMIN']=='0'){
	// already logged in.....
	die("denied");	
}
?>

<?php
	// already logged in.....
	
	$today = date("Y-m-d");
	require('../dbinit.php');
	
		$sqlstat = "INSERT INTO `comments` (`commentID` ,`category` ,`teamname` ,`title` ,`post` ,`date` ,`isapproved`) VALUES ( NULL , '0', 'administrator', '$_POST[title]', '$_POST[post]', '$today', '1' );";
	if(isset($_POST['senddel'])){
		$sqlstat = "delete from comments where title='$_POST[posttitle]';";
		
		
	}
		print '<meta http-equiv="refresh" content="1;url=\'inscriptionmain.php?pagename=adannounce\'" />';																																				mysql_query($sqlstat);
//echo $sqlstat;
mysql_close($sqlcon);

?>


