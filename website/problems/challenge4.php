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
			<h2 class="page-title"><a href="#">FACE UP</a></h2>			
			<div class="post-content">
			
			<h3>Description</h3>
			<p>   IPSC format problem</p>
			<p>Given a sequence of cards with some cards face up and others face down at arbitrary 
positions, you are required to make all cards face up without altering positions of cards in the 
sequence. <br/>
You are allowed to choose a contiguous subset of cards and flip all the cards within it. That 
is if the face of a card is up then put it down and if it is down then put it up, without altering 
positions of cards in the set.  The effort of the above operation is the length of the subset on which 
the operation is performed. <br/>
The series of flip operations should be such that the effort of each flip operation is distinct 
and total effort of the series of operations is minimum. <br/>

</p>
			
			<h3>Input Format</h3>
			<p>Input contain multiple test cases.  Each test case has a single input line containing a string of 0's and <br/>1's. Where a zero represents a card with face up and a one represents a card with face down. The <br/>length of the string is fifteen or less. <br/><br/> Input terminates with a line containing `0' as the input for a test case. This line should not be <br/>processed.<br/></p>
			
			<h3>OutputFormat</h3>
			<p>For each test case, print the total minimum effort required. </p>
			 
			 <h3>Example Text</h3>
			<p>Sample Input <br/>101<br/>1000101 <br/>001100010 <br/>1010100000 <br/>Sample Output <br/>4<br/>9 <br/>3 <br/>7 <br/>Explanation<br/>In case 1.<br/>First flip operation can be to flip the second card. Resulting in 111.<br/>Second flip operation is to flip all the 3 cards resulting in 000.<br/>The total effort for the above operations is 1+3=4<br/>Since this is the minimum moves required and cannot be achieved in lesser number of moves <br/>the Output is 4<br/><br/></p>
			<h3>Java programs need special naming of public class based on javaID given below. Check the Instructions page for more details</h3>	
			 <h3>C/CPP Time</h3>
			<p>0 seconds     IPSC format problem</p>

			 <h3>Java Time</h3>
			<p>0 seconds  </p>

			
			 			<h3>IPSC input Test Case File</h3>
			<p>Download the Input test case file <a href="getipsc4">Here</a></p>
			</div>
		</div>
		<!-- featured post end -->
		<form action="answer4" id="customForm" method="post" >
		<div style="float:left">
			<input id="send" name="send" type="submit" value="Solution/Comments" />
		</div>
		</form>
	</div>
	<!--end of left-->
	<div class="defloater">&nbsp;</div>
	<!-- main content end -->
</div>
