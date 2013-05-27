<?php
	// BUG: CORRECT ANSWER CAN NOT HAVE SPACES
	$questions = array(
		"0###Which of these is not a library?###Green###Meyer###Burling",
		"1###Which of these is not on campus?###Subway###McDonalds###Starbucks###Panda Express"
	);
	$random = rand(0, count($questions) - 1);
	echo $questions[$random];
?>