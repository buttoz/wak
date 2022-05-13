<?
$db = getDbInstance();
$car_types = $db->get('car_types');
$service_type = $db->get('service_type');
$suppliers = $db->get('suppliers');
if ($db->count == 1) {
	$_POST['suppliersagent'][$suppliers[0]['c_id']] = $suppliers[0]['c_id'];
}
?>
<div class="modal fade" id="updateagentprodsub" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="ageument">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="updateinvoice"><?php echo $lang['update_privare_price'] ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="updateprodsub_form" action="index.php?sec=agents&action=agentplus&id=<? echo $_GET['id'] ?>" method="POST">
					<input type="hidden" name="id_to_update" id="id_to_update">
					<input type="hidden" name="old_price" id="old_price">
					<input type="hidden" name="agent_id" id="agent_id" value="<? echo $_GET['id'] ?>">

					<label for="precent_descount_live"><? echo $lang['precent_desc'] ?></label>
					<input type="number" class="form-control" name="precent_descount_live" id="precent_descount_live"><br>
					<label for="new_price"><? echo $lang['new_price'] ?></label>
					<input type="tel" class="form-control" name="new_price" id="new_price"><br>
					<input id="active_inactive_price" name="active_inactive" type="checkbox" data-toggle="toggle" data-on="<?php echo $lang['active'] ?>" data-off="<?php echo $lang['inactive'] ?>" data-onstyle="success" data-offstyle="danger">
					<div class="invbtn">
						<input class="btn btn-success" type="submit" value="<?php echo $lang['save'] ?>">
						<button type="button" id="close_add_prod" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close'] ?></button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>
<div class="card">
	<div class="card-header">
		<h6><? echo $lang['search'] ?></h6>
	</div>
	<div class="card-body">
		<form id="search_prices" action="index.php?sec=agents&action=agentplus&id=<? echo $_GET['id'] ?>" method="POST">
			<div class="row">
				<?
				isset($_POST['suppliersagent']) ? $arr = $_POST['suppliersagent'] : $_POST['suppliersagent'] = 0;
				$switchbox = getDbInstance();
				if ($db->count > 1)

					foreach ($suppliers as $supplier) {
						$switchbox->where('supp_id', $supplier['c_id'])->where('agent_id', $_GET['id'])->getOne('agent_supp');
				?>
					<div style="padding-left:1em;padding-right:0.5em;">
						<div class="card" id="agentcontsup<?= $supplier['c_id'] ?>" <?= (isset($arr[$supplier['c_id']])) ? 'style="background-color:#9edbf5"' : '' ?>>

							<div class="card-body">
								<div class="d-flex justify-content-center">
									<div class="custom-control custom-switch">
										<input type="checkbox" class="custom-control-input" id="agentcustomSwitch<?= $supplier['c_id'] ?>" <?= $switchbox->count > 0 ? 'checked' : '' ?>>
										<label class="custom-control-label" for="agentcustomSwitch<?= $supplier['c_id'] ?>"></label>
									</div>
								</div>
								<div id="agentsupplierscont<?= $supplier['c_id'] ?>">
									<div style="height: 150px;" class="row align-items-center">
										<img style="max-width: 150px; " src="<?= DATA_URL ?>/logo/<?= $supplier['logo'] ?>" alt="logo">
									</div>
									<div class="row d-flex justify-content-center">
										<input style="display: none;" type="checkbox" name="suppliersagent[<?= $supplier['c_id'] ?>]" id="suppliersagent<?= $supplier['c_id'] ?>" <?= isset($arr[$supplier['c_id']]) ? 'checked' : '' ?>>
									</div>
								</div>
							</div>
						</div>
					</div> <? }
					else {
						foreach ($suppliers as $supplier) {
							?>
						<div style="padding-left:1em;padding-right:0.5em;">
							<div class="card" id="contsup<?= $supplier['c_id'] ?>" <?= (isset($arr[$supplier['c_id']])) ? 'style="background-color:#9edbf5"' : '' ?>>

								<div class="card-body">
									<div id="agentsupplierscont<?= $supplier['c_id'] ?>">
										<div style="height: 150px;" class="row align-items-center">
											<img style="max-width: 150px; " src="<?= DATA_URL ?>/logo/<?= $supplier['logo'] ?>" alt="logo">
										</div>
										<div class="row d-flex justify-content-center">
											<input style="display: none;" type="checkbox" name="suppliersagent[<?= $supplier['c_id'] ?>]" id="suppliersagent<?= $supplier['c_id'] ?>" checked>
										</div>
									</div>
								</div>
							</div>
						</div>
				<?
						}
					} ?>
			</div>
			<label><?php echo $lang['car_type']; ?>:</label><br>
			<?
			$type = isset($_POST['car_type']) ? $_POST['car_type'] : 0;
			$car_types = $db->orderBy('order_num', 'ASC')->get('car_types');
			foreach ($car_types as $car_type) {
			?>
				<input type="checkbox" name="car_type[<? echo $car_type['c_id'] ?>]" id="car_type_add<? echo $car_type['c_id'] ?>" <?= isset($type[$car_type['c_id']]) ? 'checked' : '' ?>>
				<label for="serv_type"><? echo $car_type['c_name'] ?></label>
			<? } ?>
			<br>
			<label for="service_type"><? echo $lang['service_type'] ?>:</label><br>
			<?
			foreach ($service_type as $type) {
			?>
				<input type="checkbox" id="serv_type<? echo $type['c_id'] ?>" value="<? echo $type['c_id'] ?>" name="serv_type[<? echo $type['c_id'] ?>]" <? echo ((isset($_POST['serv_type'])) and (in_array($type['c_id'], $_POST['serv_type']))) ? 'checked' : '' ?>></option>
				<label for=""> <? echo $type['c_name'] ?></label>
			<? } ?>
			<div class="p-2">
				<input type="submit" class="btn btn-success" value="<? echo $lang['search'] ?>">
			</div>
		</form>
	</div>

</div>

<div class="row">
	<div class="col-md-3">
		<form id="buttons-form" action="index.php?sec=agents&action=agentplus&id=<? echo $_GET['id'] ?>" method="POST">
			<div class="p-2">
				<input type="button" value="<? echo $lang['all_price_update'] ?>" class="btn btn-success update_all_prices" name="update_all_prices" id="<? echo $_GET['id'] ?>">
			</div>
		</form>
	</div>
	<div class="col-md-3">

		<div class="p-2">
			<button class="btn btn-success global_discount" id="<? echo $_GET['id'] ?>" data-toggle="modal" data-target="#global_discount"><? echo $lang['global_discount'] ?></button>
			<i data-toggle="modal" data-target="#global_discount_history" class="fas fa-history fa-lg"></i>
		</div>
	</div>
	<div class="col-md-3">

		<div class="p-2">
			<button class="btn btn-success copy_from_agent" id="<? echo $_GET['id'] ?>" data-toggle="modal" data-target="#copy_from_agent"><? echo $lang['copy_from_agent'] ?></button>
		</div>
	</div>
	<!-- <div class="col-md-3">

		<div class="p-2">
			<button class="btn btn-success history" id="<? echo $_GET['id'] ?>" data-toggle="modal" data-target="#history"><? echo $lang['history'] ?></button>
		</div>
	</div> -->
</div>
<?
if ($_POST['suppliersagent'] != 0)
	foreach ($_POST['suppliersagent'] as $id => $v) {
		$db->orwhere('c_id', $id);
	}
$suppliers = $db->get('suppliers');
$car_types = $db->orderBy('order_num', 'ASC')->get('car_types');

$prov_price = $db->get('provider_price');
$lsserv = array();
if (isset($_POST['serv_type'])) {
	foreach ($prov_price as $price) {
		$db_serv_type = explode(',', $price['serv_type']);
		foreach ($db_serv_type as $db_type)
			if (in_array($db_type, $_POST['serv_type'])) {
				$lsserv[] = $db_type;
			}
	}
}
$lsserv = array_unique($lsserv);
$test = array();
foreach ($lsserv as $ls) {
	$test[] = $db->where('c_id', $ls)->getOne('service_type');
}
if (isset($_POST['serv_type']))
	$service_type = $test;
else
	$service_type = $db->get('service_type');


$_POST['car_type'] = isset($_POST['car_type']) ? $_POST['car_type'] : array();
foreach ($_POST['car_type'] as $id => $v) {
	$db->orwhere('c_id', $id);
}
$car_types = $db->orderBy('order_num', 'asc')->get('car_types');

foreach ($car_types as $car) {
	if ($_POST['suppliersagent']) {
		$cartypecon = "(";
		$count = 0;
		$db2 = getDbInstance();
		if (!empty($_POST['suppliersagent'])) {
			foreach ($_POST['suppliersagent'] as $id => $v) {
				if ($cartypecon === "(")
					$cartypecon .= " `c_providerid` = $id ";
				else
					$cartypecon .= " OR `c_providerid` = $id ";
			}
		}

		$cartypecon .= ")";

		$_POST['car_type'] = isset($_POST['car_type']) ? $_POST['car_type'] : array();
		$firsttime = true;
		if (!empty($_POST['car_type'])) {
			$cartypecon .= " AND (";
			foreach ($_POST['car_type'] as $id => $v) {
				if ($firsttime)  $cartypecon .= "(car_type= $id) or (car_type LIKE  '%,$id,%') or (car_type LIKE '$id,%') or (car_type LIKE '%,$id') ";
				else $cartypecon .= " OR (car_type= $id) or (car_type LIKE  '%,$id,%') or (car_type LIKE '$id,%') or (car_type LIKE '%,$id') ";
				$firsttime = false;
			}
			$cartypecon .= ")";
		}
		$_POST['serv_type'] = isset($_POST['serv_type']) ? $_POST['serv_type'] : array();

		if (!empty($_POST['serv_type'])) {
			$cartypecon .= " AND (";
			$firsttime = true;
			$curid = "";
			foreach ($_POST['serv_type'] as $id => $v) {
				if ($firsttime) {
					$curid = $id;
					$cartypecon .= "(`serv_type`='$curid')";
				} else {
					$cartypecon .= " OR (`serv_type`='$id') ";
					$curid .= "," . $id;
				}
				$firsttime = false;
			}
			$cartypecon .= " OR `serv_type`='$curid'";
			$cartypecon .= ")";
		}

		$prods = $db2->rawQuery("SELECT * FROM `provider_price` WHERE " . $cartypecon);
	}
	if (isset($prods)) {
		foreach ($prods as $prod) {
			$prod['car_type'] = explode(',', $prod['car_type']);
			if (in_array($car['c_id'], $prod['car_type'])) {
				$count++;
			}
		}
	}
?>
	<div class="card">
		<div class="card-header" style="background-color: #E3E3E3; color:black;">
			<h6><? echo $car['c_name'] ?></h6>
		</div>
		<div class="card-body">
			<? if (isset($db2) and $db2->count > 0 and $count > 0) {
			?>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th></th>
							<th><? echo $lang['code'] ?></th>
							<? $services = $db->get('service_type');
							foreach ($services as $serv) { ?>
								<th><? echo $serv['short_name'] ?></th>
							<? }
							if (!STANDALONE) { ?>
								<th><? echo $lang['supplier'] ?></th>
							<? } ?>
							<th><? echo $lang['description'] ?></th>
							<th><? echo $lang['agent_price'] ?></th>
							<th><? echo $lang['price'] ?></th>
							<th><? echo $lang['history'] ?></th>
						</tr>
					</thead>
					<tbody>
						<?
						foreach ($prods as $prod) {
							if (isset($prod['c_id'])) {
								$prod['car_type'] = explode(',', $prod['car_type']);
								$prod_serv_type = explode(',', $prod['serv_type']);
								$agent = $db->where('prod_id', $prod['c_id'])->where('agent_id', $_GET['id'])->getOne('agent_price');
								if (in_array($car['c_id'], $prod['car_type'])) {
									$thissup = $db->where('c_id', $prod['c_providerid'])->getOne('suppliers');
						?>
									<tr id="tablerow<? echo $agent['c_id']; ?>" <? echo $agent['c_status'] == 1 ? "style='background-color:#dc3545;'" :  '' ?>>
										<td>
											<div class=" d-flex justify-content-center">
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="itemactiveswitch<?= $agent['c_id'] ?>" <?= $agent['c_status'] == 0 ? 'checked' : '' ?>>
													<label class="custom-control-label" for="itemactiveswitch<?= $agent['c_id'] ?>"></label>
												</div>
											</div>
										</td>
										<td data-target="#updateagentprodsub" data-toggle="modal" class="updateagentprodsub" id="<? echo $agent['c_id']; ?>"><? echo $prod['c_code'] ?></td>
										<? $services = $db->getValue('service_type', 'c_id', null);
										$arr = explode(',', $prod['serv_type']);
										foreach ($services as $one) {
											if (in_array($one, $arr)) {
										?>
												<td data-target="#updateagentprodsub" data-toggle="modal" class="updateagentprodsub" id="<? echo $agent['c_id']; ?>">
													<p>&#10004;</p>
												</td>
											<?
											} else {
											?>
												<td><? echo " "; ?></td>
											<?
											}
										}
										if (!STANDALONE) {
											?>
											<td data-target="#updateprodsub" class="upprod" data-toggle="modal" id="<? echo $prod['c_id']; ?>">
												<img style="max-width:50px; " src="<?= DATA_URL ?>/logo/<?= $thissup['logo'] ?>" alt="logo">
											</td>
										<? } ?>
										<td data-target="#updateagentprodsub" data-toggle="modal" class="updateagentprodsub" id="<? echo $agent['c_id']; ?>"><? echo $prod['description'] ?></td>
										<td data-target="#updateagentprodsub" data-toggle="modal" class="updateagentprodsub" id="<? echo $agent['c_id']; ?>"><? echo $agent['c_price'] ?> &#8362;</td>
										<td data-target="#updateagentprodsub" data-toggle="modal" class="updateagentprodsub" id="<? echo $agent['c_id']; ?>"><? echo !STANDALONE ? $prod['supplier_price'] : $prod['agent_price'] ?> &#8362;</td>
										<td>
											<div class="history_agent" data-target="#history_private" data-toggle="modal" id="<? echo $agent['c_id'] ?>">
												<i class="fas fa-history"></i>
											</div>
										</td>
									</tr>


						<?
								}
							}
						}
						?>
					</tbody>
				</table>
			<? } else { ?>
				<h6 class="text-center p-2"><? echo $lang['nodata'] ?></h6>

			<? } ?>
		</div>
	</div>


	<div class="modal fade" id="global_discount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="ageument">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="updateinvoice"><?php echo $lang['global_discount'] ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="global_discount_form" action="index.php?sec=agents&action=agentplus&id=<? echo $_GET['id'] ?>" method="POST">
						<input type="hidden" name="agent_id" id="agent_id_desc" value="<? echo $_GET['id'] ?>">
						<label for="precent_desc"><? echo $lang['precent_desc'] ?></label>
						<input type="tel" class="form-control" name="precent_desc" id="precent_desc">
						<div class="invbtn">
							<input class="btn btn-success" type="submit" value="<?php echo $lang['save'] ?>">
							<button type="button" id="close_add_prod" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close'] ?></button>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
	<div class="modal fade" id="global_discount_history" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="ageument" style="max-width: 1000px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="updateinvoice"><?php echo $lang['global_discount_history'] ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md"><strong><?= $lang['discount_precent'] ?></strong></div>
						<div class="col-md"><strong><?= $lang['user'] ?></strong></div>
						<div class="col-md"><strong><?= $lang['action_date'] ?></strong></div>
					</div>
					<hr>
					<?
					$history_precent = $db->where('agent_id', $_GET['id'])->where('precent_discount', 0, '>')->get('agent_price_history');
					foreach ($history_precent as $row) {
						$user_desc = $db->where($row['src'] == 'mang' ? 'id' : 'c_id', $row['c_userid'])->getOne($row['src'] == 'mang' ? 'users' : 'agents');
					?>
						<div class="row">
							<div class="col-md"><?= $row['precent_discount'] ?>%</div>
							<div class="col-md"><?= isset($user_desc['u_firstname']) ? $user_desc['u_firstname'] . " " . $user_desc['u_lastname'] : $user_desc['business_name'] ?></div>
							<div class="col-md"><?= $row['c_insertdate'] ?></div>
						</div>
						<hr>
					<?
					}
					?>
				</div>

			</div>
		</div>
	</div>
	<div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="ageument">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="updateinvoice"><?php echo $lang['history'] ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?
					$history = $db->where('agent_id', $_GET['id'])->orderBy('c_id', 'desc')->get('agent_price_history');
					foreach ($history as $h) {
					?>
						<div class="row">
							<div class="col-md-6"><? echo $h['price'] ?></div>
							<div class="col-md-6"><? echo $h['c_insertdate'] ?></div>
						</div>
						<hr>
					<?
					}
					?>

				</div>


			</div>
		</div>
	</div>
	<div class="modal fade" id="history_private" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="ageument" style="max-width: 1000px;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="updateinvoice"><?php echo $lang['history'] ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="private_history"></div>

				</div>


			</div>
		</div>
	</div>

	<div class="modal fade" id="copy_from_agent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="ageument">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="updateinvoice"><?php echo $lang['copy_from_agent'] ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="copy_from_agent_form" action="index.php?sec=agents&action=agentplus&id=<? echo $_GET['id'] ?>" method="POST">
						<input type="hidden" name="agent_id" id="agent_id_copy" value="<? echo $_GET['id'] ?>">
						<label for="precent_desc"><? echo $lang['precent_desc'] ?></label>
						<select name="copy_from_agent_select" id="copy_from_agent_select" class="form-control">
							<option value="0"><? echo $lang['choose_agent'] ?></option>
							<?
							$agents = $db->get('agents');
							foreach ($agents as $agent) {
								if ($agent['c_id'] != $_GET['id']) {
							?>
									<option value="<? echo $agent['c_id'] ?>"><? echo $agent['user_full_name'] ?></option>
							<?
								}
							}
							?>
						</select>
						<div class="invbtn">
							<input class="btn btn-success" type="submit" value="<?php echo $lang['save'] ?>">
							<button type="button" id="close_add_prod" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close'] ?></button>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>

<? } ?>