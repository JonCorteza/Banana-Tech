<?php include('headF.php'); ?>
<body   ><?=newline(4);?>
<div class="view full-page-intro" style="background-repeat: no-repeat; background-size: cover;">
    <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row wow fadeIn">
                <div class="col-md-6 mb-4 white-text text-center text-md-left">
                    <h5 style="color: black"> <?=$tt;?></h5>
                    <hr class="hr-light">
                    <p>
                        <strong> </strong>
                    </p>
                    <p class="mb-4 d-none d-md-block">
                        <strong style="color: black">
						TERMS AND CONDITION : <br/>
							<?=$system_description;?>
						</strong>
						<p class="justified">
					    Visitors, People with Disabilities (PWD), and Senior Citizens are the three groups of users who utilise our parking reservation system. Users must establish accounts with correct information to be able to access the system. We maintain data security and privacy by abiding by all applicable data protection regulations. Accounts are valid until they are closed for infractions or prolonged inactivity. Reloadable RFID cards can be used by users to gain access to parking. With the help of actual mapping services, our system provides booking functionality based on availability. It is your duty to protect RFID cards and notify any loss or theft. For the system to function well, make sure the information on your account is correct. While our system strives for maximum functioning, we aren't responsible for any violations that occur. Please read our terms carefully.
					    </p>
                    </p>

                    <div class="fadeIn first">
                        <img src="assets/img/logo.png"   width="100%" alt="User Icon" />
                    </div>

                </div>
                <div class="col-md-6 col-xl-5 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal m-t-10"  method="POST" action="models/user.php?do=saveRegistration">
                                <input type="hidden" name="userRole" value="Org">
                                <p class="h4 text-center mb-4">Sign up</p>
                                <div class="md-form">
                                    <i class="fa fa-user prefix grey-text"></i>
                                    <label for="">Your Name </label>
                                    <input type="text" name="name" id="" placeholder="ex.(lastname,firstname)" class="form-control" autofocus required>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-exclamation-triangle prefix grey-text"></i>
                                    <label for="">Your Contact</label>

                                    <input type="text" class="form-control"  name="contact"  placeholder="(ex. 09 502 *** ***)"    minlength="11" maxlength="11"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  pattern="[0-9]+.{10,}" title="Must contain at least 11 digit" required/>
                                </div>
                                <div class="md-form">
                                    <i class="fa fa-envelope prefix grey-text"></i>
                                    <label for="materialFormRegisterEmailEx">Your Email</label>
                                    <input type="email" name="email" id="materialFormRegisterEmailEx" class="form-control" required>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-envelope prefix grey-text"></i>
                                    <label for="materialFormRegisterEmailEx">Your Address</label>
                                    <input type="text" name="address" id="materialFormRegisterAddressEx" class="form-control" required>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-lock prefix grey-text"></i>
                                    <label for="">Your Password</label>
                                    <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one special characters, one number and one uppercase and lowercase letter, and at least 6 or more characters" class="form-control" name="password" placeholder="Password" required>

                                </div>
                                <div class="md-form">
                                    <i class="fa fa-exclamation-triangle prefix grey-text"></i>
                                    <label for="">Confirm Your Password</label>
                                    <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one special characters, one number and one uppercase and lowercase letter, and at least 6 or more characters" class="form-control" name="cpassword" placeholder="Confirm Password" required>

                                </div>
                                <div class="form-check">
                                    <br/>
                                    <div class="text-right">Already have account?
                                        <a href="signin.php" class="  blue-text">Sign in</a>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button class="btn btn-primary" type="submit" data-toggle="modal" data-target="#myModal">
                                        Register
                                    </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>