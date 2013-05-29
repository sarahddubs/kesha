<html>
<head>
	<title>Campus Convoz</title>
	<link rel="stylesheet" href="style.css" type="text/css" />

	<style>
		.ui-dialog-buttonset button{
			margin-top: 0px;
			display: inline;
			margin-right: 5px;
		}

		.ui-dialog-buttonset {
			width: 160px;
			right: 30px;
		}
		#timer {
			font-size: 17px;
			right: 20px;
			padding-left: 25px;
		}
		
		.ui-dialog-buttonpane {
			padding: 0 0 5px 140px;
		}
	</style>

</head>
<body>
	<?php include_once("analyticstracking.php") ?>
	<table id="intro_table">
		<tr>
			<td>
				<div id='intro_div'>
					<h1>Campus Convoz</h1>
					<p id='campusconvos_p'>
						Need someone to talk to?  We can help.
						Campus Convoz is here to connect you to someone
						on your campus so you can have a meaningful 
						conversation with someone without revealing your
						identity.
						<br /><br />
						Someone out there will listen.
						<b>Be heard.</b>
					</p>
					<button class="begin-convo chatroom_room_a" id="begin-convo"><a class='chatroom_room_a' id="chat-link">Begin Conversation</a></button>
				</div>
				<div id='bottom_section'>
					<p>
						<a class='bottom_a' href='about.html'>About Us </a>
						<b>|</b> 
						<a class='bottom_a' href='privacypolicy.html'>Privacy Policy</a>
						<b>|</b>
						<a class="bottom_a" href="feedback.html">Feedback</a>
					</p>
				</div>
			</td>
			<td>
				<img id='balloons_img' src="images/balloons.jpg" alt="balloons" />
			</td>
		</tr>
	</table>
	
<div id="dialog-confirm">
		<p>
			<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 7px 0;"></span>
			<span id = "box-text">
				<b>Welcome to CampusConvoz!</b><br><br> Please verify that you are a Stanford student by answering a quick Stanford-related question. You will have 10 seconds to answer, so no Googling! Don't worry, it'll be easy :)
			</span>
		</p>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="jquery.cookie.js"></script>

<script src="index.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>	

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-41092222-1', 'campusconvoz.com');
  ga('send', 'pageview');

</script>
</body>
</html>
