<fieldset>
    <?
    $id = $_GET['id'];
    $db = getDbInstance();
    $depts = $db->orderBy('ord', 'ASC')->get('deparment_define');
    foreach ($depts as $dept) {
        $db2 = getDbInstance();
        //!
        //? all deparments the user is in
        $dept_id = $db2->where('user_id', $_GET['id'])->where('deptid', $dept['id'])->getOne('deparment_user');


        if (($dept_id) and ($dept_id['deptid'] == $dept['id']))
            $flag = true;
        else
            $flag = false;

    ?>
        <div class="row">
            <div class="col-md-10">
                <label for="<? echo $dept['description'] ?>"><? echo $dept['description'] ?></label>
            </div>
            <div class="col-md-2">
                <input type="checkbox" name="<? echo $dept['id'] ?>" id="<? echo $dept['id'] ?>" <? echo $flag ? 'checked' : '' ?>>
            </div>
        </div>
        <hr>
    <? } ?>
    <div class="col-md-2">
        <div class="inv-btn" style="padding: 1em;">
            <input type="submit" id="dept_add" name="dept_add" class="btn btn-success btn-block" value="<? echo $lang['save'] ?>">
        </div>
    </div>
</fieldset>