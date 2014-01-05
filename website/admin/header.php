<?php
if (isset($_REQUEST['_SESSION'])) die("Get lost Muppet!");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- the page title [edit in configuration.php] -->
<title><?php echo $site_name; ?></title>

<!-- favicon code -->
<link rel="shortcut icon" href="images/favicon.ico" />

<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />

<script src="js/jquery-1.4.2.js" type="text/javascript"></script>

<?php if($portfolio_page == "true"){ ?>
<!--pretty photo-->
<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="css/prettyPhoto.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/portfolio.css" />
<?php }; ?>

<?php if($slider_type == "nivo"){?>
<!--nivo slider -->
<script src="js/jquery.nivo.slider.pack.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'fade', //Specify sets like: 'fold,fade,sliceDown'
		slices:20,
		directionNav:true, //Next and Prev
		directionNavHide:false, //Only show on hover
		controlNav:true, //1,2,3...
		captionOpacity:0.8 //Universal caption opacity
	});
});
</script>
<?php }; ?>

<?php if($slider_page == "false"){ ?>
<link rel="stylesheet" href="css/blog.css" type="text/css" media="screen" />
<?php }; ?>

<?php if($contact_page == "true"){ ?>
<link rel="stylesheet" href="css/form.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/validation.js"></script>
<?php }; ?>

<!-- superfish -->
<link rel="stylesheet" type="text/css" media="screen" href="css/superfish.css" />
<script type="text/javascript" src="js/superfish.js"></script>
<script type="text/javascript" src="js/supersubs.js"></script>
<script type="text/javascript"> 
 
    $(document).ready(function(){ 
        $("ul.sf-menu").supersubs({ 
            minWidth:    15,   // minimum width of sub-menus in em units 
            maxWidth:    32,   // maximum width of sub-menus in em units 
            extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
                               // due to slight rounding differences and font-family 
        }).superfish();  // call supersubs first, then superfish, so that subs are 
                         // not display:none when measuring. Call before initialising 
                         // containing tabs for same reason. 
    }); 
 
</script>

<!-- cufon -->
<script src="js/cufon-yui.js" type="text/javascript"></script>
<script src="js/Sertig_400.font.js" type="text/javascript"></script>
<script type="text/javascript">
	Cufon.replace('#welcome h1');
	Cufon.replace('#nav');
	Cufon.replace('#logo');
	Cufon.replace('h2');
	Cufon.replace('.widget-title');
	Cufon.replace('#wel-btn');
	Cufon.replace('#copyright .site-name');
	Cufon.replace('.downloads');
	Cufon.replace('.buttons');
	Cufon.replace('#single-post h1');
	Cufon.replace('#single-post h2');
	Cufon.replace('#single-post h3');
	Cufon.replace('#single-post h4');
	Cufon.replace('#single-post h5');
	Cufon.replace('#single-post h6');
</script>

<!-- custom js -->
<script type="text/javascript">
  	$(function() {
			   $('.date-and-comm').hover(function() {$('.date-and-comm p').stop().animate({"margin-top":"-20px"},300);},
										function() {$('.date-and-comm p').stop().animate({"margin-top":"0px"},100);
									 });
			   });
	
</script>
<script type="text/javascript">

function commentmod(data,todo){

	xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET","commentsubmit.php?id="+data+"&todo="+todo,false);
	//	alert(data);
	xmlhttp.send();
document.getElementById(data).innerHTML = xmlhttp.responseText;
}

</script>

<!-- TIMER JAVASCRIPT!! -->
<script language="JavaScript" type="text/javascript">
<?php
	include("../timer.php");
?>
var sec = <?php echo $sec; ?>;   
var min = <?php echo $min; ?>;   
var hrs = <?php echo $hrs; ?>;
var pstring = <?php echo "'".$string."'"; ?>;
function countDown() {
   sec--;
  if (sec == -01) {
   sec = 59;
   min = min - 1; }
  else {
   min = min; }
   if(min == -1){
	   min = 59;
	   hrs = hrs - 1;
   }
   else{
	   hrs = hrs;
   }
var tempmin =min;
if (sec<=9) { sec = "0" + sec; }
if (min<=9) {tempmin = "0" + min;}


  time = hrs+"H:"+tempmin+"M:"+sec + "S "+pstring;

if (document.getElementById) { document.getElementById('insctimer').innerHTML = time; }

SD=window.setTimeout("countDown();", 1000);
if (hrs == '0' && min == '00' && sec == '00') { sec = "00"; window.clearTimeout(SD); }
}
window.onload = countDown;
</script>
<style type="text/css">

</style>

<!-- TIMER JAVASCRIPT!! -->
<!-- ie PNG fix -->
<!--[if lt IE 7]>
        <script type="text/javascript" src="unitpngfix.js"></script>
<![endif]--> 
</head>
<body>
<div id="top-bar" style="text-align:right">Welcome <?php echo $_SESSION['INSUSER']; ?>&nbsp;</div>
<!-- header div start-->
<div id="header">
	<div id="logo"><a href="inscriptionmain.php"><?php echo $site_name; ?></a></div>
    <?php if($loginstat == 'correct'): ?>
	<div id="nav">
		<!-- drop down menu start -->
		<ul class="sf-menu">
			<!--level 1-->
			<li><a href="inscriptionmain.php?pagename=aduser">Contest</a></li>
			<li><a href="inscriptionmain.php?pagename=adannounce">Announcements</a></li>
			<li><a href="inscriptionmain.php?pagename=adjudge">Judge</a></li>
            <li><a href="inscriptionmain.php?pagename=adprob">Problems</a></li>
            <li><a href="inscriptionmain.php?pagename=adcomment">Comments</a></li>
            <li><a href="inscriptionmain.php?pagename=adqueue">Live Queue</a></li>
			<li><a href="inscriptionmain.php?pagename=adlogout">Logout</a></li>
		</ul>
		<!-- drop down menu end -->
	</div>
    <?php endif ?>
</div>
<!-- header div end -->
