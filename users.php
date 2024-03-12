<?php include_once('layout/head.php'); ?>
<?php $title = 'User'; ?>

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
                                <th>Picture</th>
                                <th>User #</th>
                                <th>Role</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $result = my_query("SELECT * FROM tbl_users   ORDER BY id DESC");
                            for ($i = 1; $row = $result->fetch(); $i++) {
                                $id = $row['id']; ?>
                                <tr>
                                    <td><img width="50" src="../images/user/<?= $row['pic']; ?>"/></td>
                                    <td>
                                        <a href="profile.php?id=<?= $row['id']; ?>"> <?= $row['userNo']; ?></a>
                                    </td>
                                    <td><?= $row['role']; ?></td>
                                    <td><?= $row['fname']; ?></td>
                                    <td><?= $row['lname']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                    <td><?= $row['contact']; ?></td>
                                    <td>
                                        <a title="<?= ($row['status'] == 'Active' ? 'Inactive?' : 'Active?'); ?>" onclick="return  confirm('Are you sure ?')" href="models/do.php?do=status&id=<?= $row['id']; ?>&stat=<?= $row['status']; ?>"><?= $row['status']; ?></a>
                                    </td>
                                    <td>
                                        <a title="Edit" class="btn right btn-warning waves-effect waves-light yellow darken-4 "
                                           data-toggle="modal" data-target="#edit<?= $id; ?>">
                                            <i class="fa fa-edit"> Edit </i>
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


    <div class="modal fade" id="add" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="largeModalLabel">Add <?= $title; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input name="status" type="hidden" value="Active" class="form-control" required>
                        <input name="password" type="hidden" class="form-control" value="<?= $defaultPassword; ?>" required>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label class="form-label">Profile Img.</label>
                                <input name="pic" type="file" class="form-control" accept="images*">
                                <input name="pic1" type="hidden" value="default.png" class="form-control">

                            </div>

                            <div class="col-md-6">
                                <label class="form-label">REG #</label>
                                <input name="userNo" type="text" class="form-control" required>

                            </div>

                        </div>

                        <div class="row form-group">
                            <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Firstname</label>
                                        <input name="fname" type="text" class="form-control" required>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Lastname</label>
                                        <input name="lname" type="text" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Middlename</label>
                                        <input name="mname" type="text" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">

                            <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Birth Date</label>
                                        <input name="bday" type="date" id="bday" onchange="getAge()" max="<?= $dateNow; ?>" class="form-control bday" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Age</label>
                                        <input name="age" type="text" id="age" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Gender</label>
                                        <select name="gender" class="form-control" required>
                                            <option>Female</option>
                                            <option>Male</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Email</label>
                                        <input name="email" type="email" class="form-control" id="emailAdd" onchange="showUsername();" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Contact</label>
                                        <input name="contact" type="text" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Address</label>
                                        <input name="address" type="text" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Username</label>
                                        <input name="username" type="text" id="username" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Password </label>
                                        <input name="password" type="text" class="form-control" required>
                                    </div>
                                    <!--                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one special characters, one number and one uppercase and lowercase letter, and at least 6 or more characters"-->
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="IU<?= $title; ?>" name="func_param" class="btn btn-primary waves-effect">
                            SAVE
                        </button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Edit -->
<?php
$result = my_query("SELECT *  FROM tbl_users");
for ($i = 1; $row = $result->fetch(); $i++) {
    $id = $row['id']; ?>
    <div class="modal fade" id="edit<?= $id; ?>" role="dialog">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Edit <?= $title; ?></h4>
                </div>
                <form action="models/CRUDS.php" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <input name="pic1" type="hidden" value="<?= $row['pic']; ?>">
                    <input name="status" type="hidden" value="<?= $row['status']; ?>">

                    <div class="modal-body">


                        <div class="row form-group">
                            <div class="col-md-4">
                                <div class="form-group form-float">
                                    <label class="form-label">Profile Img.</label>
                                    <div class="form-line">
                                        <input name="pic" type="file" class="form-control" accept="images*">
                                    </div>
                                </div>
                            </div>
<!--                            <div class="col-md-4">-->
<!--                                <div class="form-group form-float">-->
<!--                                    <div class="form-line">-->
<!--                                        <label class="form-label">Roles</label>-->
<!--                                        <select name="role" class="form-control select">-->
<!--                                            <option></option>-->
<!--                                            --><?php //$res = my_query("SELECT * FROM tbl_constants WHERE category='User Type'");
//                                            for ($ii = 1; $r = $res->fetch(); $ii++) { ?>
<!--                                                <option --><?//= ($row['role'] == $r['value'] ? 'selected' : ''); ?><!-- value="--><?//= $r['value']; ?><!--">--><?//= $r['value']; ?><!--</option>-->
<!--                                            --><?php //} ?>
<!--                                        </select>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->

                            <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">REG #</label>
                                        <input name="userNo" type="text" class="form-control" value="<?= $row['userNo']; ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Firstname</label>
                                        <input name="fname" type="text" value="<?= $row['fname']; ?>" class="form-control"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Lastname</label>
                                        <input name="lname" type="text" value="<?= $row['lname']; ?>" class="form-control"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Middlename</label>
                                        <input name="mname" type="text" value="<?= $row['mname']; ?>" class="form-control"
                                               required>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row form-group">
                            <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Birth Date</label>
                                        <input name="bday" type="date" class="form-control" value="<?= $row['bday']; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Age</label>
                                        <input name="age" type="number" value="<?= $row['age']; ?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">

                                        <label class="form-label">Gender</label>
                                        <select name="gender" class="form-control" required>
                                            <option><?= $row['gender']; ?></option>
                                            <option>Female</option>
                                            <option>Male</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Email</label>
                                        <input name="email" type="email" value="<?= $row['email']; ?>" class="form-control"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Contact</label>
                                        <input name="contact" type="text" value="<?= $row['contact']; ?>"
                                               class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Address</label>
                                        <input name="address" type="text" value="<?= $row['address']; ?>"
                                               class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">

                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Username</label>
                                        <input name="username" type="text" value="<?= $row['username']; ?>"
                                               class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Password </label>
                                        <input name="password" type="text" class="form-control" value="<?= endecrypt($row['password'], 'd'); ?>" required>
                                    </div>
                                    <!--                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one special characters, one number and one uppercase and lowercase letter, and at least 6 or more characters"-->
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="IU<?= $title; ?>" name="func_param" class="btn btn-warning waves-effect">
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
                                           id="removeNo"> <?= $row['userNo'] . ' ' . $row['fname'] . ' ' . $row['lname']; ?>
                                        </a>
                                    </b>
                                </i> )
                                information? <br/>There is NO undo! </h4>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" value="deleteTrainee" name="func_param"
                                class="btn btn-danger waves-effect">
                            DELETE
                        </button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>


    <script type="text/javascript">
        function showUsername() {
            document.getElementById('username').value = document.getElementById("emailAdd").value;
        }

    </script>

<?php include_once('layout/footer.php'); ?>