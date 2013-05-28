<?php
	// BUG: CORRECT ANSWER CAN NOT HAVE SPACES
	$questions = array(
		"0###Which of these is not a library?###Green###Meyer###Burling",
		"1###Which of these is not on campus?###Subway###McDonalds###Starbucks###Panda Express",
		"2###Which of these is a popular math class?###Math 101###Math 10###Math 51###Math 37",
		"3###Which of these is not a Stanford Tradition?###Primal Scream###Roll Outs###Chocolate Walk###Big Game",
		"4###Which of these is not a Stanford Tradition?###Slope Day###Fountain Hopping###Full Moon on the Quad###Band Run",
		"5###Which of these is not a Stanford Tradition?###Steam Tunneling###Screw Your Roommate###Assassins###Orgo Night",
		"6###Which of these is not a dining hall?###Arrillaga###Flomo###Stern###Terman",
		"7###Which of these is not a dining hall?###Wilbur###Lag###Davenport###Ricker",
		"8###Where can you get late-night dining?###Manz###Arrillaga###Flomo###Branner",
		"9###Which of these is not a dorm?###Galvez###Casa Zapata###Ujamaa###Okada",
		"10###What is the maximum number of units an undergrad can take?###20###15###10###25",
		"11###What is the term for the week before finals week?###Dead Week###Pre-Final Week###Death Week###Worst Week",
	);
	$random = rand(0, count($questions) - 1);
	echo $questions[$random];
?>