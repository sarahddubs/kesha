<?php
	$current_chatroom = $_POST["current_chatroom"];
	$file_name = 'rooms.txt';
	$file = fopen($file_name, 'r+') or die('Cannot open file:  '.$file_name);
	$line = fgets($file);
	if ($current_chatroom == $line) {
		fclose($file);
		fopen($file_name, 'w');
	}	
?>