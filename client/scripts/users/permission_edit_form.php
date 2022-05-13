
    <fieldset>
        <label for="profile_list"> <? echo $lang['choose_profile'] ?></label>
        <div class="row">
            <div class="col-md-2">
                <input type="hidden" name="id" value="<?echo $_GET['id']?>">
                <select name="profile_list" class="form-control" id="profile_list" onchange="submit()">
                    <option value="0">---<? echo $lang['my_permission']; ?>---</option>
                    <?
                    $db = getDbInstance();
                    $user_profile_id = $db->where('id', $_GET['id'])->getOne('users');
                    $profiles = $db->get('profile_group');
                    foreach ($profiles as $profile) { 
                    ?>

                        <option value="<? echo $profile['id']; ?>" <? echo ((isset($_POST['profile_list'])) and ($_POST['profile_list'] == $profile['id'])) ? 'selected' : ''; ?>><? echo $profile['description'] ?></option>
                    <?
                    }
                    ?>
                </select>


            </div>
        </div>

        <?

        $id = $_GET['id'];
        $db = getDbInstance();
        $permissions = $db->get('permission_define');
        if (!isset($_POST['profile_list']))
            $_POST['profile_list'] = 0;
        foreach ($permissions as $permission) {
            $db2 = getDbInstance();

            $per_id = $db2->where('user_id', $_GET['id'])->where('permissionid', $permission['id'])->getOne('permission_user');
            $profile_id = $db2->where('groupid', $_POST['profile_list'])->where('permissionid', $permission['id'])->getOne('permission_group');
            if (($_POST['profile_list'] == 0 and $per_id) or $profile_id)
                $flag = true;
            else
                $flag = false;
        ?>
            <div class="row">
                <div class="col-md-10">
                    <label for="<? echo $permission['description'] ?>"><? echo $permission['description'] ?></label>
                </div>
                <div class="col-md-2">
                    <input type="checkbox" name="<? echo $permission['id'] ?>" id="<? echo $permission['id'] ?>" <? echo $flag ? 'checked' : '' ?>>
                </div>
            </div>
            <hr>
        <? } ?>
        <div class="col-md-2">
            <div class="inv-btn" style="padding: 1em;">
                <input type="submit" id="btn_add" name="btn_add" class="btn btn-success btn-block" value="<? echo $lang['save'] ?>">
            </div>
        </div>
    </fieldset>
