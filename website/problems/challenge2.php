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
			<h2 class="page-title"><a href="#">FIBONACCI PRICE</a></h2>			
			<div class="post-content">
			
			<h3>Description</h3>
			<p></p>
			<p>There are many stalls in a Math Expo. The price of the goods in all the stalls is rather 
uniquely set. Each good has an integer value called Fibonacci Price associated with it. The actual 
price of the good is the difference between the Fibonacci Price and the nearest Fibonacci Number 
greater than or equal to the Fibonacci Price.
<br/>
Alice has limited cash and wants to buy as many goods as possible. Write a code to 
determine the maximum number of goods she can buy.
<br/>
Fibonacci Numbers are defined as follows:­<br/>
F (0)  = 0<br/>
F (1)  = 1<br/>
F (N) = F (N – 1) + F (N – 2)<br/>
for N > 1 <br/>
</p>
			
			<h3>Input Format</h3>
			<p>
			
			<h3>OutputFormat</h3>
			<p>For each test case, the output consists of one line that contains the number of items that can be 
			 
			 <h3>Example Text</h3>
			<p>Sample Input 
			<h3>Java programs need special naming of public class based on javaID given below. Check the Instructions page for more details</h3>	
			 <h3>C/CPP Time</h3>
			<p>1 seconds  </p>

			 <h3>Java Time</h3>
			<p>1 seconds  Java id is 'two.java'</p>

			
			
			</div>
		</div>
		<!-- featured post end -->
		<form action="answer2" id="customForm" method="post" >
		<div style="float:left">
			<input id="send" name="send" type="submit" value="Solution/Comments" />
		</div>
		</form>
	</div>
	<!--end of left-->
	<div class="defloater">&nbsp;</div>
	<!-- main content end -->
</div>