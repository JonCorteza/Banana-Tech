<?php include('headF.php'); ?>

<div class="view full-page-intro" >

    <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
        <div class="container ">
            <div class="wrapper fadeInDown">


                <div id="formContent">
                    <!-- Tabs Titles -->

                    <!-- Icon -->
                    <div class="fadeIn first">
                        <img src="assets/img/logo.png" width="100%"  alt="User Icon" />
                    </div>

                    <!-- Login Form -->
                    <form class="form-horizontal" action="models/user.php?do=forgotPassword" method="POST">
                        <input type="email"  id="login" class="fadeIn second" name="email" placeholder="Your Email" autofocus>
                        <input type="submit" class="fadeIn fourth" value="Submit">
                    </form>

                    <!-- Remind Password -->
                    <div id="formFooter">
                        <a class="underlineHover" href="signup.php">New User? Sign up</a><br/>
                        <a class="underlineHover" href="signin.php">Already Have Account? Sign in</a><br/>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>
</body>
</html>