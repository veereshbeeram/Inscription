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
			<p><br/>Input to this problem consists of multiple test cases. The data for test case is as follows: <br/><br/>        The first line consists of three integers:<br/><ul><br/><li> the number of items W, 0 < W < =1000 </li><br/><li> the cash available with Alice, C, 0 < C < =10000</li><br/><li> the maximum Fibonacci Price , S, 0 < S < =100000000.</li><br/> The integers are separated by a single space. <br/></ul><br/>       • The following line contains W integers separated by a single space that describes the <br/>Fibonacci Price of items.<br/><br/>The input will be terminated by a line that consists of three zeros (0 0 0), separated by a single <br/>space. This line should not be processed. <br/></p>
			
			<h3>OutputFormat</h3>
			<p>For each test case, the output consists of one line that contains the number of items that can be <br/>bought<br/></p>
			 
			 <h3>Example Text</h3>
			<p>Sample Input <br/>4 10 30 <br/>7 15 30 5 <br/>11 100 5812167 <br/>20 40 30 15 17  5812167  23  43  33  13  37 <br/>0 0 0 <br/>Sample Output <br/>3 <br/>10 <br/></p>
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
