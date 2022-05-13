<button id="addinsurance" type="button" class="btn btn-success" data-toggle="modal" data-target="#Agreementsmodal">
    +
</button>
<div id="Agreementstable">
    <table class="table table-bordered table-responsive-md">
        <thead>
            <tr>
                <th><?php echo $lang['description'] ?></th>
                <th><?php echo $lang['inserted_time'] ?></th>
            </tr>
        </thead>
        <tbody id="agreementsdata">


        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="Agreementsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateinvoice"><?php echo $lang['add_Agreements'] ?></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="Agreementsadd">
                    <input type="hidden" name="client_id" id="client_id_agree" value="<? echo $_GET['id'] ?>">
                    <label><?php echo $lang['description']; ?></label><br>
                    <input type="text" class="form-control" id="description_agree" name="description"><br>
                    <label for="am"><?php echo $lang['upload_agree_doc']; ?></label><br>
                    <input type="file" accept="image/*, .pdf" id="file_agree" name="file"><br>


                    <div class="invbtn">
                        <input class="btn btn-success" type="submit" value="<?php echo $lang['save'] ?>">
                        <button type="button" id="closeivoice_agree_add" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close'] ?></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="updateagreementsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateinvoice"><?php echo $lang['agree_update'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateagreements">
                    <input type="hidden" name="client_idtoedit_agree" id="client_idtoedit_agree" value="<? echo $_GET['id'] ?>">
                    <label><?php echo $lang['description']; ?></label><br>
                    <input type="text" class="form-control" id="descriptiontoedit_agree" name="descriptiontoedit_agree"><br>
                    <label for="am"><?php echo $lang['upload_agree_doc']; ?></label><br>
                    <input type="file" accept="image/*, .pdf" id="filetoedit_agree" name="filetoedit"><br>
                    <input type="hidden" name="agree_id" id="agree_id" value="">
                    <div id="view_image">
                        <i class="fas fa-search fa-lg view_image_agree"></i>
                    </div>
                    <div class="invbtn">
                        <input class="btn btn-success" type="submit" value="<?php echo $lang['save'] ?>">
                        <button type="button" id="closeivoiceeedit" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close'] ?></button>
                        <button type="button" class="btn btn-danger deleteagree" data-dismiss="modal"><?php echo $lang['delete'] ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>