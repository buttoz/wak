<?php

require_once 'info4usms/info4uapi.php';
require_once '019/sms.php';
function send_sms($msg, $recepients)
{
	// if (STANDALONE)
	// 	info4u_SendSMS($msg, $recepients);
	// else
		send_sms_019($msg, $recepients);
}
