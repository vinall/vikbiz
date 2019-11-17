<?php
	$from = "mster.vinay@gmail.com";
	$to = "iiita.vinay@gmail.com";

	$subject = "Test mail from php";
	$message = "Check if this is working fine";
	$headers = "From: " . $from;

	mail($to,$subject,$message,$headers);

	echo "this email message was successfully sent.";
	echo "Thank you";
?>