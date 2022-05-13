<style>
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	input[type=number] {
		-moz-appearance: textfield;
	}
</style>

<?php

use \Gumlet\ImageResize;

$backoofice_path = dirname(__DIR__, 2);

$id = $_GET['id'];
$db = getDbInstance();
$db->where('c_id', $id);
$user = $db->getOne('clients');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$form_data = filter_input_array(INPUT_POST);
	$db = getDbInstance();

	$target_dir =  DATA_PATH . "/" . $user['datafolder'] . '/logo/';
	$target_file = $target_dir . basename($_FILES['logo']["name"]);
	$file_name = get_date_time_randomnumber(); //basename($file["name"]);
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	$replace_extension_file_name = str_replace('.' . $imageFileType, "", basename($_FILES['logo']["name"]));
	if ($_FILES['logo']["tmp_name"]) {
		move_uploaded_file($_FILES['logo']["tmp_name"], $target_dir .  $file_name . "." . $imageFileType);
		$_FILES['logo']['name'] = $file_name . "." . $imageFileType;
	}

	$target_dir =  DATA_PATH . "/" . $user['datafolder'] . '/favicon/';
	$target_file = $target_dir . basename($_FILES['favicon']["name"]);
	$file_name = get_date_time_randomnumber(); //basename($file["name"]);
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	$replace_extension_file_name = str_replace('.' . $imageFileType, "", basename($_FILES['favicon']["name"]));
	if ($_FILES['favicon']["tmp_name"]) {
		move_uploaded_file($_FILES['favicon']["tmp_name"], $target_dir .  $file_name . "." . $imageFileType);
		$_FILES['favicon']['name'] = $file_name . "." . $imageFileType;
	}



	$data = array(
		"c_insertdate" => date('Y-m-d H:i:s'),
		"a_firstname" => $form_data['first_name'],
		"a_lastname" =>  $form_data['last_name'],
		"business_id" => $form_data['business_id_number_client'],
		"business_address" => $form_data['business_add'],
		"business_name" => $form_data['business_name'],
		"business_tel" => $form_data['business_tel'],
		"client_type" => $form_data['client_type'],
		"city" => $_POST['city'],
		"description" => $_POST['description'],
		"mailbox" => $_POST['mailbox'],
		"postal_code" => $_POST['postal_code'],
		"house_num" => $_POST['house_num'],
		"street" => $_POST['street'],
		"url" => $_POST['url'],
		"datafolder" => $_POST['datafolder'],
		"invoice4u" => $_POST['invoice4u'],
		"client_desc" => $_POST['client_desc'],

	);
	if ($_FILES['logo']['name'] != '') {
		$data["logo"] = $_FILES['logo']['name'];
	}
	if ($_FILES['favicon']['name'] != '')
		$data["favicon"] = $_FILES['favicon']['name'];


	$db->escape($data['business_name']);
	$db->escape($data['business_address']);
	$db->escape($data['a_firstname']);
	$db->escape($data['a_lastname']);

	$last_id = $db->where('c_id', $_GET['id'])->update('clients', $data);

	if ($last_id) {
		$backoofice_path = dirname(__DIR__, 3);
		if (!file_exists($backoofice_path . '/data/' . $_POST['datafolder'])) {
			rename($backoofice_path . '/data/' . $user['datafolder'], $backoofice_path . '/data/' . $_POST['datafolder']);
		}
		$path = pathUrl(__DIR__ . '/../../');
	}
}
?>

<form autocomplete="false" class="well form-horizontal" action=" " method="post" id="clientupdate" enctype="multipart/form-data">
	<?php include_once 'updateclient_form.php'; ?>
</form>