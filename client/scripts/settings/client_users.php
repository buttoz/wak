<table id="contractor" class="table table-bordered">
	<thead>
		<tr>
			<th><?php echo $lang['id'] ?></th>
			<th><?php echo $lang['business_name'] ?></th>
			<th><?php echo $lang['agent_umbrella'] ?></th>
			<th><?php echo $lang['phone'] ?></th>
			<th><?php echo $lang['fax_number'] ?></th>
			<th><?php echo $lang['marketer'] ?></th>
			<th><?php echo $lang['active_agent'] ?></th>
			<th><?php echo $lang['subnum'] ?></th>
			<th><?php echo $lang['account_confirmation'] ?></th>
			<th><?php echo $lang['status'] ?></th>

		</tr>
	</thead>
	<tbody>
		<?php



		$users = $db->where('client', $_GET['id'])->where('role', 0)->get('agents');

		foreach ($users as $user) {
			if ((isset($_POST['marketerselect'])) and ($_POST['marketerselect'] != 0))
				$db->where('marketer', $_POST['marketerselect']);
			$agents =  $db->where('role', $_GET['id'])->get('agents');
			array_unshift($agents, $user);
			foreach ($agents as $row) {
		?>

				<tr <?php echo $row['c_status'] == 1 ? 'style="color:#ff0000;font-weight:bold"' : "" ?> onclick="window.location='<?php echo $index_path . '?sec=agents&action=agentplus&id=' . $row['c_id'] ?>'">
					<td>
						<?php echo $row['c_id'] ?>
					</td>
					<td>
						<?php echo $row['business_name'] ?>
					</td>
					<td>
						<?= $row['role'] == 0 ? '' : $user['business_name'] ?>
					</td>


					<td>
						<?php echo $row['a_mobile'] ?>
					</td>
					<td>
						<?php echo 0 ?>
					</td>
					<td>
						<?php
						$name = $db->where('c_id', $row['marketer'])->getOne('marketer');
						if (isset($name))
							echo $name['business_name'];
						else {
							echo $lang['notset'];
						} ?>
					</td>
					<td>
						<?php
						$count = $db->where('c_agentid', $row['c_id'])->where('c_status', 0)->get('polisa');
						echo count($count) ?>
					</td>
					<td>
						<?php
						$count = $db->where('c_agentid', $row['c_id'])->where('c_status', 0)->get('polisa');
						echo count($count) ?>
					</td>
					<? $db->where('id_agent', $row['c_id'])->getOne('agent_checks'); ?>
					<td> <?= $db->count > 0 ? $lang['yes1'] : $lang['no1'] ?> </td>
					<td class="datetime">
						<?php //echo $row['a_lastlogin'] == '0000-00-00 00:00:00' ? '0000-00-00 00:00:00' : date_format($date,"Y/m/d H:i");
						echo $row['c_status'] == 0 ? $lang['active'] : ($row['c_status'] == 1 ? $lang['awaiting_inactive'] : ($row['c_status'] == 2 ? $lang['close'] : ''));
						?>
					</td>

				</tr>
		<?php
			}
		}
		?>
	</tbody>
</table>