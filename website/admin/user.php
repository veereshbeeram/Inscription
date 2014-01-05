
<?php
session_start();
	if(!session_is_registered("INSUSER") || $_SESSION['ISADMIN']=='0'){
	// already logged in.....
	die("denied");	
}
?>
<!-- welcome message start-->




<div id="welcome">
		<div id="wel-text">
			<h1>User Management</h1>
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
			<div class="post-content">
            	Need to decide how to start,stop and manage the contests...
            </div>
		</div>
		<!-- featured post end -->
			</div>
	<!--end of left-->
	<!-- right coloumn start -->
	<div id="right-coloummn">
<!-- ............................................. START OF TWITTER CODE ............................................. -->
               <div>
				<h3 class="widget-title">Twitter Feed</h3>
                
				<script src="http://widgets.twimg.com/j/2/widget.js"></script>
				<script>
					new TWTR.Widget({
					version: 2,
					type: 'profile',
					  rpp: 4,
					  interval: 10000,
  width: 'auto',
  height: 300,
  theme: {
    shell: {
      background: '#333333',
      color: '#ffffff'
    },
    tweets: {
      background: '#000000',
      color: '#ffffff',
      links: '#cb87ff'
    }
  },
  features: {
    scrollbar: false,
    loop: true,
    live: true,
    hashtags: true,
    timestamp: true,
    avatars: false,
    behavior: 'default'
  }
}).render().setUser('inscriptionOPC').start();
</script>
</div>
<!-- ............................................. END OF TWITTER CODE .............................................. -->
</div>

<?php

if(isset($_POST['send'])){
	$sqlstat = "update contest set starttime='$_POST[starttime]',endtime='$_POST[endtime]' where contestID='1' ";
	$sqlres = mysql_query($sqlstat);
print "<p> Update done </p>";
}

?>

<form method="post" id="customForm" action="inscriptionmain.php?pagename=aduser">
		<div>
			<label for="starttime">Start Time as YYYY-MM-DD HH:MM:SS</label>
			<input id="starttime" name="starttime" type="text" />
		</div>
		<div>
			<label for="endtime">End Time as YYYY-MM-DD HH:MM:SS</label>
			<input id="endtime" name="endtime" type="text" />
		</div>
		<div>
			<input id="send" name="send" type="submit" value="Update Contest"  />
		</div>
	</form>



	</div>

	<div class="defloater">&nbsp;</div>
	<!-- main content end -->
</div>
