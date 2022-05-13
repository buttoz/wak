<button id="addinsurance" type="button" class="btn btn-success" data-toggle="modal" data-target="#agent_usercreateModal" onclick="document.getElementById('agent_user_id').value = 0">
    +
</button>
<div id="agent_users_table">
    <table class="table table-bordered table-responsive-md">
        <thead>
            <tr>
                <th><?php echo $lang['full_name'] ?></th>
                <th><?php echo $lang['phone'] ?></th>
                <th><?php echo $lang['email'] ?></th>
                <th><?php echo $lang['last_login'] ?></th>
                <th><?php echo $lang['action_date'] ?></th>
            </tr>
        </thead>
        <tbody id="agent_users_data">


        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="agent_usercreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateinvoice"><?php echo $lang['add_new_user'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="agent_user_submit">
                    <div class="row">
                        <div class="col-md">
                            <input type="hidden" name="user_agent_id" id="user_agent_id" value="<? echo $user['c_id'] ?>">
                            <label><?php echo $lang['user_name']; ?></label><br>
                            <input type="text" class="form-control" id="user_name" name="user_name">
                            <p class="agent_user_name_user"><?php echo $lang['user_exists'] ?></p>
                            <br>
                            <label><?php echo $lang['full_name']; ?></label><br>
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="<?php echo $lang['full_name'] ?>"><br>

                            <label><?php echo $lang['mobile_number']; ?></label><br>
                            <input type="tel" class="form-control" id="mobile_number" name="mobile_number" placeholder="<?php echo htmlspecialchars($lang['mobile_number']); ?>"><br>

                            <div id="agentuseremail" class="useremail">
                                <label><?php echo $lang['email']; ?></label><br>
                                <input type="text" class="form-control" id="email" name="email" placeholder="<?php echo htmlspecialchars($lang['email']); ?>">
                                <p class="emailerror"><?php echo $lang['email_exists'] ?></p>

                            </div>
                            <br>
                            <label for="passwd"><?php echo $lang['password'] ?></label>
                            <input type="password" autocomplete="off" class="form-control" placeholder="<?PHP echo $lang['password'] ?>" name="passwd" id="password">
                        </div>
                        <div class="col-md" style="margin-right:1em;">
                            <h6><?= $lang['permissions'] ?></h6>
                            <div class="d-flex flex-column">
                                <?
                                $permissions = $db->get('permission_define_agent');
                                foreach ($permissions as $permission) {
                                    $db2 = getDbInstance();
                                    $per_id = $db2->where('user_id', $_GET['id'])->where('permissionid', $permission['id'])->getOne('permission_agent');
                                ?>
                                    <div class="item">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="<? echo $permission['id'] ?>" id="userpercheck<? echo $permission['key_id'] ?>" <?= $permission['key_id'] == 'addsub' ? 'checked' : '' ?>>
                                            <span class="form-check-sign">
                                                <?= $permission['description'] ?>
                                            </span>
                                        </label>
                                    </div>
                                <? } ?>
                            </div>
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


<div class="modal fade" id="updateagent_users" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateinvoice"><?php echo $lang['update_user'] ?></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update_agent_users">
                    <div class="row">
                        <div class="col-md">

                            <input type="hidden" name="agent_user_id" id="current_user_to_edit" value="">
                            <input type="hidden" name="agent_id" id="agent_id_user" value="">
                            <label><?php echo $lang['user_name']; ?></label><br>
                            <input type="text" class="form-control" id="user_name_toedit" name="user_name_toedit">
                            <p class="agent_user_name_user" id="showhide"><?php echo $lang['user_exists'] ?></p>
                            <br>

                            <label><?php echo $lang['full_name']; ?></label><br>
                            <input type="text" class="form-control" id="full_name_toedit" name="full_name_toedit" placeholder="<?php echo $lang['full_name'] ?>"><br>

                            <label><?php echo $lang['mobile_number']; ?></label><br>
                            <input type="tel" class="form-control" id="mobile_number_toedit" name="mobile_number_toedit" placeholder="<?php echo htmlspecialchars($lang['mobile_number']); ?>"><br>
                            <div id="agentuseremail" class="useremail">
                                <label><?php echo $lang['email']; ?></label><br>
                                <input type="text" class="form-control" id="email_toedit" name="email_toedit" placeholder="<?php echo htmlspecialchars($lang['email']); ?>"><br>
                                <p class="emailerror"><?php echo $lang['email_exists'] ?></p>
                            </div>
                            <label for="passwd"><?php echo $lang['password'] ?></label>
                            <input type="password" autocomplete="off" id="passwd_to_edit" class="form-control" placeholder="<?PHP echo $lang['password'] ?>" name="passwd_to_edit">
                            <br>
                            <label for="active_inactive">OTP</label><br>
                            <input id="active_inactive_otp" name="active_inactive" type="checkbox" data-toggle="toggle" data-on="<?php echo $lang['active'] ?>" data-off="<?php echo $lang['inactive'] ?>" data-onstyle="success" data-offstyle="danger" <?= $user['otp'] == 0 ? 'checked' : '' ?>>
                        </div>
                        <div class="col-md" style="margin-right:1em;">
                            <h6><?= $lang['permissions'] ?></h6>
                            <div class="d-flex flex-column">
                                <?
                                $permissions = $db->get('permission_define_agent');
                                foreach ($permissions as $permission) {
                                    $db2 = getDbInstance();
                                    $per_id = $db2->where('user_id', $_GET['id'])->where('permissionid', $permission['id'])->getOne('permission_agent');
                                    if ($per_id)
                                        $flag = true;
                                    else
                                        $flag = false;
                                ?>
                                    <div class="item">
                                        <label class="form-check-label">
                                            <input class="form-check-input" <?= $flag ? 'checked' : '' ?> type="checkbox" name="<? echo $permission['id'] ?>" id="userpercheck2<? echo $permission['id'] ?>" <?= $per_id ? 'checked' : '' ?>>
                                            <span class="form-check-sign">
                                                <?= $permission['description'] ?>
                                            </span>
                                        </label>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="invbtn">
                        <input class="btn btn-success" type="submit" value="<?php echo $lang['save'] ?>">
                        <button type="button" id="closeivoiceedit" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close'] ?></button>
                        <button type="button" class="btn btn-danger deleteuser" data-dismiss="modal"><?php echo $lang['delete'] ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>