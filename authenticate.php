<?php
require_once './mang/config/db/config.php';
require_once './mang/api/mmc/mmcapi.php';
//session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = filter_input(INPUT_POST, 'username');
	$passwd = filter_input(INPUT_POST, 'passwd');
	$remember = filter_input(INPUT_POST, 'remember');


	$db = getDbInstance();

	$db->where("u_username", $username);

	$row = $db->get('users');

	//    var_dump($row[0]['password']);
	//    var_dump($row[0]['id']);

	if ($db->count >= 1) {

		$db_password = $row[0]['password'];
		$user_id = $row[0]['id'];

		//		var_dump($db_password);
		//		var_dump($user_id);

		if (password_verify($passwd, $db_password)) {

			$_SESSION['user_logged_in'] = TRUE;
			$_SESSION['user_id'] = $row[0]['id'];
			$_SESSION['admin_type'] = $row[0]['u_userrole'];
			$testing = $db->where('setting_name', 'testing')->getOne('settings');
			$_SESSION['testing'] = $testing['setting_value'];
			$_SESSION['soruce'] = 'mang';

			if (!STANDALONE) {
				MMC_GET_TOKEN();
				$token = $db->getOne('mmc_token');
				if (isset($token['token_value']))
					$_SESSION['token'] = $token['token_value'];
			}
			$db = getDbInstance();



			$data = array(
				'u_lastlogin' => date('Y-m-d H:i:s'),
			);
			$db->where("u_username", $username);
			$db->update('users', $data);

			if ($remember) {

				$series_id = randomString(16);
				$remember_token = getSecureRandomToken(20);
				$encryted_remember_token = password_hash($remember_token, PASSWORD_DEFAULT);


				$expiry_time = date('Y-m-d H:i:s', strtotime(' + 30 days'));



				$expires = strtotime($expiry_time);

				setcookie('series_id', $series_id, $expires, "/");
				setcookie('remember_token', $remember_token, $expires, "/");

				$db = getDbInstance();
				$db->where('id', $user_id);

				$update_remember = array(
					'series_id' => $series_id,
					'remember_token' => $encryted_remember_token,
					'expires' => $expiry_time
				);
				$db->update("users", $update_remember);
			}
			//Authentication successfull redirect user
			header('Location: ./mang/index.php');
		} else {
			$invalid_user = $_SESSION['lang'] == 'en' ? "Invalid user name or password" : ($_SESSION['lang'] == 'ar' ? "خطأ في اسم المستخدم أو كلمة مرور" : 'שם משתמש או סיסמה לא חוקיים');

			$_SESSION['login_failure'] = $invalid_user;
			header('Location:login.php');
		}

		exit;
	} else {
		$invalid_user = $_SESSION['lang'] == 'en' ? "Invalid user name or password" : ($_SESSION['lang'] == 'ar' ? "خطأ في اسم المستخدم أو كلمة مرور" : 'שם משתמש או סיסמה לא חוקיים');
		$_SESSION['login_failure'] = $invalid_user;
		header('Location:login.php');
		exit;
	}
} else {
	die('Method Not allowed');
}
