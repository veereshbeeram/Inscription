<?php
if (isset($_REQUEST['_SESSION'])) die("Get lost Muppet!");
?>
<!-- welcome message start-->

<div id="welcome">
		<div id="wel-text">
			<h1>Welcome to Inscription - results</h1>
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
        <table border="1" width="100%" style="text-align:center">
        <tr><th>Team Name</th><th>Problems Solved</th><th>Score</th></tr>
			<?php
				$sqlstat = "select problemID,points from problems;";
				$sqlres = mysql_query($sqlstat);
				while($arow=mysql_fetch_array($sqlres)){
					$probarr[$arow[problemID]] = $arow[points];
				}
				$sqlstat = "select distinct(problemID),teamname from submission where status='0'";
				$sqlres = mysql_query($sqlstat);
				while($arow=mysql_fetch_array($sqlres)){
					$teamscores[$arow[teamname]] = (int) $teamscores[$arow[teamname]] + (int) $probarr[$arow[problemID]];
					$teamprobs[$arow[teamname]] = $teamprobs[$arow[teamname]].",".$arow[problemID];
					
				}
				
/*				foreach($probarr as $key=>$value){
					echo $key ."::". $value."<br/>";
				}
				foreach($teamscores as $key=>$value){
					echo $key ."::". $value."<br/>";
				}
				foreach($teamprobs as $key=>$value){
					echo $key ."::". $value."<br/>";
				}
*/
				asort($teamscores,"SORT_NUMERIC");
				foreach($teamscores as $key=>$value){
					$probssolved = ltrim($teamprobs[$key],",");
					print "<tr><td>$key</td><td>$probssolved</td><td>$value</td></tr>";
				}
				
			?>
            </table>
		</div>
		<!-- featured post end -->
	</div>
	<!--end of left-->
	<div class="defloater">&nbsp;</div>
	<!-- main content end -->
</div>
