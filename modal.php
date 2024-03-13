<!-- Modal -->

<!-- Edit Modal -->
<?php
$result = $db->prepare("SELECT * FROM tbl_reservations");
$result->execute();
for ($i = 1; $row = $result->fetch(); $i++) {
    $id = $row['id']; ?>
    <div class="modal fade" id="edit<?= $id; ?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-center">
            <div class="modal-dialog .modal-align-center">
                <div class="modal-content">
                    <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                        <input name="id" value="<?= $row['id']; ?>" type="hidden">
                        <div class="modal-header">
                            <h2 class="modal-title" id="defaultModalLabel">Edit Parking
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                </button>
                            </h2>
                        </div>
                        <div class="modal-body">

                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Parking</label>
                                        <select name="park_id" class="form-control" required>
                                            <option></option>
                                            <?php $res = my_query("SELECT * FROM tbl_parks ");
                                            for ($x = 1; $r = $res->fetch(); $x++) { ?>
                                                <option <?= ($row['park_id'] == $r['id'] ? 'selected' : ''); ?> value="<?= $r['id']; ?>"><?= $r['park_code']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Customer</label>
                                        <select name="user_id" class="form-control select" required>
                                            <option></option>
                                            <?php $res = my_query("SELECT *,CONCAT(fname,' ' ,lname)name FROM tbl_users WHERE role='User' AND status='Active'");
                                            for ($x = 1; $r = $res->fetch(); $x++) { ?>
                                                <option <?= ($row['user_id'] == $r['id'] ? 'selected' : ''); ?> value="<?= $r['id']; ?>"><?= $r['name']; ?></option>
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
                                        <input name="time_reserved" value="<?= ($row['time_reserved'] == '00:00:00' ? '' : $row['time_reserved']); ?>" type="time" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Time Arrival</label>
                                        <input name="time_arrival" value="<?= ($row['time_arrival'] == '00:00:00' ? '' : $row['time_arrival']); ?>" type="time" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <h3>Park</h3>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Park In</label>
                                        <input name="park_in" value="<?= ($row['park_in'] == '00:00:00' ? '' : $row['park_in']); ?>" type="time" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Park Out</label>
                                        <input name="park_out" value="<?= ($row['park_out'] == '00:00:00' ? '' : $row['park_out']); ?>" type="time" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <hr/>

                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control select" required>
                                            <option><?= $row['status']; ?></option>
                                            <option>Pending</option>
                                            <option>Reserved</option>
                                            <option>Park In</option>
                                            <option>Park Out</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" value="IUParkings" name="func_param" class="btn btn-primary waves-effect">
                                SAVE
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="pay<?= $id; ?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-center">
            <div class="modal-dialog .modal-align-center">
                <div class="modal-content">
                    <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                        <input name="id" value="<?= $row['id']; ?>" type="hidden">
                        <div class="modal-header">
                            <h2 class="modal-title" id="defaultModalLabel"> Payment
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                </button>
                            </h2>
                        </div>
                        <div class="modal-body">
                            <img src="assets/img/gcash.jpg" width="100%"> <br/>
                            GCASH NAME : ALDRIN P. VELASCO<br/>
                            GCASH NUMBER : 09859585<br/>


                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label"> Screenshot</label>
                                        <input name="payment_img" type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label"> Amount</label>
                                        <input name="payment_amt" type="number" min="<?=$row['overall_amt'];?>"  class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Payment Information</label>
                                        <textarea name="payment_details" class="form-control" rows="5" required>
Sender :
Last 4 Transaction Code :   </textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" value="addPayment" name="func_param" class="btn btn-primary waves-effect">
                                SUBMIT
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>