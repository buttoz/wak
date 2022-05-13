<?php

// if (!have_permission('agent_list')) {
//     // show permission denied message
//     echo '<div class="permissiondenied">Permission Denied</div>';
//     exit();
// }

$db = getDbInstance();



$backofficedir = pathUrl(__DIR__ . '/../../');
$index_path = $backofficedir . 'index.php';


?>

<div class="content-wrapper">

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">

						<!-- /.card-header -->
						<div class="card-body">
							<div class="col-md-2 p-2">
								<a class="btn btn-block btn-success" href="<?php echo $index_path . '?sec=settings&action=addclient' ?>">+ <?php echo $lang['add_new_client'] ?></a>
							</div>
							<br>
							<table id="contractor" class="table table-bordered">
								<thead>
									<tr>
										<th><?php echo $lang['id'] ?></th>
										<th><?php echo $lang['business_name'] ?></th>
										<th><?php echo $lang['phone'] ?></th>
										<th><?php echo $lang['status'] ?></th>

									</tr>
								</thead>
								<tbody>
									<?php

									$users = $db->get('clients');

									foreach ($users as $row) {
									?>

										<tr <?php echo $row['c_status'] == 1 ? 'style="color:#ff0000;font-weight:bold"' : "" ?> onclick="window.location='<?php echo $index_path . '?sec=settings&action=client_plus&id=' . $row['c_id'] ?>'">
											<td>
												<?php echo $row['c_id'] ?>
											</td>
											<td>
												<?php echo $row['business_name'] ?>
											</td>

											<td>
												<?php echo $row['business_tel'] ?>
											</td>
											<td class="datetime">
												<?php
												echo $row['c_status'] == 0 ? $lang['active'] : ($row['c_status'] == 1 ? $lang['inactive'] : '');
												?>
											</td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

</div>