<?php include_once('layout/head.php'); ?>
<?php $title = 'User'; ?>


<?php

$result = $db->prepare("SELECT 
(SELECT COUNT(*) FROM tbl_reservations  WHERE date(created_at)=CURDATE()) AS tt1, 
(SELECT COUNT(*) FROM tbl_reservations  WHERE date(created_at)=CURDATE()-1) AS tt2, 
(SELECT COUNT(*) FROM tbl_reservations WHERE date(created_at)>=(DATE(NOW()) - INTERVAL 7 DAY )) AS tt3, 
(SELECT COUNT(*) FROM tbl_users WHERE plate_no <> '') AS tt4, 
(SELECT COUNT(*) FROM tbl_users  ) AS tt5, 
(SELECT COUNT(*) FROM tbl_users  ) AS tt6   ");
$result->execute();
if ($row = $result->fetch()) { ?>


    <!-- Content -->
    <div class="content">
        <!-- Animated -->
        <div class="animated fadeIn">
            <!-- Widgets  -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-1">
                                    <i class="pe-7s-car"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count"><?= $row['tt1']; ?></span></div>
                                        <div class="stat-heading">Todays Vehicle Entries</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">

                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-2">
                                    <i class="pe-7s-car"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count"><?=  $row['tt2']; ?></span></div>
                                        <div class="stat-heading">Yesterdays Vehicle Entries</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-3">
                                    <i class="pe-7s-car"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count"><?=  $row['tt3']; ?></span></div>
                                        <div class="stat-heading">Last 7 days Vehicle Entries</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-4">
                                    <i class="pe-7s-car"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count"><?=  $row['tt4']; ?></span></div>
                                        <div class="stat-heading">Total Vehicle Entries</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-1">
                                    <i class="pe-7s-user"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count"><?=  $row['tt5']; ?></span></div>
                                        <div class="stat-heading">Total Registered Users</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-1">
                                    <i class="pe-7s-file"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count"><?=  $row['tt6']; ?></span></div>
                                        <div class="stat-heading">Listed Profiles</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Widgets -->
        </div>
        <!-- .animated -->
    </div>


    <?php
} ?>
    <script type="text/javascript">
        function showUsername() {
            document.getElementById('username').value = document.getElementById("emailAdd").value;
        }

    </script>

<?php include_once('layout/footer.php'); ?>