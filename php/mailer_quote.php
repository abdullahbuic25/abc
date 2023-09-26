<?php
/*-----------------------------------------------
	# Variables
	---------------------------------------------*/

$name       = $_POST['name'];
$email      = $_POST['email'];
$subject    = isset($_POST['subject']) && !empty($_POST['subject']) ? $_POST['subject'] : 'A New Request For Terapage Demo';
$content    = $_POST['content'];
$toMail     = 'Terapage <sales@terapage.ai>'; // Your name & mail address here example 'Your Name <contact@domain.com>'.

/*-----------------------------------------------
	# Error Reporting need first
	---------------------------------------------*/
$error      = false;
$msg        = '';
$body       = '';

// Check Name
if (empty($name)) {
	$error = true;
	$msg   .= '<strong>Required:</strong> Please enter your name.';
	$msg   .= '<br>';
} else {
	$body  .= '<strong>Name:</strong> ' . $name;
	$body  .= '<br><br>';
}

// Check Email
if (empty($email)) {
	$error = true;
	$msg   .= '<strong>Required:</strong> Please enter a valid email address.';
	$msg   .= '<br>';
} else {
	$body  .= '<strong>Email:</strong> ' . $email;
	$body  .= '<br><br>';
}

// Check Content
if (empty($content)) {
	$error = true;
	$msg   .= '<strong>Required: </strong> Please write a message so that we can get back to you with the right response.';
	$msg   .= '<br>';
} else {
	// Subject
	$body  .= '<strong>Subject:</strong> ' . $subject;
	$body  .= '<br><br>';

	// Body Content
	$body  .= '<strong>Message:</strong> ' . $content;
	$body  .= '<br><br>';
}

/*-----------------------------------------------
	# Prepare send mail
	---------------------------------------------*/
if ($error == true) {
	$msg    .= '<strong>Error:</strong> Please fill form with above info requirement.';
} else {
	$body   .= $_SERVER['HTTP_REFERER'] ? '<br><br><br>This form was submitted from: ' . $_SERVER['HTTP_REFERER'] : '';
	$error   = false;
	$msg    .= '<strong>Success:</strong> Thanks for requesting a demo. We will get back to you shortly.';

	// Mail Headers
	$headers   = array();
	$headers[] = "MIME-Version: 1.0";
	$headers[] = "Content-type: text/html; charset=iso-8859-1";
	$headers[] = "From: {$name} <{$email}>";
	$headers[] = "Reply-To: {$name} <{$email}>";
	$headers[] = "Subject: {$subject}";
	$headers[] = "X-Mailer: PHP/".phpversion();

	mail($toMail, $subject, $body, implode("\r\n", $headers));
}
// Make as json obj
$dataReturn = array(
	'error'   => $error,
	'message'   => $msg,
	'data'  => array(
		'name' => $name,
		'email' => $email,
		'subject' => $subject,
		'content' => $content
	)
);
header('Content-type: application/json');
echo json_encode($dataReturn);