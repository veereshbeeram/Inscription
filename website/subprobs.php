<?php
if (isset($_REQUEST['_SESSION'])) die("Get lost Muppet!");

if($_SESSION['conteston']=="false") die("<div id='main'><br/><h1>Contest is not running</h1></div>");
?>

<?php 
require('./configuration.php');
require_once('./validation.php');
require_once('./dbinit.php');
require_once('problems/judgeconfigurations.php');
if($_GET[probnum] > $num_probs  || $_GET[probnum] =="0" ){
	die("");
}
$contact_page = "true";
$probid =$_GET[probnum];
$team = $_SESSION['INSUSER'];
?>


<?php

//echo $_SESSION['INSUSER'];

$pvar = $_POST;
date_default_timezone_set('Asia/Calcutta');
$date = date("Y-m-d H:i:s");
$goahead="true";

if(isset($_POST["recaptcha_challenge_field"])){
	//echo "captcha was enabled";
	$privatekey = "yez-get-your-own-private-key";
  			$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);
	if($resp->is_valid){
		$goahead = "true";
	}
	else{
		$goahead = "false";
		$substat = "false";
	}
}

if(isset($_POST['sendsolution'])&&$goahead == "true"){
	
	if ($_FILES["soln"]["error"] <= 0){
		//soln file is submitted so upload
		if($_FILES['soln']['size']>0 && $_FILES['soln']['size']<10000000){
			//soln file is not empty and less than 10MB
			$tmpname= $_FILES["soln"]["tmp_name"];
			$file = fopen($tmpname, "r");
			$content = fread($file, filesize($tmpname));
			fclose($file);

			$content = mysql_real_escape_string($content);
			//echo $content;
			//submission table entry
			switch($pvar[lang]){
				case "C":
					$lang=1;
					break;
				case "CPP":
					$lang=2;
					break;
				case "JAVA":
					$lang=3;
					break;
				case "TEXT":
					$lang=4;
					break;
				
			}
			$sqlstat = "select Max(submissionid) as sid from submission;";
			$sqlres = mysql_query($sqlstat);
			$arow = mysql_fetch_assoc($sqlres);
			$sid = (int)$arow["sid"]+1;
			//echo $arow["sid"];
			$sqlstat = "insert into submission values('$sid','$team','$probid','$lang','7','$date','0.00')";
			$sqlres = mysql_query($sqlstat);
			$sqlstat = "insert into livequeue values('$sid','$probid','$lang','$content','0');";
			$sqlres = mysql_query($sqlstat);
			$substat = "true";
		}
		else
			$substat = "submission failed improper file size/ no file selected";
		
	}
	else if(isset($_POST['sendsolution']))
		$substat = "submission failed";
	
	
}
else if(isset($_POST['sendcomment'])&&$goahead=="true" && strlen($_POST['commenttitle'])>9 && strlen($_POST['commentpost'])>0){
	$sqlstat = "INSERT INTO `inscriptiontest`.`comments` (`commentID` ,`category` ,`teamname` ,`title` ,`post` ,`date` ,`isapproved`) VALUES ( NULL , '$probid', '$team', '$pvar[commenttitle]', '$pvar[commentpost]', '$date', '0' );";
	$sqlres=mysql_query($sqlstat);
	//echo $sqlstat;
	$substat = "true";
}
else if(isset($_POST['sendcomment'])&& (strlen($_POST['commenttitle'])<10 || strlen($_POST['commentpost'])==0)){
	$substat = "Failed : Title should be 10 chars and post cant be blank";
}

?>
<!-- welcome message start-->

<div id="welcome">
		<div id="wel-text">
			<h1>Submit Your solutions/comments</h1>
        </div>
        <span id="wel-btn" ><a href="#" style="font-size:16px" id="insctimer">Timer</a></span>
       
</div>
<!-- welcome message start-->
<!-- main content start-->
<div id="main">
	<!--START FORM-->
    <?php if($substat == "true"){ ?>
    <div id="error" class="valid">
		<ul>
			<li>Successfully submitted.</li>
		</ul>
	</div>
    <?php } else if($substat!="false"){ ?>
    <div id="error">
		<ul>
        <li> <?php echo $substat ?> </li>
        </ul>
	</div>
    <?php } ?>
    <form method="post" id="customForm" action="answer<?php echo $probid; ?>" enctype="multipart/form-data">
		<div>
			<label for="soln">SolutionFile</label>
			<input id="soln" name="soln" type="file" />
		</div>
        <div>
        <label for="lang">Language</label>

        	<select id="lang" name="lang">
<?php
$sqlstat = "select isipsc from problems where problemID='$probid'";
$sqlres = mysql_query($sqlstat);
$arow=mysql_fetch_array($sqlres);
if($arow[isipsc]=='0'){
?>
            <option>C</option>
            <option>CPP</option>
            <option>JAVA</option>
<?php
}else{
?>
            <option>TEXT</option>
<?php } ?>
            </select>
        </div>
        <?php
		$curtime = time();
		$iscaptcha = "false";
		if($curtime%2 ==0){
			$iscaptcha = "true";
		}
		//echo $curtime%2;
			if($iscaptcha=="true"){
				?>
           <div>
           <?php
		   $publickey = "6LfWvr0SAAAAADOn6MRBF3gYUX2nXJZCA2yvJxkR"; // you got this from the signup page
    	      echo recaptcha_get_html($publickey);
			  ?>
           </div>
		<?php } ?>
        <div>
			<input id="send" name="sendsolution" type="submit" value="Submit Solution" />
		</div>
	</form>
    <div class="defloater">&nbsp;</div>
    <form method="post" id="customForm" action="answer<?php echo $probid; ?>">
		<div>
			<label for="commenttitle">Comment Title</label>
			<input id="commenttitle" name="commenttitle" type="text" maxlength="100" />
            <span id="nameInfo">Don't leave blank,min 10 chars</span>
		</div>
        <div>
			<label for="commentpost">Comment Post</label>
			<textarea id="commentpost" name="commentpost" ></textarea>
            <span id="nameInfo">Don't leave blank</span>
		</div>
        <?php
		$curtime = time();
		$iscaptcha = "false";
		if($curtime%3 ==0){
			$iscaptcha = "true";
		}
		//echo $curtime%2;
			if($iscaptcha=="true"){
				?>
           <div>
           <?php
		   $publickey = "6LfWvr0SAAAAADOn6MRBF3gYUX2nXJZCA2yvJxkR"; // you got this from the signup page
    	      echo recaptcha_get_html($publickey);
			  ?>
           </div>
		<?php } ?>
 
		<div>
			<input id="send" name="sendcomment" type="submit" value="Comment" />
		</div>
	</form>
    <div class="defloater">&nbsp;</div>
	<!--END FORM-->
     <div class="defloater">&nbsp;</div>
    
	<!-- main content end -->
</div>
