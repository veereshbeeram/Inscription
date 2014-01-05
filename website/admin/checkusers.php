<?php
session_start();
	if(!session_is_registered("INSUSER") || $_SESSION['ISADMIN']=='0'){
	// already logged in.....
	die("denied");	
}
?>

<style type="text/css">
th{
	font-size:16px;
}
</style>
<!-- welcome message start-->

<div id="welcome">
		<div id="wel-text">
			<h1>User Stats</h1>
        </div>
        <span id="wel-btn" ><a href="#" style="font-size:16px" id="insctimer">Timer</a></span>
       
</div>
<!-- welcome message end-->
<!-- main content start-->
<div id="main">
	<!-- left coloumn posts start -->
	<div id="left-coloumn">
		<div id="single-post">
        <h2 class="page-title">Active Users</h2>
        <div class="post-content">
        <table border="1" width="100%">
		<tr style="padding-bottom:10px"><th>TeamName</th></tr>
<?php
		$sqlstat = "select distinct(teamname) from userlogin where isactive!='0'";
		$sqlres=mysql_query($sqlstat);
		
		while($arow=mysql_fetch_array($sqlres)){
				$bgcolor = "#96FF84";
			print "<tr style='background-color:".$bgcolor.";margin-bottom:10px;'><td>$arow[teamname]</td></tr>";
			
		}
		?>
		</table>
        </div>
	<div class="defloater">&nbsp;</div>
        <h2 class="page-title">All Users</h2>
        <div class="post-content">
        <table border="1" width="100%">
		<tr style="padding-bottom:10px"><th>TeamName</th></tr>
<?php
		$sqlstat = "select distinct(teamname) from userlogin";
		$sqlres=mysql_query($sqlstat);
		
		while($arow=mysql_fetch_array($sqlres)){
				$bgcolor = "#96FF84";
			print "<tr style='background-color:".$bgcolor.";margin-bottom:10px;'><td>$arow[teamname]</td></tr>";
			
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
