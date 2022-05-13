<?
$db = getDbInstance();

$payhistory = $db->where('agent_id', $_GET['id'])->get('agent_pay');

?>
<br>
<table class="table table-bordered updatesubtable">
	<thead>
		<tr>
			<th><? echo $lang['id'] ?></th>
			<th><? echo $lang['add_date'] ?></th>
			<th><? echo $lang['invoicing_num'] ?></th>
			<th><? echo $lang['sum'] ?></th>
			<th><? echo $lang['paydate'] ?></th>
			<th><? echo $lang['stat'] ?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?
		foreach ($payhistory as $row) {
		?>
			<tr>
				<td><?= $row['c_id'] ?></td>
				<td><?= $row['c_insertdate'] ?></td>
				<td><?= $row['invoice_num'] ?></td>
				<td><?= $row['total'] ?></td>
				<td><?= $row['paydate'] ?></td>
				<td><?= $lang[$row['c_status']] ?></td>
				<td id="<?= $row['c_id'] ?>" class="delpayment" data-toggle="modal" data-target="#del_row_modal"><i class="fas fa-times"></i></td>
				<? if ($row['invoce_file'] != '') { ?>
					<td style="cursor: pointer;" onclick="window.open('<?= DATA_URL ?>/invoice/<?= $row['invoce_file'] ?>','_blank')"><i class="fas fa-search fa-lg"></i></td>
				<? } else {
				?><td></td><?
						} ?>
			</tr>
		<?
		}

		?>
	</tbody>
</table>

<div class="modal fade" id="del_row_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="ageument">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="updateinvoice"><?php echo $lang['del_payment'] ?></h5>

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<form id="del_pay_modal">
					<input type="hidden" name="pay_id" id="pay_id">
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