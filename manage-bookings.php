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
                        <button style="float: right;" class="btn btn-success" data-toggle="modal" data-target="#add">
                            <i class="fa fa-plus">Add </i>
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-mmd-12">
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
                                $result = $db->prepare("SELECT * FROM tbl_reservations WHERE user_id='$user_id'  AND status <> 'Park Out' ORDER BY id DESC");
                                $result->execute();
                                for ($i = 1; $row = $result->fetch(); $i++) {
                                    $id = $row['id'];
                                    $pid = $row['park_id'];
                                    $stat = $row['status']; ?>
                                    <tr>
                                        <td><?= $i; ?> </td>
                                        <td><?= $row['reserveNo']; ?></td>
                                        <td><?= (is_null($row['park_id']) ? '' : db_get_result('tbl_parks', "park_code", ["id" => $row['park_id']])); ?>  </td>
                                        <td><?= format_date($row['created_at']) ; ?></td>
                                        <td><?= (is_null($row['time_reserved']) ? '' : format_time($row['time_reserved'])); ?>  </td>
                                        <td><?= (is_null($row['time_arrival']) ? '' : format_time($row['time_arrival'])); ?>  </td>
                                        <td><?= (is_null($row['park_in']) ? '' : format_time($row['park_in'])); ?>  </td>
                                        <td><?= (is_null($row['park_out']) ? '' : format_time($row['park_out'])); ?>  </td>
                                        <td><?= $row['total_hr']; ?></td>
                                        <td><?= $row['sub_total']; ?></td>
                                        <td><?= $row['discount']; ?></td>
                                        <td><?= $row['penalty']; ?></td>
                                        <td><?= $row['total']; ?></td>
                                        <td>
                                            <?= $stat=$row['status']; ?>
                                        <?php if ($stat=='Reserved'){ ?>
                                             <a class='btn btn-sm btn-danger' onclick="return  confirm('Are you sure ?')"   href='models/do.php?do=cancelled&id=<?=$id.'&pid='.$pid;?>'> Cancelled?</a> 
                                         <?php }?>
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
            </div>


        </div>
    </div><!-- .animated -->
    </div><!-- .content -->

<style>
table, th, td {
  border:1px solid black;
}

*, *:before, *:after {
  box-sizing: border-box;
}

html {
  font-size: 16px;
}

.car-park {
  margin: 20px auto;
  /* max-width: 300px; */
}

.exit {
  position: relative;
  height: 50px;
}
.exit:before, .exit:after {
  content: "EXIT";
  font-size: 14px;
  line-height: 18px;
  padding: 0px 2px;
  font-family: "Arial Narrow", Arial, sans-serif;
  display: block;
  position: absolute;
  background: green;
  color: white;
  top: 50%;
  transform: translate(0, -50%);
}
.exit:before {
  left: 0;
}
.exit:after {
  right: 0;
}

/* .fuselage {
  border-right: 5px solid #d8d8d8;
  border-left: 5px solid #d8d8d8;
} */

ol {
  list-style: none;
  padding: 0;
  margin: 0;
}

.parks {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  justify-content: flex-start;
  pointer-events: none;
}

.park {
  display: flex;
  flex: 0 0 21.3%;
  padding: 5px;
  position: relative;
}
.park:nth-child(2) {
  margin-right: 14.28571428571429%;
}
.park input[type=checkbox] {
  position: absolute;
  opacity: 0;
}
.park input[type=checkbox]:checked + label {
  background: #F42536;
  -webkit-animation-name: rubberBand;
  animation-name: rubberBand;
  animation-duration: 300ms;
  animation-fill-mode: both;
}
.park input[type=checkbox]:disabled + label {
  background: green;
  text-indent: -9999px;
  overflow: hidden;
}
.park input[type=checkbox]:disabled + label:after {
  /* content: "X"; */
  text-indent: 0;
  position: absolute;
  top: 4px;
  left: 50%;
  transform: translate(-50%, 0%);
}
.park input[type=checkbox]:disabled + label:hover {
  box-shadow: none;
  cursor: not-allowed;
}
.park label {
  display: block;
  position: relative;
  width: 100%;
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  line-height: 1.5rem;
  padding: 4px 0;
  background: #F42536;
  border-radius: 5px;
  animation-duration: 300ms;
  animation-fill-mode: both;
}
.park label:before {
  content: "";
  position: absolute;
  width: 75%;
  height: 75%;
  top: 1px;
  left: 50%;
  transform: translate(-50%, 0%);
  background: rgba(255, 255, 255, 0.4);
  border-radius: 3px;
}
.park label:hover {
  cursor: pointer;
  box-shadow: 0 0 0px 2px #5C6AFF;
}

@-webkit-keyframes rubberBand {
  0% {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
  30% {
    -webkit-transform: scale3d(1.25, 0.75, 1);
    transform: scale3d(1.25, 0.75, 1);
  }
  40% {
    -webkit-transform: scale3d(0.75, 1.25, 1);
    transform: scale3d(0.75, 1.25, 1);
  }
  50% {
    -webkit-transform: scale3d(1.15, 0.85, 1);
    transform: scale3d(1.15, 0.85, 1);
  }
  65% {
    -webkit-transform: scale3d(0.95, 1.05, 1);
    transform: scale3d(0.95, 1.05, 1);
  }
  75% {
    -webkit-transform: scale3d(1.05, 0.95, 1);
    transform: scale3d(1.05, 0.95, 1);
  }
  100% {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
}
@keyframes rubberBand {
  0% {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
  30% {
    -webkit-transform: scale3d(1.25, 0.75, 1);
    transform: scale3d(1.25, 0.75, 1);
  }
  40% {
    -webkit-transform: scale3d(0.75, 1.25, 1);
    transform: scale3d(0.75, 1.25, 1);
  }
  50% {
    -webkit-transform: scale3d(1.15, 0.85, 1);
    transform: scale3d(1.15, 0.85, 1);
  }
  65% {
    -webkit-transform: scale3d(0.95, 1.05, 1);
    transform: scale3d(0.95, 1.05, 1);
  }
  75% {
    -webkit-transform: scale3d(1.05, 0.95, 1);
    transform: scale3d(1.05, 0.95, 1);
  }
  100% {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
}
.rubberBand {
  -webkit-animation-name: rubberBand;
  animation-name: rubberBand;
}

</style>

    
    <div class="modal fade" id="add" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-center">
            <div class="modal-dialog .modal-align-center">
                <div class="modal-content">
                    <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h2 class="modal-title" id="defaultModalLabel">Add Reservation
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                </button>
                            </h2>
                        </div>
                        <div class="modal-body">
                            
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="car-park">
                                        <ol class="cabin fuselage">
                                            <ol class="parks" type="A">
                                                <?php
                                                    $result = $db->prepare("SELECT * FROM tbl_parks");
                                                    $result->execute();
                                                    for ($i = 1; $row = $result->fetch(); $i++) {
                                                        $id = $row['id'];
                                                        $stat = $row['sub_status'];
                                                        $images = $row['image'];
                                                ?>
                                                    <li class="park" style="content: url('<?php echo '../main/images/parking-lot/' . $images  ?>'); width: 10px; height: 120px; background-color: <?= ($stat != 'Reserved' ? "green" : "red") ?>;">
                                                        <input type="checkbox" <?= ($stat != 'Reserved' ? "disabled" : "") ?> id="1A" />
                                                        <label for="1A"><?= $row['park_code']; ?></label>
                                                    </li>

                                                <?php } ?>
                                            </ol>
                                        </ol>
                                    </div>
                                </div>
                              </div>
                            
                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                    <div class="form-line">
                                        <label class="form-label">Time Reserved</label>
                                        <input name="time_reserved" value="<?php echo $timeNow; ?>" type="text" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
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

<?php include_once('layout/footer.php'); ?>