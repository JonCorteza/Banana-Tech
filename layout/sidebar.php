<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">


                <?php if ($user_role == 'Admin') { ?>

                    <li class=" ">
                        <a href="dashboards.php"><i class="menu-icon fa fa-laptop"></i>Dashboards </a>
                    </li>
                    <li>
                        <a href="users.php"> <i class="menu-icon ti-user"></i> Users</a>
                    </li>
                    <li>
                        <a href="constants.php"> <i class="menu-icon fa fa-cogs"></i> Settings</a>
                    </li>
                    <li>
                        <a href="parkings.php"> <i class="menu-icon ti-email"></i> Parkings</a>
                    </li>

                    <li>
                        <a href="rfids.php"> <i class="menu-icon fa  fa-credit-card "></i> RFIDS</a>
                    </li>

                    <li>
                        <a href="read-tag.php"> <i class="menu-icon fa fa-info"></i> Read Tag</a>
                    </li>


                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon menu-icon ti-truck"></i>Parking Slot</a>
                        <ul class="sub-menu children dropdown-menu">
                            <?php
                            $result = db_select_where('tbl_constants', ["category" => 'Status']);
                            for ($i = 1; $row = $result->fetch(); $i++) { ?>
                                <li>
                                    <i class="fa fa-table"></i><a href="bookings.php?t=<?= $row['value']; ?>"><?= $row['value']; ?> </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>


                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon fa fa-th"></i>Reports</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="menu-icon fa fa-th"></i><a href="reports.php?t=Payments"> Payments</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-th"></i><a href="reports.php?t=Reservations"> Reservations</a>
                            </li>

                        </ul>
                    </li>

                    <li class=" ">
                        <a href="payments.php"><i class="menu-icon fa fa-money"></i>Payments </a>
                    </li>
                    <li class=" ">
                        <a href="fares.php"><i class="menu-icon fa fa-handshake-o"></i>Fares </a>
                    </li>
                    <!--                    <li class=" ">-->
                    <!--                        <a href="reservations.php"><i class="menu-icon fa fa-laptop"></i>Reservation </a>-->
                    <!--                    </li>-->


                <?php } else { ?>
                    <li class=" ">
                        <a href="user-info.php"><i class="menu-icon fa fa-laptop"></i>My Profile </a>
                    </li>
                    <li class=" ">
                        <a href="manage-bookings.php"><i class="menu-icon fa fa-book"></i>Manage Booking </a>
                    </li>
                    <li class=" ">
                        <a href="history.php"><i class="menu-icon fa fa-calendar"></i>History </a>
                    </li>
<!--                    <li class=" ">-->
<!--                        <a href="maps.php"><i class="menu-icon fa fa-map"></i>Maps </a>-->
<!--                    </li>-->

                <?php } ?>
                <li><a href="logout.php" onclick="return  confirm('Are you sure ?')"> <i class="menu-icon ti-user"></i>
                        Logout</a></li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->


