<html>
<head>
	<title>Campus Convoz</title>
	<link rel="stylesheet" href="style.css" type="text/css" />

	<style>
		.ui-dialog-buttonset button{
			margin-top: 0px;
			display: inline;
			
		}

		.ui-dialog-buttonset {
			width: 140px;
			right: 30px;
		}
		#timer {
			font-size: 17px;
			right: 20px;
			padding-left: 25px;
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

<script>
	var userID = $.cookie('user_id');
	
	if (userID) { // user already has ID
		var current_chatroom = $.cookie('current_chatroom');
		if (current_chatroom) {
			$.ajax({
				type: "POST",
				url: "rate.php",
				data: {  
					'chat_filename': 'conversations/' + current_chatroom + '.txt',
					'rating': $.cookie('user_id') + ':  -1'
				},
				success: function(data){
					$.ajax({
					   type: "POST",
					   url: "clearroom.php",
					   data: {  
							   'current_chatroom': $.cookie('current_chatroom')
					   },
					   success: function(data){	   
						   $.removeCookie('current_chatroom');
						   window.location = 'index.php';
					   }
				   });
				}
			});	
			
		}
	} else { // user at site for first time.

		userID = "<?php echo uniqid(); ?>";
		$.cookie("user_id", userID, { expires: 31, path: '/' });
	}
	$('.chatroom_room_a').click(function() {
		var isVerified = $.cookie('verified');
		if (isVerified) {
			sendToChatRoom();
		} else { // Verify Stanford Dialog Boxes
			var attempts = $.cookie("attempts");
			if (attempts == 2) {
				// TODO: Show Nicer dialog that person is not from Stanford
				alert("Sorry, you have answered incorrectly too many times. Are you actually from Stanford?");
			} else {
				showVerifyBox();
			}
		}
	});

	function sendToChatRoom() {
		$.ajax({
		    type: 'GET',
		    url: 'getroom.php',
			    success: function(room){
				if (room == '') { // No chatroom exists
					var chatroomID = "<?php echo uniqid('chat_'); ?>";
					var link = 'chat.php?id=' + chatroomID;
					$.ajax({
					    type: 'POST',
					    url: 'writeroom.php',
					    data: { 
						'chatroom_id': chatroomID
					    },
					    success: function(msg){
							$.cookie('current_chatroom', chatroomID);
							window.location = link;
					    }
					});
				} else { // chatroom exists already
					var link = 'chat.php?id=' + room;
					$.cookie('current_chatroom', room);
					window.location = link;
				}
		    }
		});
	}

	function showVerifyBox() {
		$("#dialog-confirm").css("border-bottom", "none");
	
		$( "#dialog-confirm" ).dialog({
			resizable: false,
			modal: true,
			buttons: {
				"Cancel": function() {
					$(this).dialog('close');
				},
				"Ready?": function() {
					getQuestion();					
				}
			}
		});
		$("#dialog-confirm").css("padding", "20px");
	}

	function getQuestion() {
		var NUM_SECONDS = 10000;
		var dialog = document.getElementById('box-text');
		$.ajax({
		    type: 'GET',
		    url: 'getquestion.php',
		    data: {},
		    success: function(question){
		    	
				var data = question.split('###');
				var question_num = data[0];
				var question = data[1];
				var html = '<b>' + question + '</b><br><br><table><tr><td><form id="qa">';
				for (var i = 2; i < data.length; i++) {
					html += '<input type= "radio" name="answer" value="' + data[i] + '" style="margin-right: 5px;"/>' + data[i] + '<br>';
				} 
				html += '</form></td><td><b><span id="timer">10</span></b></td></tr></table>';
				dialog.innerHTML = html;
				
				var secondsLeft = 10;
				var countdown = setInterval(function(){
					secondsLeft--;
					document.getElementById('timer').innerHTML = secondsLeft;
					if (secondsLeft == 0) {
						clearInterval(countdown);
						var attempt = $.cookie("attempts");
						if (attempt == null) attempt = 1;
						else attempt++;
						$.cookie("attempts", attempt);
						document.getElementById('timer').innerHTML = "Sorry, too slow!";
						$(".ui-dialog-buttonpane button:contains('Submit')").css("display","none");
						setTimeout(function(){
							window.location='index.php';
						}, 2000);
					}
				}, NUM_SECONDS/10);
				


				$( "#dialog-confirm" ).dialog({
					resizable: false,
					modal: true,
					buttons: {
						"Submit": function() {
							clearInterval(countdown);
							var box = this;
							var radios = document.getElementsByName('answer');
							var answer = '';
							for (var i = 0, length = radios.length; i < length; i++) {
								if (radios[i].checked) {
									answer = radios[i].value;
								}
							}
							$.ajax({
							   type: "GET",
							   url: "getanswer.php",
							   data: {  
										'question_num': question_num,
										'answer': answer
									},
							   success: function(data){
									if (data == 'true') {
										$.cookie('verified', true);
										document.getElementById('timer').innerHTML = "Correct!";
										$(".ui-dialog-buttonpane button:contains('Submit')").css("display","none");
										setTimeout(function(){
											sendToChatRoom();
										}, 1500);

									} else {
										var attempt = $.cookie("attempts");
										if (attempt == null) attempt = 1;
										else attempt++;
										document.getElementById('timer').innerHTML = "Sorry, that was incorrect.";
										$(".ui-dialog-buttonpane button:contains('Submit')").css("display","none");
										$.cookie("attempts", attempt);
										setTimeout(function(){
											$(box).dialog('close');
											window.location='index.php';
										}, 2000);
									}
									
							   }
							});	



						}
					}
				});
		    }
		});


	}




</script>
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
