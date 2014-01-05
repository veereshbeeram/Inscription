<?php
session_start();
if(!isset($_SESSION['INSUSER'])) die("login please");
if (isset($_REQUEST['_SESSION'])) die("Get lost Muppet!");
?>

<?php
include("dbinit.php");
if(isset($_GET[probnum])){
$sqlstat = "select inputFile,isipsc from problems where problemID = '$_GET[probnum]'";
$sqlres = mysql_query($sqlstat);
if($arow = mysql_fetch_array($sqlres)){
	if(strlen($arow[inputFile])>0 && $arow[isipsc] == "1"){
		// there is a input fiel and problem in question is ipsc problem
		$size = strlen($arow[inputFile]);
		$name = "InputCases".$_GET[probnum];
		header("Content-length: $size");
		header("Content-type: text/plain");
		header("Content-Disposition: attachment; filename=$name");
		echo $arow[inputFile];
	}
}



}