
	var userID = $.cookie('user_id');
	
	if (userID) { // user already has ID
		var current_chatroom = $.cookie('current_chatroom');
		console.log(current_chatroom);
		if (current_chatroom) {
			$.ajax({
				type: "POST",
				url: "rate.php",
				data: {  
					'chat_filename': 'conversations/' + current_chatroom + '.txt',
					'rating': $.cookie('user_id') + ':  -1'
				},
				success: function(data){
					console.log('WROTE TO RATE.PHP');
					$.ajax({
					   type: "POST",
					   url: "clearroom.php",
					   data: {  
							   'current_chatroom': $.cookie('current_chatroom')
					   },
					   success: function(data){	   
						   $.removeCookie('current_chatroom');
						   window.location = 'index.php';
						   console.log("CLEARED THE ROOM");
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