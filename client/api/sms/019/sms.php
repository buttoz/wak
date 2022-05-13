<?php

if (isset($_POST['key']))
	send_sms_019($msg, $recepients);
$senderid = "SignIn";
function send_sms_019($msg, $recepients)
{
	
	$senderid = "SignIn";
	$msg = str_replace('<', '%26lt;', $msg); // "Cleans" the message from unsafe notes
	$msg = str_replace('>', '%26gt;', $msg); // "Cleans" the message from unsafe notes
	$msg = str_replace('\"', '%26quot;', $msg); // "Cleans" the message from unsafe notes
	$msg = str_replace("\'", '%26apos;', $msg); // "Cleans" the message from unsafe notes
	$msg = str_replace("&", '%26amp;', $msg); // "Cleans" the message from unsafe notes
	$msg = str_replace("\r\n", '%0D%0A', $msg); // "Cleans" the message from enter
	$msg = str_replace("\r", '%0D%0A', $msg); // "Cleans" the message from enter
	$msg = str_replace("\n", '%0D%0A', $msg); // "Cleans" the message from enter
	$msg = str_replace("\t", '%0D%0A', $msg); // "Cleans" the message from enter


	$key = "eyJ0eXAiOiJqd3QiLCJhbGciOiJIUzI1NiJ9.eyJmaXJzdF9rZXkiOiIzOTc4NiIsInNlY29uZF9rZXkiOiIyNTk4NjEwIiwiaXNzdWVkQXQiOiIwMi0wMi0yMDIyIDE5OjM3OjIzIiwidHRsIjo2MzA3MjAwMH0.Ifzre7kWo-p4WTXA1jc96Xc_b91znilVOvchyUYhfqU";
	$url = "https://019sms.co.il/api";
	$xml = '
	<?xml version="1.0" encoding="UTF-8"?>
	<sms>
	<user>
	<username>rdsenergy</username>
	
	</user>
	<source>' . $senderid . '</source>
	<destinations>';
	$mobarr = explode(";", $recepients);
	foreach ($mobarr as $val) {
		$xml .= '<phone id="' . $val . '">' . $val . '</phone>';
	}
	$xml .= '
	</destinations>
	<message>' . $msg . '</message>
	</sms>';

	$CR = curl_init();
	curl_setopt($CR, CURLOPT_URL, $url);
	curl_setopt($CR, CURLOPT_POST, 1);
	curl_setopt($CR, CURLOPT_FAILONERROR, true);
	curl_setopt($CR, CURLOPT_POSTFIELDS, $xml);
	curl_setopt($CR, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($CR, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($CR, CURLOPT_HTTPHEADER, array(
		"charset=utf-8",
		"Content-Type: application/json",
		"Authorization: Bearer " . $key
	));
	$result = curl_exec($CR);
	$error = curl_error($CR);
	if (!empty($error))
		die("Error: " . $error);
	else
		$response = new SimpleXMLElement($result);

//	echo $response;
}
