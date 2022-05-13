
<label for="marketer"><? echo $lang['marketers'] ?></label>
<select name="marketer" id="marketer" class="form-control">
	<option value="0"><? echo $lang['choose_marketer'] ?></option>
	<?
	$db = getDbInstance();
	$marketers = $db->get('marketer');
	$agent = $db->where('c_id', $_GET['id'])->getOne('agents');
	foreach ($marketers as $market) {
	?>
		<option value="<? echo $market['c_id'] ?>" <? echo $market['c_id'] == $agent['marketer'] ? 'selected' : '' ?>><? echo $market['business_name'] ?></option>
	<?
	}
	?>
</select>
<br>
<table class="table table-bordered">
	<thead>
		<th><? echo $lang['id'] ?></th>
		<th><? echo $lang['marketer'] ?></th>
		<th><? echo $lang['date'] ?></th>
	</thead>
	<tbody id="historydata">
	</tbody>
</table>