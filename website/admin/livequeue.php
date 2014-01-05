<?php
session_start();
	if(!session_is_registered("INSUSER") || $_SESSION['ISADMIN']=='0'){
	// already logged in.....
	die("denied");	
}
?>


<div id="welcome">
		<div id="wel-text">
			<h1>Welcome to Inscription - Live Queue</h1>
        </div>
        <span id="wel-btn" ><a href="#" style="font-size:16px" id="insctimer">Timer</a></span>
       
</div>
<!-- welcome message end-->
<!-- main content start-->
<div id="main">
	<!-- left coloumn posts start -->
	<div id="left-coloumn">
		<div id="single-post">
        <h2 class="page-title">Current Queue</h2>
        <div class="post-content">
        <table border="1" width="100%" style="text-align:center">
		<tr style="padding-bottom:10px"><th>submissionID</th><th>problemID</th><th>language</th><th>status</th></tr>
		<?php 
		$user = $_SESSION['INSUSER'];
		$lang_codes = array('','C','CPP','JAVA','TEXT');
		$sqlstat = "select submissionID,problemID,language,islocked from livequeue";
		$sqlres=mysql_query($sqlstat);
		
		while($arow=mysql_fetch_array($sqlres)){
			$lang = $lang_codes[$arow[language]];
			print "<tr style='margin-bottom:10px'><td>$arow[submissionID]</td><td>$arow[problemID]</td><td>$lang</td><td>$arow[islocked]</td></tr>";
			
		}
		?>
		</table>
        </div>
        </div>
	</div>
	<!--end of left-->
	<!-- main content end -->
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
<div class="defloater">&nbsp;</div>
</div>
