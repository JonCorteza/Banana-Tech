<?php include_once('layout/head.php'); ?>
<?php $title = 'RFID'; ?>
    <!-- Left Panel -->

    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <strong class="card-title">
                            <?= strtoupper($title . 's'); ?>
                        </strong>

                    </div>

                    <div class="card-body">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>User No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Plate No.</th>
                                <th>Card Type</th>
                                <th>RFID No.</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $result = my_query("SELECT *,CONCAT(fname, ' ', lname)name  FROM tbl_users ORDER BY id DESC  ");
                            for ($i = 1; $row = $result->fetch(); $i++) {
                                $id = $row['id']; ?>
                                <tr>
                                    <td><?= $row['userNo']; ?></td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                    <td><?= $row['contact']; ?></td>
                                    <td><?= $row['plate_no']; ?></td>
                                    <td><?= $row['card_type']; ?></td>
                                    <td><?= $row['rfidno']; ?></td>
                                    <td><?= $row['balance_amount']; ?></td>
                                    <td><?= $row['status']; ?></td>

                                    <td>
                                        <a title="Edit" class="btn right btn-warning waves-effect waves-light yellow darken-4 "
                                           data-toggle="modal" data-target="#edit<?= $id; ?>">
                                            <i class="fa fa-edit"> Edit </i>
                                        </a>
                                        <a title="Edit" class="btn right btn-info waves-effect waves-light yellow darken-4 "
                                           data-toggle="modal" data-target="#addbalance<?= $id; ?>">
                                            <i class="fa fa-plus"> Balance </i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
    </div><!-- .content -->


<?php
$result = my_query("SELECT *  FROM tbl_users   ");
for ($i = 1; $row = $result->fetch(); $i++) {
    $id = $row['id']; ?>

    <!-- Edit -->
    <div class="modal fade" id="edit<?= $id; ?>" role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Edit <?= $title; ?></h4>
                </div>
                <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id; ?>">

                    <div class="modal-body">

                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Card Type </label>
                                    <select name="card_type"  class="form-control" required>
                                        <option></option>
                                        <?php      $res = my_query("SELECT * FROM tbl_constants WHERE category='Card'");
                                        for($ix=1; $r = $res->fetch(); $ix++){  ?>
                                            <option  <?= (($r['value']==$row['card_type']) ?   'selected' : ''   ); ?>  ><?=$r['value'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Plate No. </label>
                                    <input name="plate_no" value="<?= $row['plate_no']; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">RFID No.  <?=($row['rfidno']=='' ?   'Register this RFID?' :'');  ?> </label>
                                    <input name="rfidno" value="<?=($row['rfidno']=='' ?  db_get_result('tbl_constants', 'value', ['category' => 'RFID']) : $row['rfidno']);  ?> " type="text" class="form-control"  >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Balance Amount</label>
                                    <input name="balance_amount" value="<?= $row['balance_amount']; ?>" type="number" class="form-control">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="IU<?=$title;?>" name="func_param" class="btn btn-warning waves-effect">
                            UPDATE
                        </button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addbalance<?= $id; ?>" role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Add Balance</h4>
                </div>
                <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id; ?>">

                    <div class="modal-body">


                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Balance Amount</label>
                                    <input name="balance_amount" value="<?= $row['balance_amount']; ?>" type="number" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Add Amount</label>
                                    <input name="balance_amount_add"   type="number" class="form-control" required>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="addBalance" name="func_param" class="btn btn-warning waves-effect">
                            UPDATE
                        </button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 
<?php } ?>


<?php include_once('layout/footer.php'); ?>