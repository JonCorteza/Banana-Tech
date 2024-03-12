<?php include('headF.php'); ?>

<?= addSpace(20); ?>

<div class="view full-page-intro">

    <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
        <div class="container ">
            <div class="wrapper fadeInDown">

                <div class="row fadeIn content-center">
                    <div class="col-md-1">

                    </div>
                    <div class="col-md-10  white-text text-center text-md-center">
                        <h5 style="color: white;"> <?= $tt; ?></h5>
                        <hr class="hr-light">
                    </div>
                    <div class="col-md-1">

                    </div>
                </div>

                <div id="formContent">
                    <!-- Tabs Titles -->

                    <?= newline(2); ?>
                    <!-- Icon -->
                    <div class="fadeIn first">
                        <img src="main/images/logo2.png" id="icon" alt="User Icon"/>
                    </div>

                    <?= newline(2); ?>
                    <!-- Login Form -->
                    <form method="POST" action="main/models/user.php" class="form-horizontal m-t-10">
                        <input type="text" id="login" class="fadeIn second" name="username" placeholder="Your Email" autofocus required>
                        <input type="password" id="password" class="fadeIn third" name="password" placeholder="Your Password" required>
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Show password</label>
                        </div>
                        <input type="hidden" name="func_param" value="login" class="fadeIn fourth">  </input>
                        <button type="submit" class="fadeIn fourth btn btn-primary">Login</button>
                    </form>

                    <!-- Remind Passowrd -->
                    <div id="formFooter">
                        <a class="underlineHover" href="signup.php">New User? Sign up</a><br/>
                        <a class="underlineHover" href="forgot-password.php">Forgot Password?</a><br/>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>
</body>
</html>