

<div id="right-panel" class="right-panel">


    <!-- Header-->
    <header id="header" class="header">
        <div class="top-left">
            <div class="navbar-header">
                <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
                <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            </div>
        </div>
        <div class="top-right">
            <div class="header-menu">


                <?= $_SESSION['fullname'] . '<br/>' . $user_role.' '.$user_id; ?>


                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="user-avatar rounded-circle" src="images/images.png" alt="User Avatar">
                    </a>

                    <div class="user-menu dropdown-menu">

                            <a href=""  class="dropdown-item" data-toggle="modal" data-target="#changePassword">
                                <i class="fa fa -cog"></i>  ChangePassword
                            </a>
                          
                                 <a class="dropdown-item"   data-toggle="modal" data-target="#changeProfile" href=""  >
                                Update Profile
                            </a>
                            
                            <a class="dropdown-item"  href="logout.php" onclick="return  confirm('Are you sure ?')">
                                Sign Out
                            </a>

                    </div>
                </div>


            </div>
        </div>
    </header><!-- /header -->
    <!-- Header-->

    <!--    MAIN CONTENT-->
    <div class="content">
        <!-- Right Panel -->
        <div class="box-title">  <?php if (isset($_GET['r'])): ?>
                <?php
                $r = $_GET['r'];
                if ($r == 'added') {
                    $classs = 'success';
                } else if ($r == 'updated') {
                    $classs = 'warning';
                } else if ($r == 'deleted') {
                    $classs = 'danger';
                } else {
                    $classs = 'hide';
                }
                ?>
                <div class="alert alert-dismissible alert-<?php echo $classs ?> <?php echo $classs; ?>">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong> <?= (isset($_GET['msg']) ? $_GET['msg'] : 'Successfully ' . $r); ?>
                        !</strong>
                </div>
            <?php endif; ?>
        </div>



