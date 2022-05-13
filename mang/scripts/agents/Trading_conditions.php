



<button id="addinsurance" type="button" class="btn btn-success" data-toggle="modal" data-target="#Tradingsmodal">
    +
</button>
<div id="Tradingstable">
    <table class="table table-bordered table-responsive-md">
        <thead>
            <tr>
                <th><?php echo $lang['description'] ?></th>
                <th><?php echo $lang['inserted_time'] ?></th>
            </tr>
        </thead>
        <tbody id="Tradingsdata">


        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="Tradingsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateinvoice"><?php echo $lang['add_Tradings'] ?></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="Tradingsadd">
                    <input type="hidden" name="agent_id" id="agent_id" value="<? echo $user['c_id'] ?>">
                    <label><?php echo $lang['description']; ?></label><br>
                    <input type="text" class="form-control" id="description" name="description"><br>
                    <label for="am"><?php echo $lang['add_Tradings']; ?></label><br>
                    <input type="file" accept="image/*, .pdf" id="file" name="file"><br>


                    <div class="invbtn">
                        <input class="btn btn-success" type="submit" value="<?php echo $lang['save'] ?>">
                        <button type="button" id="closeivoice_Trading_add" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close'] ?></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="updateTradingsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateinvoice"><?php echo $lang['Trading_update'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateTradings">
                    <input type="hidden" name="agent_idtoedit" id="agent_idtoedit" value="<? echo $user['c_id'] ?>">
                    <label><?php echo $lang['description']; ?></label><br>
                    <input type="text" class="form-control" id="descriptiontoedit" name="descriptiontoedit"><br>
                    <label for="am"><?php echo $lang['add_Tradings']; ?></label><br>
                    <input type="file" accept="image/*, .pdf" id="filetoedit" name="filetoedit"><br>
                    <input type="hidden" name="Trading_id" id="Trading_id" value="">
                    <div id="view_image">
                        <i class="fas fa-search fa-lg view_image_Trading"></i>
                    </div>
                    <div class="invbtn">
                        <input class="btn btn-success" type="submit" value="<?php echo $lang['save'] ?>">
                        <button type="button" id="closeivoiceeedit_trading" class="btn btn-secondary" data-dismiss="modal"><?php echo $lang['close'] ?></button>
                        <button type="button" class="btn btn-danger deleteTrading" data-dismiss="modal"><?php echo $lang['delete'] ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>