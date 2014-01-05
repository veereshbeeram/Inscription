<?php
if (isset($_REQUEST['_SESSION'])) die("Get lost Muppet!");
?>
<style type="text/css">
th{
	font-size:16px;
}
</style>
<!-- welcome message start-->

<div id="welcome">
		<div id="wel-text">
			<h1>Welcome to Inscription - My submissions</h1>
        </div>
        <span id="wel-btn" ><a href="#" style="font-size:16px" id="insctimer">Timer</a></span>
       
</div>
<!-- welcome message end-->
<!-- main content start-->
<div id="main">
	<!-- left coloumn posts start -->
	<div id="left-coloumn">
		<div id="single-post">
        <h2 class="page-title"><?php echo $_SESSION['INSUSER']; ?>'s submissions</h2>
        <div class="post-content">
        <table border="1" width="100%" style="text-align:center;">
		<tr style="padding-bottom:10px"><th>Problem</th><th>Status</th><th>Submission Time</th></tr>
		<?php 
		
		$fp = fopen("./admin/judgeconfig","r");
		$statusJudge = fread($fp,filesize("./admin/judgeconfig"));
		if($statusJudge=="true"){
			$output = "Evaluator is running";
			$color = "#96FF84";
		}
		else{
			$output = "Evaluator is not running";
			$color = "#FF7979";
		}
		print "<h2 style='background-color:$color'>$output</h2><br/><br/>";
		
		$user = $_SESSION['INSUSER'];
		$status_codes = array('ACCEPTED','WRONG_ANSWER','COMPILATION_ERROR','TIME_LIMIT_EXCEEDED','SEGMENTATION_FAULT','ARITHMETIC_EXCEPTION','RUN_TIME_ERROR','WAITING');
		$sqlstat = "select p.problemTitle,s.status,s.submissiontime from problems p, submission s where s.teamname='$user' and s.problemID=p.problemID";
		$sqlres=mysql_query($sqlstat);
		
		while($arow=mysql_fetch_array($sqlres)){
			$bgcolor = "#FF7979";
			if($arow[status] == "7"){
				$bgcolor = "";
			}
			if($arow[status] == "0"){
				$bgcolor = "#96FF84";
			}
			$status = $status_codes[$arow[status]];
			print "<tr style='background-color:".$bgcolor.";margin-bottom:10px;'><td>$arow[problemTitle]</td><td>$status</td><td>$arow[submissiontime]</td></tr>";
			
		}
		?>
		</table>
        </div>
        </div>
	</div>
	<!--end of left-->
	<div class="defloater">&nbsp;</div>
	<!-- main content end -->
</div>
