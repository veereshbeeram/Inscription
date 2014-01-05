<div class="defloater">&nbsp;</div>  
<h2 ><a href="#" style="font-size:24px">Recent Comments</a></h2>
  
    <?php
	//$probid=$_GET['prob'];
	$sqlstat  = "select * from comments where category = '$probid' and isapproved='1'";
			$sqlres = mysql_query($sqlstat);
			while($arow=mysql_fetch_array($sqlres)){
	?>
    <div class="list-post">
	
			<div class="right">
				<h1><?php echo $arow[title] ?></h1>
				<div class="list-date-and-comm">
					<p><?php echo $arow[teamname].",".$arow[date]; ?></p>
				</div>
				<div class="post-content">
					<p><?php echo $arow[post]; ?></p>
				</div>
			</div>
			<div class="defloater">&nbsp;</div>
    	</div>
    <?php } ?>
 
	<!--end of left-->
	<div class="defloater">&nbsp;</div>
	<!-- main content end -->
</div>
