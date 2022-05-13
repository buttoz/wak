<button id="adddoc" type="button" class="btn btn-success" data-toggle="modal" data-target="#checkmodal">
    +
</button>
<div id="checktable">
    <table class="table table-bordered table-responsive-md">
        <thead>
            <tr>
                <th><?php echo $lang['description'] ?></th>
                <th><?php echo $lang['inserted_time'] ?></th>
            </tr>
        </thead>
        <tbody id="checkdata">

        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="checkmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="checkument">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateinvoice"><?php echo $lang['checks_tab'] ?></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="checkadd">
                    <input type="hidden" name="check_agent_id" id="check_agent_id" value="<? echo $user['c_id'] ?>">
                    <label><?php echo $lang['description']; ?></label><br>
                    <input type="text" class="form-control" id="check_description" name="check_description"><br>
                    <label for="am"><?php echo $lang['upload_check']; ?></label><br>
                    <input type="file" accept="image/*, .pdf" id="check_file" name="check_file"><br>


                    <div class="invbtn">
                        <input class="btn btn-success" type="submit" value="<?php echo $lang['save'] ?>">
                        <button type="button" id="closeivoice_check_add" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close'] ?></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="updatecheckmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="checkument">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateinvoice"><?php echo $lang['checks_tab'] ?></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">    
                <form id="updatecheck">
                    <input type="hidden" name="agent_idtoedit_check" id="agent_idtoedit_check" value="<? echo $user['c_id'] ?>">
                    <label><?php echo $lang['description']; ?></label><br>
                    <input type="text" class="form-control" id="check_descriptiontoedit" name="check_descriptiontoedit"><br>
                    <label for="am"><?php echo $lang['upload_check']; ?></label><br>
                    <input type="file" accept="image/*, .pdf" id="check_filetoedit" name="check_filetoedit"><br>
                    <input type="hidden" name="check_id" id="check_id" value="">
                    <div id="view_image">
                        <i class="fas fa-search fa-lg view_image_check"></i>
                    </div>
                    <div class="invbtn">
                        <input class="btn btn-success" type="submit" value="<?php echo $lang['save'] ?>">
                        <button type="button" id="closeivoiceecheck_edit" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close'] ?></button>
                        <button type="button" class="btn btn-danger deletecheck" data-dismiss="modal"><?php echo $lang['delete'] ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>