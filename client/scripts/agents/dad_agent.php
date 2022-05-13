<?
$db = getDbInstance();
$son_agents = $db->where('role', $_GET['id'])->get('agents');

?>

<table class="table table-bordered">
	<thead>
		<th><? echo $lang['id'] ?></th>
		<th><? echo $lang['agent'] ?></th>
	</thead>
	<tbody id="agent_son">
		<?
		foreach ($son_agents as $row) {
		?>
			<tr id="dadagenttr" style="color:#007bff; cursor: pointer;" onclick="window.location='<?php echo $index_path . '?sec=agents&action=agentplus&id=' . $row['c_id'] ?>'">
				<td><?= $row['c_id'] ?></td>	
				<td><?= $row['business_name'] ?></td>
			</tr>
		<?
		}

		?>
	</tbody>
</table>