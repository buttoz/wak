<?php
require_once './languages/he.lang.php';

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

function split_name($name)
{
	return  explode(' ', $name, 2);
}
function check_cust_teken($userid_new, $licance_id, $release_date, $exp_date)
{
	$db = getDbInstance();
	$db->where('c_idnumber', $userid_new);
	$cust_id = $db->getValue('customers', 'c_id');
	$db->where('c_carnumber', $licance_id);
	$car_id = $db->orderBy('c_id', 'desc')->getValue('cars', 'c_id');
	$release_date = date('Y-m-d', strtotime($release_date));
	$exp_date = date('Y-m-d', strtotime($exp_date));
	$check_id = $db->rawQuery("SELECT * FROM  `polisa` WHERE  `cust_id` ='$cust_id' AND car_id='$car_id' AND c_enddate>'$release_date' AND car_id!='0' AND cust_id!='0' ");
	if ($check_id) {
		return false;
	} else {
		return true;
	}
}

$time = date("d-m-Y") . "-" . time();


function shlomo($form_data, $array_without_title)
{
	global $lang;
	global $time;
	$src = 'mang';

	try {

		$db = getDbInstance();
		$data = array(
			"c_userid" => $_SESSION['agent_id'],
			"c_insertdate" => date('Y-m-d H:i:s'),
			"c_ip" => getuserip(),
			"description" => $_POST['desc'],
			"agent_id" => $form_data['agents'],
			"file_name" => $time . "-" . $_FILES['file']['name'],
			"src" => $src
		);
		$import_id = $db->insert('user_import_history', $data);


		foreach ($array_without_title as $key => $exceldata) {

			$db = getDbInstance();



			if ($exceldata[3]) {

				$agent_id = $form_data['agents'];
				//$cust_type = $exceldata[0];

				$splitname = split_name($exceldata[2]);
				if (isset($splitname[1]))
					$lastname = $splitname[1];
				else {
					$lastname = '';
				}
				$firstname = $splitname[0];
				$userid = $exceldata[3];
				//$address = $exceldata[4];
				//$city = $exceldata[5];
				//$phone = $exceldata[6];
				$car_type = get_cartypeid($exceldata[6]);
				//$drive_type = $exceldata[8];
				//$insurance_type = $exceldata[9];
				//$import_type = $exceldata[10];
				$startdate = $exceldata[9];
				$enddate = $exceldata[10];
				$car_number = $exceldata[5];
				$prod_year = $exceldata[7];
				$model_num = $exceldata[8];


				$client_id = $db->where('url', $_SERVER['SERVER_NAME'])->getOne('clients');
				$data = array(
					"c_insertdate" => date('Y-m-d H:i:s'),
					"c_ip" => getuserip(),
					"c_userid" => $_SESSION['agent_id'],
					"c_agentid" => $agent_id,
					"c_status" => 5,
					"c_startdate" => $startdate,
					"c_enddate" => $enddate,
					"car_type" => $car_type,
					"usersystemtype" => 'mang',
					"user_import_id" => $import_id,
				);
				if (!STANDALONE)
					$data['client_id'] = $client_id['c_id'];
				$id = $db->insert('polisa', $data);


				$db->where('c_idnumber', $userid);
				$cust_id = $db->getValue('customers', 'c_id');

				$customer = array(
					"c_userid" => $_SESSION['agent_id'],
					"c_ip" => getuserip(),
					"c_insertdate" => date('Y-m-d H:i:s'),
					"c_idnumber" => $userid,
					"c_firstname" => $firstname,
					"c_lastname" => $lastname,
					"user_import_id" => $import_id,
				);

				if (!$cust_id)
					$cust_id = $db->insert('customers', $customer);

				$db->rawQuery("UPDATE `polisa` SET `cust_id` = $cust_id WHERE `c_id` = $id;");

				$customer_id = $cust_id;


				$car = array(
					"c_userid" => $_SESSION['agent_id'],
					"c_ip" => getuserip(),
					"c_insertdate" => date('Y-m-d H:i:s'),
					"c_carnumber" => $car_number,
					//"c_degem" => $car_model,
					"year_of_prod" => $prod_year,
					"model_num" => $model_num,
					//"c_personalimported" => $import_type,
					"polisa_id" => $id,
					"agent_id" => $_POST['agents'],
					"cust_idnumber" => $userid,
					"user_import_id" => $import_id,
				);
				$cust_id = $db->insert('cars', $car);

				$db->rawQuery("UPDATE `polisa` SET `car_id` = $cust_id WHERE `c_id` = $id;");

				$data = array(
					"c_userid" => $_SESSION['agent_id'],
					"c_ip" => getuserip(),
					"c_insertdate" => date('Y-m-d H:i:s'),
					"c_typeofaction" => 'polisa_import',
					"c_polisa_id" => $id,
					"usersystemtype" => 'mang',
				);
				$db->insert('polisa_history', $data);
			}
		}
	} catch (\Throwable $th) {
		echo  "<center style='color:red; font-weight:bold'>$lang[importerror]</center>";
		$db->where('c_id', $import_id)->delete('user_import_history');
	}
}


function system_import($form_data, $array_without_title)
{
	require_once './languages/he.lang.php';
	global $time;
	global $src;
	global $lang;
	if (checkdata($array_without_title))
		try {

			$db = getDbInstance();
			$data = array(
				"c_userid" => $_SESSION['agent_id'],
				"c_insertdate" => date('Y-m-d H:i:s'),
				"c_ip" => getuserip(),
				"description" => $_POST['desc'],
				"agent_id" => $form_data['agents'],
				"file_name" => $time . "-" . $_FILES['file']['name'],
				"src" => $src
			);
			$import_id = $db->insert('user_import_history', $data);

			$err = array();

			foreach ($array_without_title as $key => $exceldata) {

				$db = getDbInstance();

				if ($exceldata[0] >= 0) {


					$agent_id = $form_data['agents'];
					$cust_type = $exceldata[0];
					$userid = $exceldata[1];
					$firstname = $exceldata[2];
					$lastname = $exceldata[3];
					$address = $exceldata[4];
					$city = $exceldata[5];
					$phone = $exceldata[6];
					$car_type = get_cartypeid($exceldata[7]);
					$drive_type = $exceldata[8];
					$insurance_type = $exceldata[9];
					$import_type = $exceldata[10];
					$startdate = $exceldata[11];
					$enddate = $exceldata[12];
					$car_number = $exceldata[13];
					$prod_year = $exceldata[14];
					$model_num = $exceldata[15];
					$car_model = $exceldata[16];

					if (check_cust_teken($userid, $car_number, $startdate, $enddate)) {

						$client_id = $db->where('url', $_SERVER['SERVER_NAME'])->getOne('clients');

						$data = array(
							"c_insertdate" => date('Y-m-d H:i:s'),
							"c_ip" => getuserip(),
							"c_userid" => $_SESSION['agent_id'],
							"c_agentid" => $agent_id,
							"c_startdate" => date("Y-m-d H:i:s", strtotime($startdate)),
							"c_enddate" =>  date("Y-m-d H:i:s", strtotime($enddate)),
							"c_status" => 5,
							"car_type" => $car_type,
							"insurance_type" => $insurance_type,
							"driver_type" => $drive_type,
							"usersystemtype" => 'mang',
							"user_import_id" => $import_id,
						);
						if (!STANDALONE)
							$data['client_id'] = $client_id['c_id'];
						$id = $db->insert('polisa', $data);


						$db->where('c_idnumber', $userid);
						$cust_id = $db->getValue('customers', 'c_id');

						$customer = array(
							"c_userid" => $_SESSION['agent_id'],
							"c_ip" => getuserip(),
							"c_insertdate" => date('Y-m-d H:i:s'),
							"c_idnumber" => $userid,
							"c_firstname" => $firstname,
							"c_lastname" => $lastname,
							"c_mobile" => $phone,
							"c_addr" => $address,
							"city" => $city,
							"cust_type" => $cust_type,
							"user_import_id" => $import_id,
						);

						if (!$cust_id)
							$cust_id = $db->insert('customers', $customer);

						$db->rawQuery("UPDATE `polisa` SET `cust_id` = $cust_id WHERE `c_id` = $id;");

						$customer_id = $cust_id;


						$db->where('c_carnumber', $car_number);
						$cust_id = $db->getValue('cars', 'c_id');

						$car = array(
							"c_userid" => $_SESSION['agent_id'],
							"c_ip" => getuserip(),
							"c_insertdate" => date('Y-m-d H:i:s'),
							"c_carnumber" => $car_number,
							"c_degem" => $car_model,
							"year_of_prod" => $prod_year,
							"model_num" => $model_num,
							"c_personalimported" => $import_type,
							"polisa_id" => $id,
							"agent_id" => $_POST['agents'],
							"cust_idnumber" => $userid,
							"user_import_id" => $import_id,
						);
						$cust_id = $db->insert('cars', $car);

						$db->rawQuery("UPDATE `polisa` SET `car_id` = $cust_id WHERE `c_id` = $id;");
					} else {
						$err[$key] = 'מנוי קיים ל ' . $firstname . " " . $lastname . " ת.ז : " . $userid . " מס. רכב " . $car_number;
					}
				}
			}
			$_POST['err'] = $err;
		} catch (\Throwable $th) {
			if (count($array_without_title) == 0)
				echo  "<center style='color:red; font-weight:bold'>$lang[empty_file]</center>";
			else
				echo  "<center style='color:red; font-weight:bold'>$lang[importerror]</center>";
			$db->where('c_id', $import_id)->delete('user_import_history');
		}
	else {
		if (count($array_without_title) == 0)
			$err[0] = "קובץ ריק";
		else
			$err[0] = "קובץ לא תקין";
		$_POST['err'] = $err;
	}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$form_data = filter_input_array(INPUT_POST);

	$allowedFileType = [
		'application/vnd.ms-excel',
		'text/xls',
		'text/xlsx',
		'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
	];


	if (in_array($_FILES["file"]["type"], $allowedFileType)) {
		$backoofice_path = dirname(__DIR__, 3);
		$targetPath = DATA_PATH . "/excels/" . $time . "-" . $_FILES['file']['name'];
		//            $targetPath = 'uploads/' . $_FILES['file']['name'];
		move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

		$Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

		$spreadSheet = $Reader->load($targetPath);
		$excelSheet = $spreadSheet->getActiveSheet();
		$spreadSheetAry = $excelSheet->toArray();
		$sheetCount = count($spreadSheetAry);

		if (isset($_POST['checktitle']))
			$array_without_title = array_slice($spreadSheetAry, 1);
		else
			$array_without_title = $spreadSheetAry;

		$total_source_record_array = [];
		$exist_record_array = [];
		$err_arr = array();


		function system_checkdata($exceldata)
		{
			$arr['cartype_id'] = $exceldata[7];
			$arr['userid'] = $exceldata[1];
			$arr['firstname'] = $exceldata[2];
			$arr['lastname'] = $exceldata[3];
			$arr['car_number'] = $exceldata[13];
			$arr['startdate'] = $exceldata[11];
			$arr['enddate'] = $exceldata[12];
			return $arr;
		}
		if (isset($form_data['check_import'])) {

			foreach ($array_without_title as $key => $exceldata) {
				$funcname =  $form_data['supp_select'] . "_checkdata";
				$data = $funcname($exceldata);
				if ($data['cartype_id']) {
					$car_res = get_cartypeid($data['cartype_id']);
					if ($car_res === 0) {
						$err_arr[$key] = $data['cartype_id'];
					}
				}

				if (!check_cust_teken($data['userid'], $data['car_number'], $data['startdate'], $data['enddate']))
					$err_arr[$key] = 'מנוי קיים ל ' . $data['firstname'] . " " . $data['lastname'] . " ת.ז : " . $data['userid'] . " מס. רכב " . $data['car_number'];
			}

			$_POST['err'] = $err_arr;
		}

		function checkdata($array_without_title)
		{
			foreach ($array_without_title as $key => $exceldata) {
				if (!isset($exceldata[7]))
					$err_arr[$key] = "empty";
				elseif ($exceldata[7]) {
					$cartype_id = $exceldata[7];

					$car_res = get_cartypeid($cartype_id);
					if ($car_res === 0) {
						$err_arr[$key] = $exceldata[7];
					}
				}
			}

			if (empty($err_arr) and count($array_without_title) != 0)
				return true;
			else
				return false;
		}

		if (isset($form_data['import'])) {
			try {
				$form_data['supp_select']($form_data, $array_without_title);
			} catch (Error $th) {
			}
		}
	}
}

$supp_src = isset($_POST['supp_select']) ? $_POST['supp_select'] : 0;


?>


<div class="content-wrapper">

	<section class="content">
		<div class="container-fluid">

			<div class="row">
				<div class="col-md-4">
					<h2>יבוא לקוחות</h2>
					<br>
					<div class="outer-container">
						<form action="" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
							<div>
								<div class="row">
									<div class="col-md-6">
										<label for="agents"><?= $lang['agents'] ?></label>
										<select name="agents" id="agents" class="form-control" required>
											<option value="">
												<? echo $lang['choose_agent'] ?>
											</option>
											<?
											$db = getDbInstance();
											$agents = $db->get('agents');
											foreach ($agents as $row) {
											?>
												<option value="<? echo $row['c_id'] ?>">
													<? echo $row['business_name'] ?>
												</option>
											<? } ?>
										</select>
									</div>
									<? if (!STANDALONE) { ?>
										<div class="col-md-6">
											<label for="supp_select"><?= $lang['system_build'] ?></label>
											<select name="supp_select" id="supp_select" class="form-control" required>
												<option value=""><?= $lang['choose_build'] ?></option>
												<?= get_supplier_agent_import(get_resp_id(), $supp_src); ?>

											</select>
										</div>
										<br>
									<? } ?>
								</div>
								<div class="form-group">
									<label>בחר קובץ אקסל</label>
									<input class="form-control" type="file" name="file" id="file" accept=".xls,.xlsx" required>
								</div>

								<div class="form-check">

									<input class="form-check-input" type="checkbox" checked name="checktitle" id="checktitle">
									<label class="form-check-label">התעלם מהכותרת</label>
								</div>
								<br>
								<div class="form-group">
									<textarea name="desc" class="form-control" id="" required></textarea>
								</div>
								<div class="form-group">
									<?/*?><button class="form-control btn btn-primary" type="submit" id="importBtn"
										name="import" class="btn-submit">Import</button>
									<?*/ ?>
									<input type="submit" name="import" class="btn btn-primary" value="<?= $lang['import'] ?>">
									<input type="submit" name="check_import" class="btn btn-primary" value="<?= $lang['check_import'] ?>">
								</div>
							</div>
						</form>

					</div>
				</div>

				<? if (isset($_POST['err'])) {
				?>
					<div class="col-md">
						<div class="card">
							<div class="card-header"><?= $lang['error_list'] ?></div>
							<div class="card-body">
								<?
								if (isset($_POST['err']))
									if (count($_POST['err']) != 0)
										foreach ($_POST['err'] as $key => $row) {
								?>
									<div class="callout callout-danger"><?= " בשורה " . $key . " - " . $row ?></div>
								<?
										}
									else {
								?>
									<h6>הנתונים תקינים</h6>
								<?
									}
								?>

							</div>
						</div>
					</div>
				<? } ?>
			</div>

			<div class="col-md-12">
				<div class="card">
					<div class="card-header"><?= $lang['history'] ?></div>
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th><?= $lang['id'] ?></th>
									<th><?= $lang['date'] ?></th>
									<th><?= $lang['description'] ?></th>
									<th><?= $lang['agent'] ?></th>
									<th><?= $lang['user_name'] ?></th>
									<th><?= $lang['file'] ?></th>
								</tr>
							</thead>
							<tbody>
								<?
								$db = getDbInstance();
								$history = $db->get('user_import_history');
								foreach ($history as $row) {
									$user = $db->where('id', $row['c_userid'])->getOne('users');
									$agent = $db->where('c_id', $row['agent_id'])->getOne('agents');
									if ($row['src'] == 'agent')
										$resp = $agent['a_firstname'] . " " . $agent['a_lastname'];
									elseif ($row['src'] == 'agent_user') {
										$agent_user = $db->where('id', $row['c_userid'])->getOne('agent_users');
										$resp = $agent_user['user_full_name'];
									} else {
										$user = $db->where('id', $row['c_userid'])->getOne('users');
										$resp = $user['u_firstname'] . " " . $user['u_lastname'];
									}
								?>
									<tr>
										<td id="<?= $row['c_id'] ?>" class="load_file_id" data-toggle="modal" data-target="#del_row_modal"><?= $row['c_id'] ?></td>
										<td id="<?= $row['c_id'] ?>" class="load_file_id" data-toggle="modal" data-target="#del_row_modal"><?= $row['c_insertdate'] ?></td>
										<td id="<?= $row['c_id'] ?>" class="load_file_id" data-toggle="modal" data-target="#del_row_modal"><?= $row['description'] ?></td>
										<td id="<?= $row['c_id'] ?>" class="load_file_id" data-toggle="modal" data-target="#del_row_modal"><?= $agent['business_name'] ?></td>
										<td id="<?= $row['c_id'] ?>" class="load_file_id" data-toggle="modal" data-target="#del_row_modal">
											<?= $resp ?></td>
										<td id="<?= $row['file_name'] ?>" class="view_excel_file">
											<i class="fas fa-search fa-lg open_file_excel"></i>
										</td>
									</tr>
								<?
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal fade" id="del_row_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="ageument">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="updateinvoice"><?php echo $lang['del_import'] ?></h5>

							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="modal-body">
							<form id="user_del_file_modal">
								<input type="hidden" name="file_id" id="file_id">
								<label for="del_number"><?= $lang['del_code'] ?></label>
								<input type="tel" name="del_number" id="del_number" class="form-control" required>
								<h6 style="color:red" id="error_msg"></h6>
								<div class="invbtn">
									<input class="btn btn-danger" type="submit" value="<?php echo $lang['delete'] ?>">
									<button type="button" id="closeivoice" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close'] ?></button>

								</div>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
</div>
</section>

</div>

<?
function get_cartypeid($str)
{

	$dbcar = getDbInstance();
	$dbcar->Where('c_name', $str);
	$data_exist = $dbcar->getOne('car_types');
	if ($dbcar->count > 0)
		return $data_exist['c_id'];
	else
		return 0;
}
function get_servtypeid($str)
{
	$db = getDbInstance();
	$db->Where('short_name', $str);
	$data_exist = $db->getOne('service_type');
	if ($data_exist)
		return $data_exist['c_id'];
	else
		return 0;
}
?>