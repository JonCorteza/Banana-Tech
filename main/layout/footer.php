

<!--MODALS-->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-smd" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel"> CHANGE PASSWORD
                    <small>Change your password</small>
                </h4>
            </div>
            <form action="models/user.php" method="POST">
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" class="form-control" placeholder="Old Password" name="oldpassword" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" class="form-control" placeholder="New Password" name="newpassword" required/>
                            </div>
                            <!-- pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$" -->
                        </div>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" class="form-control" placeholder="Re-type Password" name="retypepassword" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="func_param" value="changePassword" class="btn  btn-info waves-effect">
                        CHANGE
                    </button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

$result = my_query("SELECT *  FROM tbl_users WHERE id='$user_id'");
for ($i = 1; $row = $result->fetch(); $i++) {
    ?>
    <div class="modal fade" id="changeProfile" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-smd" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Update Profile </h4>
                </div>
                <form action="models/user.php" method="POST" enctype="multipart/form-data">

                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <img src="../images/user/<?= $_SESSION['pic']; ?>" width="100px" height="100px" alt="User"/>
                                    <input name="pic" type="file" class="form-control" accept="images*">
                                    <input name="pic1" type="hidden" value="<?= $row['pic']; ?>" required>
                                    <input name="role" type="hidden" value="<?= $user_role; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Lastname</label>
                                    <input name="lname" type="text" class="form-control" value="<?= $row['lname']; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Firstname</label>
                                    <input name="fname" type="text" class="form-control" value="<?= $row['fname']; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label"> Middlename </label>
                                    <input name="mname" type="text" class="form-control" value="<?= $row['mname']; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control" value="<?= $row['email']; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Contact</label>
                                    <input name="contact" type="number" class="form-control" value="<?= $row['contact']; ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Address</label>
                                    <input name="address" type="text" class="form-control" value="<?= $row['address']; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Gender</label>
                                    <select name="gender" class="form-control" required>
                                        <option><?= $row['gender']; ?></option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" value="updateProfile" name="func_param" class="btn btn-warning waves-effect">
                            UPDATE
                        </button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php } ?>




<div class="clearfix"></div>

<footer class="site-footer">
    <div class="footer-inner bg-white">
        <div class="row">
            <div class="col-sm-6">
                Banana Technology Parking System
            </div>
            <div class="col-sm-6 text-right">
              v 1.1.23
            </div>
        </div>
    </div>
</footer>

</div><!-- /#right-panel -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>


<script src="assets/js/lib/data-table/datatables.min.js"></script>
<script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
<script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
<script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
<script src="assets/js/lib/data-table/jszip.min.js"></script>
<script src="assets/js/lib/data-table/vfs_fonts.js"></script>
<script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
<script src="assets/js/lib/data-table/buttons.print.min.js"></script>
<script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
<script src="assets/js/init/datatables-init.js"></script>



<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<!-- /#right-panel -->

<!--Local Stuff-->

<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable();
    } );

    function getAge() {
        var today = new Date();
        var birthDate = new Date($('#bday').val());
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();

        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        $('#age').val(age);
    }

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();

        document.body.innerHTML = originalContents;
    }

    $('.select').select2({
        width: "100%",
        placeholder: "Select",
        maximumSelectionSize: 1,
        allowClear: true,
    });

</script>


</body>
</html>
