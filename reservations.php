<?php include_once('layout/head.php'); ?>
<?php $title = 'Reservation'; ?>
    <!-- Left Panel -->

    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <strong class="card-title">
                            <?= strtoupper($title . 's'); ?>
                        </strong>
<!--                        <button style="float: right;" class="btn btn-success" data-toggle="modal" data-target="#add">-->
<!--                            <i class="fa fa-plus">Add </i>-->
<!--                        </button>-->
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Reservation #</th>
                                    <th>Park</th>
                                    <th>User</th>
                                    <th>Time Reserved</th>
                                    <th>Time Arrival</th>
                                    <th>Park In</th>
                                    <th>Park Out</th>
                                    <th>Hours</th>
                                    <th>Sub Total</th>
                                    <th>Discount</th>
                                    <th>Penalty</th>
                                    <th>Total</th>

                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $result = $db->prepare("SELECT * FROM tbl_reservations");
                                $result->execute();
                                for ($i = 1; $row = $result->fetch(); $i++) {
                                    $id = $row['id'];
                                    $stat = $row['status']; ?>
                                    <tr>
                                        <td><?=$i;?> </td>
                                        <td><?= $row['reserveNo'] ; ?></td>
                                        <td><?= (is_null($row['park_id']) ? '' : db_get_result('tbl_parks', "park_code", ["id" => $row['park_id']])); ?>  </td>
                                        <td><?= db_get_result('tbl_users', "CONCAT(fname, ' ',lname)", ["id" => $row['user_id']]); ?></td>
                                        <td><?= (is_null($row['time_reserved']) ? '' : format_time($row['time_reserved'])); ?>  </td>
                                        <td><?= (is_null($row['time_arrival']) ? '' : format_time($row['time_arrival'])); ?>  </td>
                                        <td><?= (is_null($row['park_in']) ? '' : format_time($row['park_in'])); ?>  </td>
                                        <td><?= (is_null($row['park_out']) ? '' : format_time($row['park_out'])); ?>  </td>
                                        <td><?= $row['total_hr'] ; ?></td>
                                        <td><?= $row['sub_total'] ; ?></td>
                                        <td><?= $row['discount'] ; ?></td>
                                        <td><?= $row['penalty'] ; ?></td>
                                        <td><?= $row['total'] ; ?></td>
                                        <td><?= $row['status'] ; ?></td>

                                        <td>
<!--                                            <p data-placement="top" data-toggle="tooltip" title="Edit">-->
<!--                                                <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit--><?//= $id; ?><!--">-->
<!--                                                   Edit-->
<!--                                                </button>-->
<!--                                            </p>-->
                                            <p data-placement="top" data-toggle="tooltip" title="Delete">
                                                <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#penalty<?= $id; ?>">
                                                    Penalty </button>
                                            </p>
                                        </td>

                                    </tr>
                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
    </div><!-- .content -->

    <!--==================================== ADD,EDIT,DELETE MODALS ====================================== -->
    <!-- Add -->

    <div class="modal fade" id="add" role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">

                <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Add <?= $title; ?>
                        </h4>

                    </div>
                    <div class="modal-body">



                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="IU<?=$title;?>" name="func_param" class="btn btn-primary waves-effect">
                            SAVE
                        </button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
$result = my_query("SELECT *  FROM tbl_reservations   ");
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
                                    <label class="form-label">Park Code </label>
                                    <input name="park_code" value="<?= $row['park_code']; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Latitude</label>
                                    <input name="lat" value="<?= $row['lat']; ?>" type="text" class="form-control" required>
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

    <!-- Delete -->
    <div class="modal fade" id="delete<?= $id; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">
                <form action="models/CRUDS.php" method="POST">
                    <div class="modal-body">
                        <input value="<?= $id; ?>" name="id" type="hidden" class="form-control" required>
                        <div class="col-md-12" style="text-align: center;">
                            <h4>Are you sure you want to delete <br/>
                                (<i>
                                    <b>
                                        <a data-dismiss="modal" class="call_info" data-id="
            asd" type="button" data-toggle="modal" data-target="#edit<?= $id; ?>" style="color: red"
                                           id="removeNo"> <?= $row['reserveNo'] ; ?>
                                        </a>
                                    </b>
                                </i> )
                                information? <br/>There is NO undo! </h4>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="delete<?=$title;?>" name="func_param"
                                class="btn btn-danger waves-effect">DELETE
                        </button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="penalty<?= $id; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">
                <form action="models/CRUDS.php" method="POST">
                    <div class="modal-body">
                        <input value="<?= $id; ?>" name="id" type="hidden" class="form-control" required>
                        <div class="col-md-12" style="text-align: center;">
                            <h4>Are you sure you want to add penalty <br/>
                                (<i>
                                    <b>
                                        <a data-dismiss="modal" class="call_info" data-id="
            asd" type="button" data-toggle="modal" data-target="#edit<?= $id; ?>" style="color: red"
                                           id="removeNo"> <?= $row['reserveNo'] ; ?>
                                        </a>
                                    </b>
                                </i> )
                                information?
                        </div>


                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Penalty</label>
                                    <input name="penalty" value="<?= $row['penalty']; ?>" type="number" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="addPenalty" name="func_param"
                                class="btn btn-danger waves-effect">UPDATE
                        </button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>


<?php include_once('layout/footer.php'); ?>