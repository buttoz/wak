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

$backoofice_path = dirname(__DIR__, 2);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$form_data = filter_input_array(INPUT_POST);
	$db = getDbInstance();


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
	);





	$db->escape($data['business_name']);
	$db->escape($data['business_address']);
	$db->escape($data['a_firstname']);
	$db->escape($data['a_lastname']);

	$last_id = $db->insert('clients', $data);

	if ($last_id) {

		$backoofice_path = dirname(__DIR__, 3);

		if (!file_exists($backoofice_path . '/data/' . $_POST['datafolder'])) {
			mkdir($backoofice_path . '/data/' . $_POST['datafolder'], 0777, true);
			mkdir($backoofice_path . '/data/' . $_POST['datafolder'] . '/favicon', 0777, true);
			mkdir($backoofice_path . '/data/' . $_POST['datafolder'] . '/tknon', 0777, true);
			mkdir($backoofice_path . '/data/' . $_POST['datafolder'] . '/tradings', 0777, true);
			mkdir($backoofice_path . '/data/' . $_POST['datafolder'] . '/service', 0777, true);
			mkdir($backoofice_path . '/data/' . $_POST['datafolder'] . '/reports', 0777, true);
			mkdir($backoofice_path . '/data/' . $_POST['datafolder'] . '/projandserv', 0777, true);
			mkdir($backoofice_path . '/data/' . $_POST['datafolder'] . '/pfp', 0777, true);
			mkdir($backoofice_path . '/data/' . $_POST['datafolder'] . '/logo', 0777, true);
			mkdir($backoofice_path . '/data/' . $_POST['datafolder'] . '/excels', 0777, true);
			mkdir($backoofice_path . '/data/' . $_POST['datafolder'] . '/docs', 0777, true);
			mkdir($backoofice_path . '/data/' . $_POST['datafolder'] . '/checks', 0777, true);
			mkdir($backoofice_path . '/data/' . $_POST['datafolder'] . '/agreements', 0777, true);
		}

		$path = pathUrl(__DIR__ . '/../../');
		redirect($path . 'index.php?sec=settings&action=mangclients');
	}
}

?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-10 offset-md-1">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"><?php echo $lang['add_new_client']  ?></h3>


					</div>
					<div class="card-body">
						<?php
						?>
						<form autocomplete="false" class="well form-horizontal" action=" " method="post" id="clientmanage" enctype="multipart/form-data">
							<?php include_once 'addclient_form.php'; ?>
						</form>

					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
		</div>

	</section>
</div>