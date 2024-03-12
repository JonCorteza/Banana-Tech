<?php include_once('layout/head.php'); ?>
<?php $title = 'Payment'; ?>
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
                                <th>#</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $result = my_query("SELECT *,CONCAT(fname,' ',lname)name  FROM tbl_payments p INNER JOIN tbl_users u ON u.id=p.user_id  ORDER BY p.id DESC  ");
                            for ($i = 1; $row = $result->fetch(); $i++) {
                                $id = $row['id']; ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?php
                                        echo $t=$row['type'];
                                    if($t=='Pay Out'){
                                        echo '<br/>';
                                        echo $reserveNo = db_get_result('tbl_reservations','reserveNo',['id'=>$row['reservation_id']]);
                                    }
                                    ?></td>
                                    <td><?= $row['amount']; ?></td>
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


<?php include_once('layout/footer.php'); ?>