<?php
require_once './languages/he.lang.php';
require_once './config/db/config.php';


use PhpOffice\PhpSpreadsheet\Reader\Xlsx;




if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    echo "<center><h6>loading</h6></center>";
    $form_data = filter_input_array(INPUT_POST);

    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    if (in_array($_FILES["file"]["type"], $allowedFileType)) {
        $time = date("d-m-Y") . "-" . time();
        $backoofice_path = dirname(__DIR__, 3);
        $targetPath = $backoofice_path . '/data/excels/' . $time . "-" . $_FILES['file']['name'];
        //            $targetPath = 'uploads/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);

        if (isset($_POST['checktitle']))
            $array_without_title = array_slice($spreadSheetAry, 1);
        else
            $array_without_title = $spreadSheetAry;
        $total_source_record_array = [];
        $exist_record_array = [];




        $data = array(
            "c_userid" => $_SESSION['client_id'],
            "c_insertdate" => date('Y-m-d H:i:s'),
            "c_ip" => getuserip(),
            "description" => $_POST['desc'],
            "client_id" => $_SESSION['client_id'],
            "file_name" => $time . "-" . $_FILES['file']['name'],
            "src" => 'client'
        );
        $import_id = $db->insert('import_history', $data);
        $counter = 0;
        foreach ($array_without_title as $exceldata) {

            if ($exceldata[0]) {
                $counter++;
                $db = getDbInstance();
                $data = array(
                    "c_insertdate" => date("Y-m-d H:i:s"),
                    "number" => $exceldata[0],
                    "import_id" => $import_id
                );
                $db->insert('import_customers', $data);
            }
            echo "<center>" . 'סה"כ לקוחות חדשים:' . $counter . "</center>";

            $path = pathUrl(__DIR__ . '/../../');
            redirect($path . 'index.php?sec=msg&action=import_customers');
        }
    }
}



?>


<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
            <div class="col-md-6">
                <h2>יבוא מוצרים</h2>
                <br>
                <div class="outer-container">
                    <form action="" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                        <div>
                            <div class="form-group">
                                <label>בחר קובץ אקסל</label>
                                <input class="form-control" type="file" name="file" id="file" accept=".xls,.xlsx" required>
                            </div>

                            <div class="form-check">

                                <input class="form-check-input" type="checkbox" checked name="checktitle" id="checktitle">
                                <label class="form-check-label">התעלם מהכותרת</label>
                            </div>
                            <br>
                            <div class="form-group">
                                <textarea name="desc" class="form-control" id="" required></textarea>
                            </div>
                            <div class="form-group">
                                <?/*?><button class="form-control btn btn-primary" type="submit" id="importBtn" name="import" class="btn-submit">Import</button><?*/ ?>
                                <input type="submit" name="import" class="btn btn-primary" value="<?= $lang['import'] ?>">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><?= $lang['history'] ?></div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><?= $lang['id'] ?></th>
                                    <th><?= $lang['date'] ?></th>
                                    <th><?= $lang['description'] ?></th>
                                    <th><?= $lang['user_name'] ?></th>
                                    <th><?= $lang['file'] ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                $db = getDbInstance();
                                $history = $db->get('import_history');
                                foreach ($history as $row) {
                                    if ($row['src'] == 'mang')
                                        $user = $db->where('id', $row['c_userid'])->getOne('users');
                                    else
                                        $user = $db->where('c_id', $row['client_id'])->getOne('agents');
                                ?>
                                    <tr>
                                        <td id="<?= $row['c_id'] ?>" class="load_file_id" data-toggle="modal" data-target="#del_row_modal"><?= $row['c_id'] ?></td>
                                        <td id="<?= $row['c_id'] ?>" class="load_file_id" data-toggle="modal" data-target="#del_row_modal"><?= $row['c_insertdate'] ?></td>
                                        <td id="<?= $row['c_id'] ?>" class="load_file_id" data-toggle="modal" data-target="#del_row_modal"><?= $row['description'] ?></td>
                                        <td id="<?= $row['c_id'] ?>" class="load_file_id" data-toggle="modal" data-target="#del_row_modal"><?= $user['a_firstname'] . " " . $user['a_lastname'] ?></td>
                                        <td id="<?= $row['file_name'] ?>" class="view_excel_file">
                                            <i class="fas fa-search fa-lg open_file_excel"></i>
                                        </td>
                                    </tr>
                                <?
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="del_row_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="ageument">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateinvoice"><?php echo $lang['del_import'] ?></h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form id="del_file_modal">
                                <input type="hidden" name="file_id" id="file_id">
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
        </div>
</div>
</section>

</div>