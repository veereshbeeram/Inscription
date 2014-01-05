<?php
session_start();
	if(!session_is_registered("INSUSER") || $_SESSION['ISADMIN']=='0'){
	// already logged in.....
	die("denied");	
}
?>

<?php
	if(!session_is_registered("INSUSER") && $_SESSION[ISADMIN]==0){
	// already logged in.....
	die("denied");	
}
?>


<div id="welcome">
		<div id="wel-text">
			<h1>Problem Statement Upload</h1>
        </div>
        <span id="wel-btn" ><a href="#" style="font-size:16px" id="insctimer">Timer</a></span>
       
</div>
<!-- welcome message end-->
<!-- main content start-->
<div id="main">

<?php
if(isset($_POST['send'])){
	$pvar = $_POST;
	$sqlstat = "select * from problems where problemID=$pvar[pid]";
	$sqlres=mysql_query($sqlstat);
	$numrows = mysql_num_rows($sqlres);
	if($numrows>0){
		$sqlstat = "delete from problems where problemID=$pvar[pid]";
		$sqlres=mysql_query($sqlstat);
	}
	if($pvar[isipsc]==true){
		$isipsc=1;
	}
	else
		$isipsc=0;
	$sqlstat = "insert into problems values('$pvar[pid]','$pvar[ptitle]','$pvar[pdesc]','$pvar[pinform]','$pvar[poutform]','$pvar[pexample]','','','$pvar[ctime]','$pvar[cpptime]','$pvar[javatime]','$pvar[points]','$isipsc')";
	$sqlres= mysql_query($sqlstat);
	
	//upload infile
	if ($_FILES["inputfile"]["error"] <= 0){
		//input file is submitted so upload
		if($_FILES['inputfile']['size']>0){
			//non empty file
			$tmpname= $_FILES["inputfile"]["tmp_name"];
			$file = fopen($tmpname, "r");
			$content = fread($file, filesize($tmpname));
			fclose($file);

			$content = mysql_real_escape_string($content);
			//echo $content;
			$sqlstat = "update problems set inputFile='$content' where problemID='$pvar[pid]'";
			$sqlres = mysql_query($sqlstat);
		}
	}
	//upload poutfile
	if ($_FILES["outputfile"]["error"] <= 0){
		//input file is submitted so upload
		if($_FILES['outputfile']['size']>0){
			//non empty file
			$tmpname= $_FILES["outputfile"]["tmp_name"];
			$file = fopen($tmpname, "r");
			$content = fread($file, filesize($tmpname));
			fclose($file);

			$content = mysql_real_escape_string($content);
			//echo $content;
			$sqlstat = "update problems set outputFile='$content' where problemID='$pvar[pid]'";
			$sqlres = mysql_query($sqlstat);
		}
	}
	$sqlstat = "select * from problems where problemID=$pvar[pid]";
	$sqlres=mysql_query($sqlstat);
	$numrows = mysql_num_rows($sqlres);
	if($numrows>0)
		print "<div id='error' class='valid'>successful</div>";
	else
		print "<div id='error'>Unsuccessful</div>";
}
?>

<!-- right coloumn start -->
	<div id="right-coloummn" >
   	<div id="loginbox">
    <ul class="widget-area">
			<li>
				<h3 class="widget-title">Existing Problem ID</h3>
                <?php
					$sqlstat = "select problemID from problems";
					$sqlres=mysql_query($sqlstat);
					while($arow=mysql_fetch_array($sqlres)){
							print "<div style='text-align:center'>$arow[problemID]</div>";
					}

				?>
			</li>
            
		</ul>
        <a href="genprobs.php" target="_blank"> Generate Problems</a>
    </div>
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
	<!-- right couloumn end -->

	<form action="inscriptionmain.php?pagename=adprob" id="customForm" method="post" enctype="multipart/form-data">
    <div>
			<label for="pid">problemID</label>
			<input id="pid" name="pid" type="text" />
            <span id="nameInfo">If the problemID already exists the old problem will be deleted!! BE CAREFUL</span>
	</div>
	<div>
    		<label for="titile">problem Title</label>
    		<textarea id="title" name="ptitle"></textarea>
    </div>
    <div>
    		<label for="desc">problem Description</label>
    		<textarea id="desc" name="pdesc"></textarea>
    </div>
    <div>
    		<label for="inform">Input format</label>
    		<textarea id="inform" name="pinform"></textarea>
    </div>
    <div>
    		<label for="outform">Output Format</label>
    		<textarea id="outform" name="poutform"></textarea>
    </div>
    <div>
    		<label for="example">Example Text</label>
    		<textarea id="example" name="pexample"></textarea>
    </div>
    <div>
    		<label for="inputfile">Input Test Case File</label>
    		<input type="file" name="inputfile">
     </div>
     <div>
     		<label for="outputfile">Output File</label>
    		<input type="file" name="outputfile">
     </div>
    <div>
    	<label for="ctime">Time For c</label>
    	<input type="text" name="ctime">
    </div>
    <div>
    	<label for="cpptime">Time For cpp</label>
    	<input type="text" name="cpptime">
    </div>
    
    <div>
    	<label for="javatime">Time For java</label>
    	<input type="text" name="javatime">
    </div>
    <div>
    	<label for="points">Points</label>
    	<input type="text" name="points">
    </div>
    <div>
    	<label for="isipsc">Is Ipsc Format?</label>
    	<input type="checkbox" name="isipsc" />
    </div>
    
    <div>
			<input id="send" name="send" type="submit" value="Submit Form" />
	</div>
    </form>
	<div class="defloater">&nbsp;</div>
</div>
