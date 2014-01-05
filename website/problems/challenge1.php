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
			<h2 class="page-title"><a href="#">DECODE IT</a></h2>			
			<div class="post-content">
			
			<h3>Description</h3>
			<p></p>
			<p>Alice and Bob have devised an encryption method to hide their messages. They first agree secretly on a number that will be used as the number of columns in a matrix. The sender prepares an intermediate format by removing capitalizations and punctuations and spaces from the message. The sender then enters the letters of the intermediate format along the diagonals of the matrix and pads with extra random letters so as to make a rectangular array of letters. For example, if the message is  “i forgot what comes next ” and there are six columns, Alice  would write down 
<br/><br/>
iforgotwhatcomesnextxxxx 
<br/><br/>
and then generate
<br/>
<pre>i	f	r	t	t	e</pre>
<pre>o	g	w	c	s	x</pre>
<pre>o	h	o	n	t	x</pre>
<pre>a	m	e	x	x	x</pre>
<br/>
Note how Alice includes only the letters and writes them all in lower case. Alice then sends the message to Bob by writing the letters in each row. So, the message in its intermediate format would be encrypted as <br/>
<br/>ifrtteogwcsxohontxamexxx <br/><br/>
Your job is to recover for Bob the message in its intermediate format from the encrypted one. </p>
			
			<h3>Input Format</h3>
			<p>There will be multiple input sets. Input for each set will consist of two lines. The first line will contain an integer in the range 2...20 indicating the number of columns used. The next line is a string of up to 200 lower case letters. The last input set is followed by a line containing a single zero (0). This line should not be processed. <br/></p>
			
			<h3>OutputFormat</h3>
			<p>Each input set should generate one line of output, giving the message in its intermediate format.<br/></p>
			 
			 <h3>Example Text</h3>
			<p>Sample Input <br/>3 <br/>howwillyuorimrorrebploihsed <br/>6 <br/>ifrtteogwcsxohontxamexxx <br/>0 <br/>Sample Output <br/><br/>howwillyourmirrorbepolished <br/>iforgotwhatcomesnextxxxx </p>
			<h3>Java programs need special naming of public class based on javaID given below. Check the Instructions page for more details</h3>	
			 <h3>C/CPP Time</h3>
			<p>1 seconds  </p>

			 <h3>Java Time</h3>
			<p>1 seconds  Java id is 'one.java'</p>

			
			
			</div>
		</div>
		<!-- featured post end -->
		<form action="answer1" id="customForm" method="post" >
		<div style="float:left">
			<input id="send" name="send" type="submit" value="Solution/Comments" />
		</div>
		</form>
	</div>
	<!--end of left-->
	<div class="defloater">&nbsp;</div>
	<!-- main content end -->
</div>
