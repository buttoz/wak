<?php
require_once './mang/config/db/config.php';
//session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = filter_input(INPUT_POST, 'username');
	$passwd = filter_input(INPUT_POST, 'passwd');
	$remember = filter_input(INPUT_POST, 'remember');


	$db = getDbInstance();

	$db->where("u_username", $username);

	$row = $db->get('users');

	if ($db->count >= 1) {

		$db_password = $row[0]['password'];
		$user_id = $row[0]['id'];

		if (password_verify($passwd, $db_password)) {
			session_start();
			$_SESSION['user_logged_in'] = TRUE;
			$_SESSION['client_id'] = $row[0]['id'];
			$_SESSION['admin_type'] = $row[0]['u_userrole'];
			$testing = $db->where('setting_name', 'testing')->getOne('settings');
			$_SESSION['testing'] = $testing['setting_value'];
			$_SESSION['soruce'] = 'mang';
			$db = getDbInstance();



			$data = array(
				'u_lastlogin' => date('Y-m-d H:i:s'),
			);
			$db->where("u_username", $username);
			$db->update('users', $data);

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
