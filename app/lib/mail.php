<?php

function sendMail($email, $title, $message) {
	$encoding = "utf-8";
	$from_name = '42 Camagru';
	$from_mail = 'no-reply@camagru.com';
	$mail_subject = $title;
	$mail_to = $email;
	$mail_message = $message;

	// Set preferences for Subject field
	$subject_preferences = [
		"input-charset" => $encoding,
		"output-charset" => $encoding,
		"line-length" => 76,
		"line-break-chars" => "\r\n"
	];

	// Set mail header
	$header = "Content-type: text/html; charset=".$encoding." \r\n";
	$header .= "From: ".$from_name." <".$from_mail."> \r\n";
	$header .= "MIME-Version: 1.0 \r\n";
	$header .= "Content-Transfer-Encoding: 8bit \r\n";
	$header .= "Date: ".date("r (T)")." \r\n";
	$header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);

	// Send mail
	return mail($mail_to, $mail_subject, $mail_message, $header);
}
