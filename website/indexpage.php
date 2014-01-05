<?php
if (isset($_REQUEST['_SESSION'])) die("Get lost Muppet!");
?><!-- welcome message start-->

<div id="welcome">
		<div id="wel-text">
			<h1>Welcome to Inscription - online programming contest of Engineer 2010</h1>
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
			
		</div>
		<!-- featured post end -->
	</div>
	<!--end of left-->
	<!-- right coloumn start -->
	<div id="right-coloummn">
    <?php if($loginstat == 'none' || $loginstat == 'failed'):?>
    <div id="loginbox">
		<ul class="widget-area">
			<li>
				<h3 class="widget-title">Login</h3>
			<form method="post" id="customForm" action="contest">
            <?php if($loginstat == 'failed'):?>
            <div id="error" ><ul><li style="color:#e46c6d"> Invalid Login Details</li></ul></div>
            <?php endif ?>
                <div>
			<label for="name">TeamID</label>
			<input id="name" name="name" type="text" />
			</div>
		<div>
			<label for="email">Password</label>
			<input id="password" name="password" type="password" />
		</div>
		<div>
        	 <?php
	          $publickey = "6LeEzbwSAAAAAOTdqZdhSEgvooeoMqGvSfA9KlSK"; // you got this from the signup page
    	      echo recaptcha_get_html($publickey);
			 
      	  ?>

        </div>
        <div>
			<input id="loginsend" name="send" type="submit" value="Login" />
		</div>
                </form>
			</li>
            <li><ul>Unable to login? Check <a href="faqs">FAQ</a></ul></li>
		</ul>
        </div>
         <?php endif ?>
         
        <ul class="widget-area">
			<li>
				<h3 class="widget-title">Browse Contest</h3>
               
                <ul>
                	<li onclick="loadcontentmain('inscintro.php');"> <a href="#intro">Introduction</a> </li>
					<li onclick="loadcontentmain('inscinfo.php');"> <a href="#instruction">Important Instructions</a> </li>
					<li onclick="loadcontentmain('inscrule.php');"> <a href="#rules">Rules and Regulations</a> </li>
					<li onclick="loadcontentmain('insccont.php');"> <a href="#contact">Contact</a> </li>
                </ul>
                </li>
                </ul>
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
	<div class="defloater">&nbsp;</div>
	<!-- main content end -->
</div>
<script type="text/javascript">
loadcontentmain('inscintro.php');
</script>
