<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-10 offset-md-1">
				<div class="card">
					<div class="card-body">
						<button type="button" style="max-width: 120px;" class="btn btn-block btn-success" data-target="#add_build" data-toggle="modal">+הוסף ספק</button>
						<br>
						<br>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th><?= $lang['supplier_name'] ?></th>
									<th><?= $lang['build_name'] ?></th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<? $func = $db->get('import_func');

								foreach ($func as $row) {
								?>
									<tr>
										<td><?= $row['business_name'] ?></td>
										<td><?= $row['func_name'] ?></td>
										<td><i onclick="del_build(this.id)" id="<?= $row['c_id'] ?>" class="fas fa-times"></i></td>
										<td><i onclick="build_single_data(this.id)" id="<?= $row['c_id'] ?>" data-target="#update_build" data-toggle="modal" class="fas fa-pen"></i></td>
									</tr>
								<?
								} ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="modal fade" id="add_build" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="ageument">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="updateinvoice">הוסף ספק</h5>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<form id="add_system_build_form">
						<div class="row">
							<div class="col-md">
								<label for="business_name"><?= $lang['supplier_name'] ?></label>
								<input type="text" name="business_name" id="business_name" class="form-control" required>
							</div>
							<div class="col-md">
								<label for="build_name"><?= $lang['build_name'] ?></label>
								<input type="text" name="build_name" id="build_name" class="form-control" required>
							</div>
						</div>
						<div class="invbtn">
							<input class="btn btn-success" type="submit" value="<?php echo $lang['save'] ?>">
							<button type="button" id="closeivoice" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close'] ?></button>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
	<div class="modal fade" id="update_build" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="ageument">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="updateinvoice">עדכן ספק</h5>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<form id="update_system_build_form">
					<input type="hidden" name="build_id" id="build_id">

						<div class="row">
							<div class="col-md">
								<label for="business_name"><?= $lang['supplier_name'] ?></label>
								<input type="text" name="business_name" id="business_name" class="form-control" required>
							</div>
							<div class="col-md">
								<label for="build_name"><?= $lang['build_name'] ?></label>
								<input type="text" name="build_name" id="build_name" class="form-control" required>
							</div>
						</div>
						<div class="invbtn">
							<input class="btn btn-success" type="submit" value="<?php echo $lang['save'] ?>">
							<button type="button" id="closeivoice" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close'] ?></button>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>