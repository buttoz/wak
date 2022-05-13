<?php
require_once '../config/db/config.php';


if ($_POST['del_number']) {

	$db = getDbInstance();

	$del_code = $db->where('setting_name', 'del_code')->getOne('settings');


	if ($del_code['setting_value'] == $_POST['del_number']) {
		$prod = $db->where('import_id', $_POST['file_id'])->get('provider_price');
		$flag = true;
		foreach ($prod as $row) {
			$db2 = getDbInstance();
			$db2->where('prod_id', $row['c_id'])->getOne('polisa_item');
			if ($db2->count != 0)
				$flag = false;
		}
		if ($flag) {
			$db->where('c_id', $_POST['file_id'])->delete('import_history');
			$db->where('import_id', $_POST['file_id'])->delete('provider_price');
			$db->where('import_id', $_POST['file_id'])->delete('agent_price');
		} else {
			echo 1;
		}
	} else {
		echo -1;
	}
}
