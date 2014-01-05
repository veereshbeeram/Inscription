<!-- welcome message start-->
<?php if (isset($_REQUEST['_SESSION'])) die('Get lost Muppet!');
if($_SESSION['conteston']=="false") die("<div id='main'><br/><h1>Contest is not running</h1></div>");?>

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
			<h2 class="page-title"><a href="#">BOB THE BUILDER</a></h2>			
			<div class="post-content">
			
			<h3>Description</h3>
			<p></p>
			<p>Bob has building blocks of various heights. He intends to build two towers with it. Bob very 
particular about symmetry wants both the towers to be of exact same height. Given the number of 
blocks and the height of each block give the maximum height of the two towers that he can 
construct using them.
</p>
			
			<h3>Input Format</h3>
			<p>Input contain multiple test cases.  <br/>Each test case begins with  the number N < 55 indicating the number of blocks. This is followed by <br/>N integers indicating the height of each block.  Maximum height of each block is 500000 . <br/><br/><br/>Input terminates with a line containing `0' as the input for a test case. This line should not be <br/>processed.<br/><br/></p>
			
			<h3>OutputFormat</h3>
			<p>For each test case, print the maximum height of the twin towers. Print 0 if the twin towers can't be built</p>
			 
			 <h3>Example Text</h3>
			<p>Sample Input <br/>3 <br/>2 3 5 <br/>3 <br/>10 9 2 <br/>2 <br/>11 11 <br/>0<br/>Sample Output <br/>5<br/>0<br/>11<br/></p>
			<h3>Java programs need special naming of public class based on javaID given below. Check the Instructions page for more details</h3>	
			 <h3>C/CPP Time</h3>
			<p>20 seconds  </p>

			 <h3>Java Time</h3>
			<p>20 seconds  Java id is 'three.java'</p>

			
			
			</div>
		</div>
		<!-- featured post end -->
		<form action="answer3" id="customForm" method="post" >
		<div style="float:left">
			<input id="send" name="send" type="submit" value="Solution/Comments" />
		</div>
		</form>
	</div>
	<!--end of left-->
	<div class="defloater">&nbsp;</div>
	<!-- main content end -->
</div>
