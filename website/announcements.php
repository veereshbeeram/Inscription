<?php
if (isset($_REQUEST['_SESSION'])) die("Get lost Muppet!");
?>
<!-- welcome message start-->

<div id="welcome">
		<div id="wel-text">
			<h1>Welcome to Inscription - Announcements</h1>
        </div>
        <span id="wel-btn" ><a href="#" style="font-size:16px" id="insctimer">Timer</a></span>
       
</div>
<!-- welcome message end-->
<!-- main content start-->
<div id="main">
	<!-- left coloumn posts start -->
	<div id="left-coloumn">
    <?php
	$sqlstat = "select * from comments where category='0';";
	$sqlres=mysql_query($sqlstat);
	while($arow=mysql_fetch_array($sqlres)){
	?>
		<div class="list-post">
			<div class="right">
				<h2><?php echo $arow[title] ?></h2>
				<div class="list-date-and-comm">
					<p>Administrator <?php echo $arow[date] ?></p>
				</div>
				<div class="post-content">
					<p><?php echo $arow[post] ?></p>
				</div>
			</div>
			<div class="defloater">&nbsp;</div>
		</div>
        <?php } ?>
	</div>
	<!--end of left-->
	<div class="defloater">&nbsp;</div>
	<!-- main content end -->
</div>
