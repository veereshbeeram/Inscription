<?php
session_start();
if (isset($_REQUEST['_SESSION'])) die("Get lost Muppet!");
$loginstat = 'none';
require('./dbinit.php');
require("problems/judgeconfigurations.php");
require("./recaptchalib.php");
if(session_is_registered("INSUSER")){
	// already logged in.....
	$loginstat = 'correct';
}
//echo $loginstat;

// here loginstat will tell if logged in or not

//next determine the page for which request is being made
if(isset($_GET['pagename'])){
			   // /some page other than index page is being demanded	
	$pagename = $_GET['pagename'];
}
else{
	// index page access is asked for
	$pagename = "index";
	//echo $pagename;
	if($loginstat == 'none'){
		if(isset($_POST['send'])){
			$user = mysql_real_escape_string($_POST['name']);
			$pass = md5(mysql_real_escape_string($_POST['password']));
			$url = 'http://inscription.engineer.org.in/passchecker.php?xkcd='.$user.'&waste='.$pass;
$options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "spider", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
    );

    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
	$num=$content;
	//echo $num;
// now check captcha

			
 			$privatekey = "6LfWvr0SAAAAAPyQpOCRR_7xNZGK-EZ5CDt-yezh";
  			$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

			if($num != '1' || !$resp->is_valid){
	//		if($num==0){
				$loginstat = 'failed';
			}
			else{
			// this is the code which does maintainece after authenticating the user credentials
			session_register("INSUSER");
			session_register("ISADMIN");
			$teamname = $_POST['name'];
			$_SESSION['INSUSER'] = $_POST['name'];
			$_SESSION['ISADMIN'] = '0';
			$sqlstat = "insert into userlogin values('$teamname','0')";
			$sqlres = mysql_query($sqlstat);
			$sessid = session_id();
	//		print "sess".$sessid;
			$sqlstat = "insert into userlogin values('$teamname','$sessid')";
			$sqlres = mysql_query($sqlstat);
			//echo $ISADMIN;
			$loginstat = 'correct';
			}
		}
	}
}
// now we know what page is being asked for and what is the login status			   

?>


<?php
//switch cases for doing stuff on each page....
if($loginstat!="correct" && $_GET['pagename']!="faq"){
	$pagename = "index";
}
switch($pagename){
	case "logout" :
		$loginstat = 'none';
		require('./configuration.php');
		$contact_page = "true";
		require('./header.php'); 
		include('./indexpage.php');
		$sessid = session_id();
		$sqlstat = "delete from userlogin where isactive='$sessid'";
		$sqlres = mysql_query($sqlstat);

		session_unregister("INSUSER");
		session_unset();
		session_destroy();
		break;
	case "announce":
		require('./configuration.php');
		$contact_page = "true";
		require('./header.php');
		include("./announcements.php");
		break;
	case "mysub":
		require('./configuration.php');
		$contact_page = "true";
		require('./header.php'); 
		include("./mysubmissions.php");
		break;
	case "results":
		require('./configuration.php');
		$contact_page = "true";
		require('./header.php'); 
		include("./results.php");
		break;
	case "prob":
		require('./configuration.php');
		$contact_page = "true";
		require('./header.php'); 
		include("./problems/challenge".$_GET['probnum'].".php");
		$probid = $_GET['probnum'];
		include("./comments.php");
		break;
	case "subprob":
		require('./configuration.php');
		$contact_page = "true";
		require('./header.php');
		$_SESSION['CURPROB']=$_GET[probnum];
		include("./subprobs.php");
		break;
	case "faq":
		require('./configuration.php');
		$contact_page = "true";
		require('./header.php'); 
		include("./faq.php");
		break;
		
	default:
	case "index" :
		require('./configuration.php');
		$contact_page = "true";
		require('./header.php'); 
		include('./indexpage.php');
		break;

}

?>

<!-- footer div start -->
<?php require('./footer.php'); ?>
<?php
mysql_close($sqlcon);
?>
