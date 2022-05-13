<button id="adddoc" type="button" class="btn btn-success" data-toggle="modal" data-target="#docmodal">
    +
</button>
<div id="doctable">
    <table class="table table-bordered table-responsive-md">
        <thead>
            <tr>
                <th><?php echo $lang['description'] ?></th>
                <th><?php echo $lang['inserted_time'] ?></th>
            </tr>
        </thead>
        <tbody id="docdata">


        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="docmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateinvoice"><?php echo $lang['add_doc'] ?></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="docadd">
                    <input type="hidden" name="doc_agent_id" id="doc_agent_id" value="<? echo $user['c_id'] ?>">
                    <label><?php echo $lang['description']; ?></label><br>
                    <input type="text" class="form-control" id="doc_description" name="doc_description"><br>
                    <label for="am"><?php echo $lang['upload_doc']; ?></label><br>
                    <input type="file" accept="image/*, .pdf" id="doc_file" name="doc_file"><br>


                    <div class="invbtn">
                        <input class="btn btn-success" type="submit" value="<?php echo $lang['save'] ?>">
                        <button type="button" id="closeivoice_doc_add" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close'] ?></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="updatedocmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="updateinvoice"><?php echo $lang['update_doc'] ?></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updatedoc">
                    <input type="hidden" name="agent_idtoedit_doc" id="agent_idtoedit_doc" value="<? echo $user['c_id'] ?>">
                    <label><?php echo $lang['description']; ?></label><br>
                    <input type="text" class="form-control" id="doc_descriptiontoedit" name="doc_descriptiontoedit"><br>
                    <label for="am"><?php echo $lang['upload_doc']; ?></label><br>
                    <input type="file" accept="image/*, .pdf" id="doc_filetoedit" name="doc_filetoedit"><br>
                    <input type="hidden" name="doc_id" id="doc_id" value="">
                    <div id="view_image">
                        <i class="fas fa-search fa-lg view_image_doc"></i>
                    </div>
                    <div class="invbtn">
                        <input class="btn btn-success" type="submit" value="<?php echo $lang['save'] ?>">
                        <button type="button" id="closeivoiceedoc_edit" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close'] ?></button>
                        <button type="button" class="btn btn-danger deletedoc" data-dismiss="modal"><?php echo $lang['delete'] ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>