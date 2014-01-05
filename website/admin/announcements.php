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
			<h1>Manage - Announcements</h1>
            
</div>
<span id="wel-btn" ><a href="#" style="font-size:16px" id="insctimer">Timer</a></span>
</div>
</div>
<!-- welcome message end-->
<!-- main content start-->
<div id="main">
   <div id="right-coloummn" >
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

<!-- form to insert the announcements -->
<form method="post" id="customForm" action="announcesubmit.php">
		<div>
			<label for="title">Title</label>
			<input id="announcetitle" name="title" type="text" />
		</div>
        <div id="announcebusy">
        </div>
		<div>
			<label for="post">Post</label>
			<textarea id="announcepost" name="post" cols="" rows=""></textarea>
		</div>
		<div>
			<input id="send" name="send" type="submit" value="Announce" />
		</div>
	</form>
    <div class="defloater">&nbsp;</div>
<form method="post" id="customForm" action="announcesubmit.php">
<div>
<select id="posttitle" name="posttitle">

<?php
	$sqlstat = "select title from comments where category='0';";
	$sqlres = mysql_query($sqlstat);
	while($arow=mysql_fetch_array($sqlres)){
		print "<option>$arow[title]</option>";
	}
?></select>	</div>
	<div>
			<input id="send" name="senddel" type="submit" value="Delete" />
		</div>



</form>
<div class="defloater">&nbsp;</div>
<!-- end of form to insert announcements -->
<div class="defloater">&nbsp;</div>
<h2 ><a href="#" style="font-size:24px">Recent Announcements</a></h2>
<!-- start displaying the current announcements -->
<?php
$sqlstat = "select * from comments where category='0' ORDER BY date DESC;";
$sqlres = mysql_query($sqlstat);
$numrows = mysql_num_rows($sqlres);
for($i=0;$i<$numrows;$i++){
	$arow = mysql_fetch_array($sqlres);
?>
<!-- list post start -->
		<div class="list-post">
			<div class="right">
				<h1><?php echo $arow[title] ?></h1>
				<div class="list-date-and-comm">
					<p><?php echo $arow[date] ?>&nbsp;&nbsp;<?php echo $arow[teamid] ?></p>
				</div>
				<div class="post-content">
					<p><?php echo $arow[post] ;?>
					</p>
				</div>
			</div>
			<div class="defloater">&nbsp;</div>
		</div>
		<!-- list post end -->
<?php }?>
<!-- end of displaying current postts -->


	<div class="defloater">&nbsp;</div>
	<!-- main content end -->
</div>

<script type="text/javascript">
function ajaxannounce(){
	xmlhttp = new XMLHttpRequest();
	var title = encodeURIComponent( document.getElementById('announcetitle').value);
	var post = encodeURIComponent( document.getElementById('announcepost').value);
	var params = "title="+title+"&post="+post;
	xmlhttp.open("POST","announcesubmit.php",false);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	document.getElementById('announcetitle').readOnly = true;
	document.getElementById('announcepost').readOnly = true;
	document.getElementById('announcebusy').innerHTML = '<img src="images/prettyPhoto/facebook/loader.gif" />' ;
	xmlhttp.send(params);
	document.getElementById('announcetitle').readOnly = false;
	document.getElementById('announcepost').readOnly = false;
	document.getElementById('announcebusy').innerHTML = xmlhttp.responseText ;
	document.getElementById('announcetitle').value="";
	document.getElementById('announcepost').value="";
	
	
}
</script>