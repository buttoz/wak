<?php
require_once '../config/db/config.php';


if ($_POST['del_number']) {

	$db = getDbInstance();

	$del_code = $db->where('setting_name', 'del_code')->getOne('settings');


	if ($del_code['setting_value'] == $_POST['del_number']) {
		$db->where('c_id', $_POST['file_id'])->delete('import_history');
		$db->where('import_id', $_POST['file_id']);
		$db->where('import_id', $_POST['file_id'])->delete('import_customers');
	} else {
		echo 1;
	}
} else {
	echo -1;
}
