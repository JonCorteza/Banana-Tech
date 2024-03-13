<?php include_once('layout/head.php'); ?>
<?php $title = 'Report';
$t = $_GET['t'];

?>

<div class="animated fadeIn">

    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>   <?= $t; ?> Reports </strong>
                </div>
                <div class="card-body card-block">
                    <form method="GET" enctype="multipart/form-data" class="form-horizontal" name="bwdatesreport">
                        <input value="<?= $t; ?>" name="t" type="hidden">
                        <div class="row form-group">
                            <div class=" col-md-1"><label for="text-input" class=" form-control-label">From </label>
                            </div>
                            <div class=" col-md-4">
                                <input type="date" name="d1" id="d1" value="<?php if (isset($_GET['d1'])) {
                                    echo $_GET['d1'];
                                } ?>" class="form-control" required="true">
                            </div>

                            <div class=" col-md-1"><label for="email-input" class=" form-control-label">To </label>
                            </div>
                            <div class=" col-md-4">
                                <input type="date" name="d2" value="<?php if (isset($_GET['d2'])) {
                                    echo $_GET['d2'];
                                } ?>" class="form-control" required="true"></div>

                            <div class=" col-md-1">
                                <p style="text-align: center;">
                                    <button type="submit" class="btn btn-primary btn-sm" name="submit">Submit</button>
                                </p>
                            </div>
                            <div class=" col-md-1">
                                <p style="text-align: center;">
                                    <button onclick="printDiv('printableArea')" class="btn btn-danger btn-sm" name="submit">
                                        Print
                                    </button>
                                </p>
                            </div>
                        </div>


                    </form>
                </div>


                <div class="card-body">
                    <div class="table-responsive" id="printableArea">


                        <?php if ($t == 'Payments') { ?>
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Reservation</th>
                                    <th>Amount</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- <?php
                                    if (isset($_GET['d1'])) {
                                        $d1 = $_GET['d1'];
                                        $d2 = $_GET['d2'];
                                        $result = my_query("SELECT *,CONCAT(fname, ' ',lname)name,p.created_at FROM tbl_payments p  
                                                                INNER JOIN tbl_reservations r ON r.id=p.reservation_id
                                                                INNER JOIN tbl_users u ON u.id=p.user_id WHERE p.created_at BETWEEN '$d1' AND '$d2'    ORDER BY p.id DESC");
                                    }

                                    $sumTotal = 0;
                                    for ($i = 1; $row = $result->fetch(); $i++) {
                                        $id = $row['id'];
                                        $sumTotal += $row['amount']; ?>
                                        <tr>
                                            <td> <?= $i; ?></td>
                                            <td> <?= $row['name']; ?></td>
                                            <td> <?= $row['reserveNo']; ?></td>
                                            <td> <?= $row['amount']; ?></td>
                                            <td> <?= $row['created_at']; ?></td>
                                        </tr>
                                    <?php } ?> -->
                                    <tr>
                                        <td>1</td>
                                        <td>Sample User 1</td>
                                        <td>kl65Dcb</td>
                                        <td>100</td>
                                        <td>2024-02-03 10:33:23</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Sample User 2</td>
                                        <td>FKCtQA3</td>
                                        <td>100</td>
                                        <td>2024-02-04 08:35:13</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Sample User 3</td>
                                        <td>KWsF6Uy</td>
                                        <td>100</td>
                                        <td>2024-02-05 11:00:03</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Sample User 4</td>
                                        <td>a3ck0SJ</td>
                                        <td>100</td>
                                        <td>2024-02-06 16:27:43</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Sample User 5</td>
                                        <td>DWKoTfE</td>
                                        <td>100</td>
                                        <td>2024-01-01 09:53:55</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Sample User 6</td>
                                        <td>snmgJiS</td>
                                        <td>100</td>
                                        <td>2024-01-12 12:23:03</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Sample User 7</td>
                                        <td>hJS0Ndb</td>
                                        <td>100</td>
                                        <td>2024-01-17 12:43:00</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Sample User 8</td>
                                        <td>UK9yzOJ</td>
                                        <td>100</td>
                                        <td>2024-01-22 14:33:05</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Sample User 9</td>
                                        <td>DhyZntF</td>
                                        <td>100</td>
                                        <td>2024-02-01 13:33:33</td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Sample User 10</td>
                                        <td>Z8xgQMT</td>
                                        <td>100</td>
                                        <td>2024-02-01 08:35:57</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="3"></th>
                                    <!-- <th><?= number_format($sumTotal, 2); ?></th> -->
                                    <th>1000.00</th>
                                </tr>
                                </tfoot>
                            </table>
                        <?php } else if ($t == 'Reservations') { ?>
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Reservation #</th>
                                    <th>Park Slot</th>
                                    <th>Card Type</th>
                                    <th>Guest Type</th>
                                    <th>Time Reserved</th>
                                    <th>Park In/Out</th>
                                    <th>Total HR</th>
                                    <th>Total Amt.</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- <?php
                                    if (isset($_GET['d1'])) {
                                        $d1 = $_GET['d1'];
                                        $d2 = $_GET['d2'];
                                        $result = my_query("SELECT *,CONCAT(fname, ' ',lname)name,p.created_at FROM tbl_payments p  
                                                                INNER JOIN tbl_reservations r ON r.id=p.reservation_id
                                                                INNER JOIN tbl_users u ON u.id=p.user_id WHERE r.created_at BETWEEN '$d1' AND '$d2' AND r.status='Park Out'    ORDER BY p.id DESC");
                                    }

                                    $sumTotal = 0;
                                    $tthr = 0 ;
                                    //`discount`, `penalty`  `status`, `notif`, `xdate`, `  reserve_hr + park_hr
                                    for ($i = 1; $row = $result->fetch(); $i++) {
                                        $id = $row['id'];
                                        $sumTotal += $row['total'];
                                        $tthr += $row['total_hr'];
                                        ?>
                                        <tr>
                                            <td> <?= $i; ?></td>
                                            <td> <?= $row['name']; ?></td>
                                            <td> <?= $row['reserveNo']; ?></td>
                                            <td> <?= $row['park_id']; ?></td>
                                            <td> <?= $row['card_type']; ?></td>
                                            <td> <?= $row['guest_type']; ?></td>
                                            <td> <?= $row['time_reserved'] . '-' . $row['time_arrival']; ?></td>
                                            <td> <?= $row['park_in'] . '-' . $row['park_out']; ?></td>
                                            <td> <?= $row['total_hr']; ?></td>

                                            <td> <?= $row['total']; ?></td>
                                            <td> <?= $row['created_at']; ?></td>
                                        </tr>
                                <?php } ?> -->
                                <tr>
                                        <td>1</td>
                                        <td>Sample User 1</td>
                                        <td>kl65Dcb</td>
                                        <td>1</td>
                                        <td>Guest</td>
                                        <td>Reserved</td>
                                        <td>03:55:00 - 17:00:00</td>
                                        <td>0 - 0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>2023-05-22 07:55:59</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Sample User 2</td>
                                        <td>FKCtQA3</td>
                                        <td>1</td>
                                        <td>Guest</td>
                                        <td>Reserved</td>
                                        <td>03:55:00 - 17:00:00</td>
                                        <td>0 - 0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>2024-02-04 08:35:13</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Sample User 3</td>
                                        <td>KWsF6Uy</td>
                                        <td>1</td>
                                        <td>Guest</td>
                                        <td>Reserved</td>
                                        <td>03:55:00 - 17:00:00</td>
                                        <td>0 - 0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>2024-02-05 11:00:03</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Sample User 4</td>
                                        <td>a3ck0SJ</td>
                                        <td>1</td>
                                        <td>Guest</td>
                                        <td>Reserved</td>
                                        <td>03:55:00 - 17:00:00</td>
                                        <td>0 - 0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>2024-02-06 16:27:43</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Sample User 5</td>
                                        <td>DWKoTfE</td>
                                        <td>1</td>
                                        <td>Guest</td>
                                        <td>Reserved</td>
                                        <td>03:55:00 - 17:00:00</td>
                                        <td>0 - 0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>2024-01-01 09:53:55</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="7">   </th>
                                    <th> <?=($i-1); ?> </th>
                                    <th> <?= number_format($tthr, 2); ?> </th>
                                    <th><?= number_format($sumTotal, 2); ?></th>
                                </tr>
                                </tfoot>
                            </table>

                        <?php } else if ($t == '') { ?>
                        <?php } else if ($t == '') { ?>
                        <?php } ?>

                    </div>
                </div>
           

        </div>

        <div class="col-lg-6">


        </div>


    </div>


</div><!-- .animated -->
</div><!-- .content -->

<div class="clearfix"></div>


<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<?php include_once('layout/footer.php'); ?>
