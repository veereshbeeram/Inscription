<?php
session_start();
$loginstat = 'none';

require('../dbinit.php');
if(session_is_registered("INSUSER")&&$_SESSION['ISADMIN']=='1'){
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
			$sqlstat = "select * from teams where teamName='".$_POST['name']."' and password='".$_POST['password']."';";
			$sqlres = mysql_query($sqlstat);
			$num = mysql_num_rows($sqlres);
			$arow = mysql_fetch_array($sqlres);
			if($num == 0 || $arow[isadmin]==0){
				$loginstat = 'failed';
			}
			else{
			// this is the code which does maintainece after authenticating the user credentials
			session_register("INSUSER");
			session_register("ISADMIN");
			$_SESSION['INSUSER'] = $_POST['name'];
			$_SESSION['ISADMIN']='1';
			$loginstat = 'correct';
			}
		}
	}
}
// now we know what page is being asked for and what is the login status			   

?>


<?php
//switch cases for doing stuff on each page....
if($loginstat!='correct'){
	// if not loggedin properly.. redirect to indexpage.php
	$pagename = "index";
}
switch($pagename){
	case "adlogout" :
		session_unregister("INSUSER");
		session_unset();
		session_destroy();
		$loginstat = 'none';
		require('../configuration.php');
		$contact_page = "true";
		require('./header.php'); 
		include('./indexpage.php');
		break;
	case "aduser":
		require('../configuration.php');
		$contact_page = "true";
		require('./header.php');
		include("./user.php");
		break;
	case "adannounce":
		require('../configuration.php');
		$contact_page = "true";
		require('./header.php');
		include("./announcements.php");
		break;
	case "adjudge":
		require('../configuration.php');
		$contact_page = "true";
		require('./header.php'); 
		include("./judge.php");
		break;
	case "adprob":
		require('../configuration.php');
		$contact_page = "true";
		require('./header.php'); 
		include("./problem.php");
		break;
	case "adcomment":
		require('../configuration.php');
		$contact_page = "true";
		require('./header.php');
		if(isset($_GET[isall])){
		$isall = "true";
		}
		else
			$isall = "false";
		include("./commentmod.php");
		break;
	case "adqueue":
		require('../configuration.php');
		$contact_page = "true";
		require('./header.php'); 
		include("./livequeue.php");
		break;
	default:
	case "index" :
		require('../configuration.php');
		$contact_page = "true";
		require('./header.php'); 
		include('./indexpage.php');
		break;
	
}

?>

<!-- footer div start -->
<?php require('../footer.php'); ?>
<?php
mysql_close($sqlcon);
?>
