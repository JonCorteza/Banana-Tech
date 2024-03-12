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
                                    <th>Date</th>
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
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $result = $db->prepare("SELECT * FROM tbl_reservations WHERE user_id='$user_id'  AND status = 'Park Out' ORDER BY id DESC");
                                $result->execute();
                                for ($i = 1; $row = $result->fetch(); $i++) {
                                    $id = $row['id'];
                                    $stat = $row['status']; ?>
                                    <tr>
                                        <td><?=$i;?> </td>
                                        <td><?= $row['reserveNo'] ; ?></td>
                                        <td><?= (is_null($row['park_id']) ? '' : db_get_result('tbl_parks', "park_code", ["id" => $row['park_id']])); ?>  </td>

                                        <td><?= format_date($row['created_at']) ; ?></td>
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


<?php include_once('layout/footer.php'); ?>