<?php
	$question_num = $_GET['question_num'];
	$answer = $_GET['answer'];

	$answers = array(
		"Burling",
		"McDonalds",
		"Math 51",
		"Chocolate Walk",
		"Slope Day",
		"Orgo Night",
		"Terman",
		"Davenport",
		"Arrillaga",
		"Galvez",
		"20",
		"Dead Week"
	);
	$correct = $answers[$question_num];
	echo ($answer === $correct) ? 'true' : 'false';
?>