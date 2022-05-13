<div class="content-wrapper">

	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card">

							<!-- /.card-header -->
							<div class="card-body">
								<table id="example1" class="table table-bordered">
									<thead>
										<tr>
											<th><?php echo $lang['agent'] ?></th>
											<th><?php echo $lang['agents_online'] ?></th>
											<th><?php echo $lang['agent_user_online'] ?></th>
										</tr>
									</thead>
									<tbody>
										<?
										$db = getDbInstance();
										$agents = $db->get('agents');
										foreach ($agents as $row) {
											$agent_count = $db->where('src', 'agent')->where('agent_id', $row['c_id'])->get('user_online');
											$user_count = $db->where('src', 'agent_user')->where('agent_for', $row['c_id'])->get('user_online');
											if (count($agent_count) > 0 or count($user_count) > 0) {
										?>
												<tr>
													<td><?= isset($row['role']) ?  $row['business_name'] : '' ?></td>
													<td><?= count($agent_count) ?></td>
													<td><?= count($user_count) ?></td>
												</tr>
										<?
											}
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