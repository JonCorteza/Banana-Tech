<?php include_once('layout/head.php'); ?>

<div id="about">
    <div class="container">
        <div class="row">

            <div class="text-center">
                <h3 style="font-family: Roboto; font-weight:300;">About <?= $system_title; ?></h3>
                <p style="font-family: Roboto; font-weight:300;">ABOUT | VISION | MISSION <br/>
                    <?= $about; ?>
                </p>
            </div>

            <div class="col-md-6 wow fadeInRight" data-wow-offset="0" data-wow-delay="0.3s">
                <div class="text-center">
                    <div class="hi-icon-wrap hi-icon-effect">
                        <i class="glyphicon glyphicon-eye-open"></i>
                        <h2 style="font-family: Roboto; font-weight:400;">Vision</h2>
                        <p style="font-family: Roboto; font-weight:300;text-align:left;">
                            <?= $vision; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6wow fadeInRight" data-wow-offset="0" data-wow-delay="0.3s">
                <div class="text-center">
                    <div class="hi-icon-wrap hi-icon-effect">
                        <i class="glyphicon glyphicon-star"></i>
                        <h2 style="font-family: Roboto; font-weight:400;">Mission</h2>
                        <p style="font-family: Roboto; font-weight:300;text-align:left;">
                            <?= $mission; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="parking">
    <br/><br/><br/><br/>
    <div class="container">
        <div class="text-center">
            <h3 style="font-family: Roboto; font-weight:300;">Our Parking</h3>
            <?php if (isset($_SESSION['logged_in'])) { ?>
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#parkCustomer">Park Customer
                </button> <br/>
            <?php } else { ?>
                <a href="signin.php" type="livedemo" class="btn btn-danger " style="font-family: Roboto;font-weight:300;border-radius: 100px;outline:none;height: ;">
                    Login First
                </a><br/><br/>
               
            <?php } ?>

        </div>
    </div>
    <div class="container">
        <div class="row">


            <!------ Include the above in your HEAD tag ---------->
          
                <?php if (isset($_SESSION['role'] )) { ?>  
            <!-- Button trigger modal -->
          <?php if ($_SESSION['role'] == 'Admin') { ?>
              <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add">Add</button>

          <?php }else{  ?>
               
            <?php } ?>

            <?php include('layout/modal.php'); ?>

            <!------ Include the above in your HEAD tag ---------->
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
            <?php if ($_SESSION['role'] == 'Admin') { ?>

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Park</th>
                            <th>User</th>
                            <th>Time Reserved</th>
                            <th>Time Arrival</th>
                            <th>Reserve HR/ Total</th>
                            <th>Park In</th>
                            <th>Park Out</th>
                            <th>Park HR/Total</th>
                            <th>Paid/Overall</th>
                            <th>Balance</th>
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
                                <td><?= (is_null($row['park_id']) ? '' : db_get_result('tbl_parks', "park_code", ["id" => $row['park_id']])); ?>  </td>
                                <td><?= db_get_result('tbl_users', "CONCAT(fname, ' ',lname)", ["id" => $row['user_id']]); ?></td>
                                <td><?= (is_null($row['time_reserved']) ? '' : format_time($row['time_reserved'])); ?>  </td>
                                <td><?= (is_null($row['time_arrival']) ? '' : format_time($row['time_arrival'])); ?>  </td>
                                <td><?= $row['reserve_hr'] . ' X ' . $row['reserve_total']; ?></td>
                                <td><?= (is_null($row['park_in']) ? '' : format_time($row['park_in'])); ?>  </td>
                                <td><?= (is_null($row['park_out']) ? '' : format_time($row['park_out'])); ?>  </td>
                                <td><?= $row['park_hr'] . ' X ' . $row['park_total']; ?></td>
                                <td><?= $row['payment_amt'] . ' | ' . $row['overall_amt']; ?></td>
                                <td><?= peso_format($row['overall_amt'] - $row['payment_amt']); ?></td>
                                <td><?= $stat=$row['status']; ?>
                                 <?php 
                                 if($stat=='Reserved'){ ?>
                                     <a target="_blank" title="<?=$row['payment_details'];?>" href="assets/uploads/<?=$row['payment_img'];?>">View Info.</a>
                                <?php  }
                                 ?>
                                </td>
                                <td>
                                    <?php if ($row['overall_amt'] <> $row['payment_amt']) { ?>
                                        <p data-placement="top" data-toggle="tooltip" title="Paid?">
                                            <a onclick="return  confirm('Are you sure ?')" href="models/do.php?do=Paid&id=<?= $id; ?>" class="btn btn-warning btn-xs" data-title="Paid?">
                                                <span class="glyphicon glyphicon-check"></span></a>
                                        </p>
                                    <?php } ?>

                                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                                        <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit<?= $id; ?>">
                                            <span class="glyphicon glyphicon-pencil"></span></button>
                                    </p>
                                    <p data-placement="top" data-toggle="tooltip" title="Delete">
                                        <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete<?= $id; ?>">
                                            <span class="glyphicon glyphicon-trash"></span></button>
                                    </p>
                                </td>

                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
            <?php } ?>
            <?php if ($_SESSION['role'] == 'User') { ?>

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Time Reserved</th>
                            <th>Time Arrival</th>
                            <th>Reserve HR/ Total</th>
                            <th>Park In</th>
                            <th>Park Out</th>
                            <th>Park HR/Total</th>
                            <th>Paid/Overall</th>
                            <th>Balance</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $result = $db->prepare("SELECT * FROM tbl_reservations WHERE user_id='$user_id' ORDER BY id DESC");
                        $result->execute();
                        for ($i = 1; $row = $result->fetch(); $i++) {
                            $id = $row['id'];
                            $stat = $row['status']; ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= (is_null($row['time_reserved']) ? '' : format_time($row['time_reserved'])); ?>  </td>
                                <td><?= (is_null($row['time_arrival']) ? '' : format_time($row['time_arrival'])); ?>  </td>
                                <td><?= $row['reserve_hr'] . ' X ' . $row['reserve_total']; ?></td>
                                <td><?= (is_null($row['park_in']) ? '' : format_time($row['park_in'])); ?>  </td>
                                <td><?= (is_null($row['park_out']) ? '' : format_time($row['park_out'])); ?>  </td>
                                <td><?= $row['park_hr'] . ' X ' . $row['park_total']; ?></td>
                                <td><?= $row['payment_amt'] . ' | ' . $row['overall_amt']; ?></td>
                                <td><?= peso_format($row['overall_amt'] - $row['payment_amt']); ?></td>
                                <td><?= $row['status']; ?>

                                </td>
                                <td>
                                    <p data-placement="top" data-toggle="tooltip" title="Add Payment">
                                        <button class="btn btn-success btn-xs" data-title="Add Payment" data-toggle="modal" data-target="#pay<?= $id; ?>">
                                            <span class="glyphicon glyphicon-plus"></span></button>
                                    </p>

                                </td>

                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
            <?php } ?>

            <?php } ?>
            <div class="col-md-2"></div>
            <div id="parkingRefresh" class="col-md-8">
                <style>
                    table {
                        font-family: arial, sans-serif;
                        border-collapse: collapse;
                        width: 100%;
                    }

                    td, th {
                        border: 1px solid #dddddd;
                        text-align: left;
                        padding: 8px;
                    }

                    tr:nth-child(even) {
                        background-color: #dddddd;
                    }
                </style>
                <table>
                    <tr>
                        <th>#</th>
                        <th>Park Code</th>
                        <th>Status</th>
<!--                        --><?php //if (isset($_SESSION['logged_in'])) { ?>
<!--                            <th>Action</th>-->
<!--                        --><?php //} ?>
                    </tr>
                    <?php
                    $result = $db->prepare("SELECT * FROM tbl_parks");
                    $result->execute();
                    for ($i = 1; $row = $result->fetch(); $i++) {
                        $id = $row['id'];
                        $stat = $row['status']; ?>
                        <tr>
                            <td><?= $i; ?>.)</td>
                            <td><?= $row['park_code']; ?></td>
                            <td><?= $stat; ?>
<!--                            </td>-->
<!---->
<!--                            --><?php //if (isset($_SESSION['logged_in'])) { ?>
<!--                                <td>-->
<!--                                    --><?php //if ($stat == 'Available') { ?>
<!--                                        <a href="models/do.php?do=reserved&id=--><?//= $id; ?><!--&stat=Reserved" onclick="return  confirm('Are you sure ?')" class="btn btn-info">Reserved?</a>-->
<!--                                    --><?php //} elseif ($stat == 'Reserved' || $stat == 'Park') { ?>
<!--                                        --><?php //if ($row['if_reserved'] == $user_id || $_SESSION['role'] == 'Admin') { ?>
<!--                                            <a href="models/do.php?do=parkout&id=--><?//= $id; ?><!--" onclick="return  confirm('Are you sure ?')" style="background-color: #2fa360" class="btn btn-warning">Park-->
<!--                                                out?</a>-->
<!--                                        --><?php //} else { ?>
<!--                                            <a style="background-color: red" class="btn btn-warning">Not Available</a>-->
<!--                                        --><?php //}
//                                    } ?>
<!--                                </td>-->
<!--                            --><?php //} else {
//                                echo " ";
//                            } ?>
                        </tr>
                    <?php } ?>

                </table>
            </div>

        </div>
    </div>


</div>


<div id="contact">
    <div class="container">
        <div class="text-center">
            <h3 style="font-family: Roboto; font-weight:300;">Contact Us</h3>
            <p>Feel free to contact us anytime.</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 wow fadeInUp" data-wow-offset="0" data-wow-delay="0.2s">
                <h2>Contact us any time</h2>
                <p>We're here to help. We're friendly and available to contact.
                    Reach out to us anytime and well happily answer your questions and feedbacks.</p>
            </div>

            <div class="col-md-4 wow fadeInUp" data-wow-offset="0" data-wow-delay="0.4s">
                <h2>Contact Info</h2>
                <ul>
                    <li><img src="assets/img/home/campus.png" style="width:30px;height:30px;">
                        txt
                    </li>
                    <hr>
                    <li><img src="assets/img/home/mobile.png" style="width:30px;height:30px;">
                        +63
                    </li>
                    <hr>
                    <li><img src="assets/img/home/email.png" style="width:30px;height:30px;">
                        txt.com | txt.com
                    </li>
                </ul>
            </div>

            <div class="col-md-4 wow fadeInUp" data-wow-offset="0" data-wow-delay="0.6s">

                <h2>Related Links</h2>
                <ul>
                    <li>
                        <a href="" target="_blank"><img src="assets/img/logo.png" style="width:30px;height:30px;"></a>
                        <?= $system_title; ?>(Official Website)
                    </li>
                    <hr>

                    <li>
                        <a href="https://www.facebook.com/tonsberginternational/" target="_blank"><img src="assets/img/home/facebook.png" style="width:30px;height:30px;"></a>
                        Facebook
                    </li>
                    <hr>
                </ul>


            </div>
        </div>
    </div>
</div><!--/#contact-->


<div class="modal fade" id="parkCustomer" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-center">
        <div class="modal-dialog .modal-align-center">
            <div class="modal-content">
                <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h2 class="modal-title" id="defaultModalLabel">Add Parking
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">×</span><span class="sr-only">Close</span>
                            </button>
                        </h2>
                    </div>
                    <div class="modal-body">

                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Customer </label>
                                    <select name="user_id" class="form-control select" required>
                                        <?php $res = my_query("SELECT *,CONCAT(fname,' ' ,lname)name FROM tbl_users WHERE   status='Active' AND id='$user_id'");
                                        for ($x = 1; $r = $res->fetch(); $x++) { ?>
                                            <option value="<?= $r['id']; ?>"><?= $r['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <h3>Reservation</h3>
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Time Reserved</label>
                                    <input name="time_reserved" value="<?php echo $timeNow; ?>" type="text" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Time Arrival</label>
                                    <input name="time_arrival" type="time" class="form-control" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="addReserve" name="func_param" class="btn btn-primary waves-effect">
                            SAVE
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="site_map">
    <div class="text-center">
        <h3 style="font-family: Roboto; font-weight:300;">Our Location</h3>
        <p></p>
    </div>
    <div id="mapouter">

        <div id="gmap_canvas">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3858.8054431541436!2d121.03539531484167!3d14.723588989724261!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b0fee6e8a48f%3A0x1cbc4a70d74f3043!2sMillionaires%20Park!5e0!3m2!1sen!2sph!4v1667139368795!5m2!1sen!2sph" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <br/><a class="addmaps" href="https://goo.gl/maps/mffvTWWDzYZ8pcXe9" id="get-map-data"><?= $system_title; ?>
            </a>
        </div>
    </div>

</div>


<?php include_once('layout/footer.php'); ?>
