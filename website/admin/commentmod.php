<!-- welcome message start-->

<div id="welcome">
		<div id="wel-text">
			<h1>Comment Moderation</h1>
        </div>
        <span id="wel-btn" ><a href="#" style="font-size:16px" id="insctimer">Timer</a></span>
       
</div>

<div id="wel-btn" style="width:0px">
</div>
</div>
<!-- welcome message end-->
<!-- main content start-->
<?php
session_start();
	if(!session_is_registered("INSUSER") || $_SESSION['ISADMIN']=='0'){
	// already logged in.....
	die("denied");	
}
?>


<div id="main">

<!-- form to insert the announcements -->
   <h2 ><a href="inscriptionmain.php?pagename=adcomment" style="font-size:24px">Recent Comments</a></h2>
   <h2 ><a href="inscriptionmain.php?pagename=adcomment&isall=true" style="font-size:24px">Click for all Comments</a></h2>
  
    <?php
	if($isall=="true"){
	$sqlstat  = "select * from comments where category!='0'";
	}
	else{
	$sqlstat  = "select * from comments where isapproved='0' and category!='0'";
	}
			$sqlres = mysql_query($sqlstat);
			while($arow=mysql_fetch_array($sqlres)){
				$sqlstat2 = "select problemTitle from problems where problemID='$arow[category]';";
				$sqlres2 = mysql_query($sqlstat2);
				$arow2=mysql_fetch_array($sqlres2)
	?>
    <div class="list-post" id="<?php echo $arow[commentID]; ?>">
	
			<div class="right">
				<h1><?php echo $arow[title] ?></h1>
				<div class="list-date-and-comm">
					<p><?php echo $arow[teamname].",".$arow[date]; ?></p>
				</div>
                <div class="list-date-and-comm">
					<p>Problem : <?php echo $arow2[problemTitle]?></p>
				</div>
				
				<div class="post-content">
					<p><?php echo $arow[post]; ?></p>
				</div>
                <div class="meta"><span>Action&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onClick="commentmod('<?php echo $arow[commentID]; ?>','1');">Approve</a>, <a href="#" onClick="commentmod('<?php echo $arow[commentID]; ?>','0');">Delete</a></span></div>
			</div>
			<div class="defloater">&nbsp;</div>
    	</div>
    <?php } ?>
 
    <div class="defloater">&nbsp;</div>
    
</div>
