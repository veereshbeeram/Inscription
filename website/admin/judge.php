<?php
	if(!session_is_registered("INSUSER")|| $_SESSION['ISADMIN']=='0'){
	// already logged in.....
	die("denied");	
}
?>
<!-- welcome message start-->

<div id="welcome">
		<div id="wel-text">
			<h1>Judge Maintainence</h1>
        </div>
        <span id="wel-btn" ><a href="#" style="font-size:16px" id="insctimer">Timer</a></span>
       
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

	<?php
	if(isset($_POST['send'])){
		$file = fopen("./judgeconfig",w);
		if($_POST[judgestatus]==true){
		fwrite($file,"true");
		}
		else
			fwrite($file,"false");		
	fclose($file);
	}
	if(isset($_POST['sendid'])){
		$sqlstat = "update livequeue set islocked='0' where islocked='$_POST[judgeid]';";
		$sqlres = mysql_query($sqlstat);
		?>
        <div id="error" class="valid">
		<ul>
			<li>Entries locked by <?php echo $_POST[judgeid] ?> have been unlocked</li>
		</ul>
	</div>
    <?php
	}
	$file = fopen("./judgeconfig",r);
	$status = fread($file,filesize("./judgeconfig"));
	fclose($file);
	?>	
    <h2 ><a href="#" style="font-size:24px">Judge Running Status</a></h2>
    <form id="customForm"  action="inscriptionmain.php?pagename=adjudge" method="post">
    <div>
    <label for="judgestatus">Is judge Running?</label>
    <?php 
	if($status=="true"){
	?>
    <input type="checkbox" name="judgestatus" checked="checked" />
    <?php
	}
	else{
		?>
        <input type="checkbox" name="judgestatus" />
        <?php } ?>
        </div>
       <div> <input id="send" name="send" type="submit" value="Update" /></div>
    </form>
	<div class="defloater">&nbsp;</div>
    
    
    <h2 ><a href="#" style="font-size:24px">Judge Crash Recovery</a></h2>
    
    <form id="customForm"  action="inscriptionmain.php?pagename=adjudge" method="post">
    <div>
    <label for="judgeid">Enter Judge ID of crashed judge</label>
    <div>
        <input type="text" name="judgeid" id="judgeid" />
        </div>
       <div> <input id="send" name="sendid" type="submit" value="Unlock" /></div>
    </form>
    
    
	<div class="defloater">&nbsp;</div>
    
	<!-- main content end -->
</div>
