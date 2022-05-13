<div class="content-wrapper">
	<?

	$backoofice_path = dirname(__DIR__, 3);
	require_once "$backoofice_path/schedule/shagrir_used.php";
	require_once "$backoofice_path/schedule/suppliers_reported.php";
	require_once "$backoofice_path/schedule/suppliers_used_update.php";
	?>
	<section class="content">
		<div class="container-fluid">
			<div class="col-md-6"></div>

			<div class="card">
				<div class="card-header"><?= $lang['dailyreports'] ?></div>
				<div class="card-body">
					<form action="index.php?sec=excel&action=dailyreports" method="POST">
						<div class="row d-flex align-items-center">
							<div class="col-md-2 ">
								<select name="sup_select_report" id="sup_select_report" class="form-control" onchange="submit()">

									<option value="0" <?= !isset($_POST['sup_select_report'])  ? $_POST['sup_select_report'] = 0 : '' ?>><?= $lang['all'] ?></option>
									<?
									$db = getDbInstance();
									$supps = $db->where('report_type', 0)->get('suppliers');
									foreach ($supps as $row) {
									?>
										<option value="<?= $row['c_id'] ?>" <?= (isset($_POST['sup_select_report']) and $_POST['sup_select_report'] == $row['c_id']) ? 'selected' : '' ?>><?= $row['business_name'] ?></option>
									<?
									}

									?>
								</select>
							</div>
							<div class="col-md">
								<?
								if (isset($_POST['sup_select_report']) and $_POST['sup_select_report'] != 0)
									$db->where('providerid', $_POST['sup_select_report']);
								$db->where('reported', 0)->get('items_to_report');
								echo 'סה"כ כיסויים טרם דיווחו : ' . $db->count;
								?>
							</div>
						</div>
					</form>
					<br>
					<div class="row">
						<div class="col-md">
							<button id="send_report_all_supps" class="btn btn-primary" <?= $db->count == 0 ? 'disabled' : '' ?>><?= $lang['send_report'] ?></button>
						</div>
					</div>
					<br>
					<table class="table table-bordered updatesubtable">
						<thead>
							<tr>
								<th><? echo $lang['id'] ?></th>
								<th><? echo $lang['supplier'] ?></th>
								<th><? echo $lang['email'] ?></th>
								<th><? echo $lang['report_date'] ?></th>
								<!-- <th><? echo $lang['polisa_today'] ?></th>
								<th><? echo $lang['all_canceled'] ?></th>
								<th><? echo $lang['all_changed'] ?></th> -->
								<th><? echo $lang['total_entries'] ?></th>
								<th><? echo $lang['total_renews'] ?></th>
								<th><? echo $lang['total_new_subs'] ?></th>
								<th><? echo $lang['total_changes'] ?></th>
								<th><? echo $lang['total_canceled'] ?></th>
								<th><? echo $lang['download'] ?></th>
							</tr>
						</thead>
						<tbody>
							<?
							$item = array();

							unset($db);
							$db = getDbInstance();
							if ($_POST['sup_select_report'] == 0) {
								if (count($supps) > 1)
									foreach ($supps as $row) {
										$test = $db->orwhere('company', $row['c_id'])->orderBy('id', 'DESC')->getOne('sup_reported_daily');
										if (!empty($test))
											$arr[] = $test;
									}
								else {
									foreach ($supps as $row) {
										$test = $db->where('company', $row['c_id'])->orderBy('id', 'DESC')->get('sup_reported_daily', 10);
										$arr = $test;
									}
								}
							} elseif ($_POST['sup_select_report'] > 0)
								$arr = $db->where('company', $_POST['sup_select_report'])->orderBy('id', 'DESC')->get('sup_reported_daily');
							if ($db->count > 0)
								foreach ($arr as $row) {
									$supp = $db->where('c_id', $row['company'])->getOne('suppliers');
							?>
								<tr>
									<td><?= $row['id'] ?></td>
									<td> <img style="width: 130px;" src="<?= DATA_URL ?>/logo/<?= $supp['logo'] ?>" alt="logo">
									</td>
									<td><?= $row['email'] ?></td>
									<td><?= $row['insdate'] ?></td>
									<td><?= $row['total'] ?> </td>
									<td> <?= $row['total_renew'] ?></td>
									<td><?= $row['total_new'] ?> </td>
									<td> <?= $row['total_car'] ?></td>
									<td> <?= $row['total_cancel'] ?></td>
									<!-- <td> </td>
									<td> </td>
									<td> </td> -->
									<td><a href="<?= DATA_URL ?>/reports/<?= $row['file'] ?>" download="<?= $row['file'] ?>"><i class="fas fa-download"></i>
										</a></td>
									<td><? if (!STANDALONE) { ?>
											<button type="button" id="resend<?= $row['id'] ?>" class="btn btn-primary"><?= $lang['send'] ?></button></i>
										<? } ?>
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
	</section>
</div>