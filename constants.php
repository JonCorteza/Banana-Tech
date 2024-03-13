<?php include_once('layout/head.php'); ?>
<?php $title = 'Constant'; ?>
    <!-- Left Panel -->

    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <strong class="card-title">
                            <?= strtoupper($title . 's'); ?>
                        </strong>
                        <button style="float: right;" class="btn btn-success" data-toggle="modal" data-target="#add">
                           <i class="fa fa-plus">Add </i>
                        </button>
                    </div>

                    <div class="card-body">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Category</th>
                                <th>Value</th>
                                <th>Sub Value</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $result = my_query("SELECT *  FROM tbl_constants ORDER BY id DESC  ");
                            for ($i = 1; $row = $result->fetch(); $i++) {
                                $id = $row['id']; ?>
                                <tr>
                                    <td><?= $row['category']; ?></td>
                                    <td><?= $row['value']; ?></td>
                                    <td><?= $row['sub_value']; ?></td>
                                    <td>
                                        <a title="Edit" class="btn right btn-warning waves-effect waves-light yellow darken-4 "
                                           data-toggle="modal" data-target="#edit<?= $id; ?>">
                                            <i class="fa fa-edit"> Edit </i>
                                        </a>

                                        <a title="Delete" class="btn right btn-danger waves-effect waves-light yellow darken-4"
                                           data-toggle="modal" data-target="#delete<?= $id; ?>">
                                            <i class="fa fa-trash"> Delete </i>
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

                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Category</label>
                                    <input name="category" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Value</label>
                                    <input name="value" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Sub Value</label>
                                    <input name="sub_value" type="text" class="form-control">
                                </div>
                            </div>
                        </div>

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
$result = my_query("SELECT *  FROM tbl_constants   ");
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
                                    <label class="form-label">Category </label>
                                    <input name="category" value="<?= $row['category']; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Value</label>
                                    <input name="value" value="<?= $row['value']; ?>" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Sub Value</label>
                                    <input name="sub_value" value="<?= $row['sub_value']; ?>" type="text" class="form-control">
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
                                           id="removeNo"> <?= $row['category'] . '-' . $row['value']; ?>
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
<?php } ?>


<?php include_once('layout/footer.php'); ?>