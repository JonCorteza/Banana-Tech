<?php include('headF.php'); ?>
<style>
    input[type=email] {
        background-color: #f6f6f6;
        border: none;
        color: #0d0d0d;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 5px;
        width: 85%;
        border: 2px solid #f6f6f6;
    }
    input[type=password] {
        background-color: #f6f6f6;
        border: none;
        color: #0d0d0d;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 5px;
        width: 85%;
        border: 2px solid #f6f6f6;
    }
</style>
<?=addSpace(20);?>

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
                    Reset Password
                    <!-- Login Form -->
                    <form class="form-horizontal" action="models/do.php?do=resetPassword" method="POST">
                        <input type="email"  id="login" class="fadeIn second" name="email" placeholder="Your Email" autofocus required>
                        <input type="password"  id="login" class="fadeIn second" name="newpass" placeholder="Your New Password"  required>
                        <input type="password"  id="login" class="fadeIn second" name="conpass" placeholder="Your Confirm Password"  required>
                        <input type="submit" class="fadeIn fourth" value="Submit">
                    </form>

                    <!-- Remind Passowrd -->
<!--                    <div id="formFooter">-->
<!--                        <a class="underlineHover" href="signup.php">New User? Sign up</a><br/>-->
<!--                        <a class="underlineHover" href="signin.php">Already know your password? Sign in</a><br/>-->
<!--                    </div>-->

                    <div id="formFooter">
                        <a class="underlineHover" href="index.php"><< BACK </a><br/>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
</body>
</html>