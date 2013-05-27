<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title>Campus Convoz</title>
	<link rel="stylesheet" href="http://jquery-star-rating-plugin.googlecode.com/svn/trunk/jquery.rating.css" type="text/css">
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="loader.css" type="text/css" />
</head>
<body>
	<?php include_once("analyticstracking.php") ?>
	<div id="page-wrap">
		<h2>Campus Convoz</h2>
        <p id="name-area"></p>
        
        <div id="chat-wrap"><div id="chat-area"></div></div>
        
        <form id="send-message-area">
            <p>Your message: </p>
            <textarea id="sendie" maxlength = '500' ></textarea>
        </form>
		<br><br><br><br><br>
		
		<button class="end-convo" id="end-convo">End Conversation</button>
		
		<button class="send-button" id="send-button">Send</button>
    
	</div>
	
	<div id="dialog-confirm">
		<p>
			<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
			<span id="dialog-confirm-message"></span>
			<br><br>
			<form id="survey">
				<input name="rating" type="radio" class="star {split:4}" value="1"/>
				<input name="rating" type="radio" class="star {split:4}" value="2"/>
				<input name="rating" type="radio" class="star {split:4}" value="3"/>
				<input name="rating" type="radio" class="star {split:4}" value="4"/>
				<input name="rating" type="radio" class="star {split:4}" value="5"/>
			</form>
		</p>
	</div>
	
	
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="chat.js"></script>
	<script src="jquery.cookie.js"></script>
	<script src="star-rating/jquery.rating.pack.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>	

	<body onload="updateInterval = setInterval('chat.update()', 200)">

	<script> // Google Analytics
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-41092222-1', 'campusconvoz.com');
	  ga('send', 'pageview');
	</script>

</body>

</html>
