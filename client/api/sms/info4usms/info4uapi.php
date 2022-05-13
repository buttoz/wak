<?

function info4u_SendSMS($message_text, $recepients)
{
	$sms_user = "shagrir852"; // User Name (Provided by Inforu)
	$sms_apitoken = "8597b18e-0437-47db-b5cb-ee8fe532c42c"; // Password (Provided by Inforu)
	$sms_sender = "Shagrir"; //
	$message_text = preg_replace("/\r|\n/", "", $message_text); // remove line breaks
	$xml = '';
	$xml .= '<Inforu>' . PHP_EOL;
	$xml .= ' <User>' . PHP_EOL;
	$xml .= ' <Username>' . htmlspecialchars($sms_user) . '</Username>' . PHP_EOL;
	$xml .= ' <ApiToken>' . htmlspecialchars($sms_apitoken) . '</ApiToken>' . PHP_EOL;
	$xml .= ' </User>' . PHP_EOL;
	$xml .= ' <Content Type="sms">' . PHP_EOL;
	$xml .= ' <Message>' . htmlspecialchars($message_text) . '</Message>' . PHP_EOL;
	$xml .= ' </Content>' . PHP_EOL;
	$xml .= ' <Recipients>' . PHP_EOL;
	$xml .= ' <PhoneNumber>' . htmlspecialchars($recepients) . '</PhoneNumber>' . PHP_EOL;
	$xml .= ' </Recipients>' . PHP_EOL;
	$xml .= ' <Settings>' . PHP_EOL;
	$xml .= ' <Sender>' . htmlspecialchars($sms_sender) . '</Sender>' . PHP_EOL;
	$xml .= ' </Settings>' . PHP_EOL;
	$xml .= '</Inforu>';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://api.inforu.co.il/SendMessageXml.ashx');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'InforuXML=' . urlencode($xml));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($ch);
	curl_close($ch);
	return $response;
}
