<?php
	$question_num = $_GET['question_num'];
	$answer = $_GET['answer'];

	$answers = array(
		"Burling",
		"McDonalds"
	);
	$correct = $answers[$question_num];
	echo ($answer === $correct) ? 'true' : 'false';
?>