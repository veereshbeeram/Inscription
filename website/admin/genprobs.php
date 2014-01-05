<?php
session_start();
	if(!session_is_registered("INSUSER") || $_SESSION['ISADMIN']=='0'){
	// already logged in.....
	die("denied");	
}
?>

<?php


include("../dbinit.php");
$sqlstat = "select problemID from problems";
$sqlres = mysql_query($sqlstat);
$numrows = mysql_num_rows($sqlres);

//set numrows...
$file=fopen("../problems/judgeconfigurations.php","w") or exit("Unable to open file!");
//if($file = fopen("../judgeconfigurations.php","w")){
	
$writestring = "<?php \$num_probs = $numrows ?>";
fwrite($file,$writestring);
fclose($file);
$javaids = array(1=>'one.java',2=>'two.java',3=>'three.java',4=>'four.java',5=>'five.java',6=>'six.java',7=>'seven.java',8=>'eight.java',9=>'nine.java',10=>'ten.java',11=>'eleven.java',12=>'tweleve.java');
while($arow=mysql_fetch_array($sqlres)){
$sqlstat2 = "select * from problems where problemID='$arow[problemID]'";
$sqlres2=mysql_query($sqlstat2);
$arow2 =mysql_fetch_array($sqlres2);
if($arow2[isipsc]==1){
$isipsctext = "   IPSC format problem";	
$javatext = "";
}
else{
	$isipsctext = "";
	$javaid = $javaids[$arow[problemID]];
	$javatext = "Java id is '$javaid'";
}
	
$input = str_replace("\n","<br/>",$arow2[inputFormat]);
$output = str_replace("\n","<br/>",$arow2[outputFormat]);
$example = str_replace("\n","<br/>",$arow2[exampleText]);

$downloadipsc="";
if($arow2[isipsc]==1){
if(strlen($arow2[inputFile])>0){
$downloadipsc = <<<IPSC
 			<h3>IPSC input Test Case File</h3>
			<p>Download the Input test case file <a href="getipsc$arow[problemID]">Here</a></p>
IPSC;
}
}
$phpstr = "<?php if (isset(\$_REQUEST['_SESSION'])) die('Get lost Muppet!');";
$phpstr2 = "if(\$_SESSION['conteston']==\"false\") die(\"<div id='main'><br/><h1>Contest is not running</h1></div>\");?>";

$page = <<<STARTSTRING
<!-- welcome message start-->
$phpstr
$phpstr2

<div id="welcome">
		<div id="wel-text">
			<h1>Welcome to Inscription - online programming contest of Engineer 2010</h1>
        </div>
        <span id="wel-btn" ><a href="#" style="font-size:16px" id="insctimer">Timer</a></span>
       
</div>
<!-- welcome message end-->
<!-- main content start-->
<div id="main">
	<!-- left coloumn posts start -->
	<div id="left-coloumn">
		<!-- featured post start -->
		<div id="single-post">
			<h2 class="page-title"><a href="#">$arow2[problemTitle]</a></h2>			
			<div class="post-content">
			
			<h3>Description</h3>
			<p>$isipsctext</p>
			<p>$arow2[problemDes]</p>
			
			<h3>Input Format</h3>
			<p>$input</p>
			
			<h3>OutputFormat</h3>
			<p>$output</p>
			 
			 <h3>Example Text</h3>
			<p>$example</p>
			
			 <h3>C/CPP Time</h3>
			<p>$arow2[ctime] seconds  $isipsctext</p>
			 <h3>Java Time</h3>
			<p>$arow2[javatime] seconds  $javatext</p>
			$downloadipsc
			</div>
		</div>
		<!-- featured post end -->
		<form action="answer$arow[problemID]" id="customForm" method="post" >
		<div style="float:left">
			<input id="send" name="send" type="submit" value="Solution/Comments" />
		</div>
		</form>
	</div>

STARTSTRING;


$file = fopen("../problems/challenge".$arow[problemID].".php","w") or exit("uable to create challenge");
fwrite ($file,$page);
fclose($file);

}
echo "Generated".$numrows."problems<br/>";
/*}
else
	echo "failed";*/
?>
