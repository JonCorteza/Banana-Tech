<?php
require_once "../../config.php";
$function = $_POST['func_param'];

if ($function == "signup") {
    $no = $_POST[$mainUserNo];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $password = substr(md5(mt_rand()), 0, 7);
    $username = $_POST['username'];
    $password = $_POST['password'];

    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $bday = $_POST['bday'];

    $temp = $_FILES["pic"]["tmp_name"];
    $pic = $_FILES["pic"]["name"];
    move_uploaded_file($temp, "../../images/$mainUser/" . $pic);
    if ($pic == "") {
        $pic = $_POST['pic1'];
    }
    $subject = "FROM : $system_title New Account Created";
    $emailCode = substr(md5(mt_rand()), 0, 32);

    $txt = "Your username is : $email.\nYour password is : $password.\n
        Please click this link to activate your account:
        http://phsite.tech/confirmation.php?email=$email&hash=$emailCode";

    $to = $email;
    $from = $server_email;
    $headers = "From:" . $from;
    mail($to, $subject, $txt, $headers);

    $data = array("$mainUserNo" => $no, "fname" => $fname, "email" => $email, "contact" => $contact,
        "lname" => $lname, "mname" => $mname, "username" => $username, "password" => $password,
        "address" => $address, "gender" => $gender, "status" => 'Inactive', "emailCode" => $emailCode, "pic" => $pic, "age" => $age, "bday" => $bday, "created_at" => $dateTimeNow);
    $query = db_insert($tbl, $data);
    $message = "Information successfully save.";
    echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
}

if ($function == "updateProfile") {
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $role = $_POST['role'];

    $temp = $_FILES["pic"]["tmp_name"];
    $pic = $_FILES["pic"]["name"];
    move_uploaded_file($temp, "../../images/user/" . $pic);
    if ($pic == "") {
        $pic = $_POST['pic1'];
        $_SESSION['pic'];
    }

    $_SESSION['pic'] = $pic;

    $id = $_SESSION['user_id'];
    $where = array('id' => $id);
    $data = array('pic' => $pic, 'fname' => $fname, 'lname' => $lname);

    $query = db_update('tbl_users', $data, $where);

    $_SESSION['name'] = $fname . ' ' . $lname;
    $message = "Profile successfully updated.";
    echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
}

if ($function == "changePassword") {
    $existpassword = $_SESSION['password'];
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $retypepassword = $_POST['retypepassword'];
    if ($existpassword <> $oldpassword) {
        $message = "Password not matched.";
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
        exit();
    }

    if ($newpassword <> $retypepassword) {
        $message = "Retype password not matched.";
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
        exit();
    }

    $data = array("password" => $newpassword);
    $where = array('id' => $_SESSION['user_id']);

    if ($user_role == $mainUser) {
        $query = db_update($tbl, $data, $where);
    } else {
        $query = db_update('tbl_users', $data, $where);
    }

    $_SESSION['password'] = $newpassword;
    $message = "Password successfully updated.";
    echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
}

if ($function == "login") {
    $username = $_POST['username'];
    $password = endecrypt($_POST['password'], 'e');

    $result = $db->prepare("SELECT *,CONCAT(fname,' ',lname) fullname FROM tbl_users WHERE username='$username' ");
    $result->execute();

    if ($row = $result->fetch()) {
        $id=$row['id'];
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['logged_in'] = "true";
        $_SESSION['user_profile'] = $row['pic'];
        $_SESSION['pic'] = $row['pic'];
        $_SESSION['user_name'] = $row['fullname'];
        $_SESSION['last_login_timestamp'] = time();

        $_SESSION['card_type'] = $row['card_type'];
        $_SESSION['rfidno'] = $row['rfidno'];
        $_SESSION['balance_amount'] = $row['balance_amount'];
        $_SESSION['plateNo'] = $row['plate_no'];

        //!Problem with the decrypting password
        // if ($row['password'] == $password) { //Correct
        //     if( $row['role']=='Admin'){
        //         $message = "Log in successfully.";
        //         echo "<script type='text/javascript'>alert('$message');</script>";
        //         header("Location: ../index.php");
        //         exit();
        //     }else{
        //         $message = "Log in successfully.";
        //         echo "<script type='text/javascript'>alert('$message');window.location.href='../user-info.php';</script>";
        //         exit();
        //     }
        // } else {
        //     if ($row['attempt_no'] == 2) { //Correct
        //         $message = "You have 3 attempts. Your account will disable.";
        //         my_query("UPDATE `tbl_users` SET attempt_no=attempt_no+1  WHERE id='$id'");
        //         echo "<script type='text/javascript'>alert('$message');window.location.href='../index.php';</script>";
        //         exit();
        //     }

        // }
        
        if( $row['role']=='Admin'){
            $message = "Log in successfully.";
            echo "<script type='text/javascript'>alert('$message');</script>";
            header("Location: ../index.php");
            exit();
        }else{
            $message = "Log in successfully.";
            echo "<script type='text/javascript'>alert('$message');window.location.href='../user-info.php';</script>";
            exit();
        }

    } else {
        //
        $message = "Invalid username or password.";
        echo "<script type='text/javascript'>alert('$message');window.location.href='../signin.php';</script>";
        exit();
    }
}

if ($function == "forgotPassword") {
    $email = $_POST['email'];
    $result = my_query("SELECT * FROM $tbl  WHERE email='$email'");
    if ($row = $result->fetch()) {

        $subject = "FROM :  $system_title New Account Created";
        $username = $row['username'];
        $password = $row['password'];
        $txt = "Your username is : $username.\nYour new password is : $password.";

        $to = $email;
        $from = $server_email;
        $headers = "From:" . $from;
        mail($to, $subject, $txt, $headers);
        echo "<script type='text/javascript'>window.location.href='../../forgot-password.php?r=added';</script>";
    } else {
        echo "<script type='text/javascript'>window.location.href='../../forgot-password.php?r=invalid';</script>";
    }
}

// switch ($function) {


//     case "signup" :
//         $no = $_POST[$mainUserNo];
//         $fname = $_POST['fname'];
//         $lname = $_POST['lname'];
//         $mname = $_POST['mname'];
//         $password = substr(md5(mt_rand()), 0, 7);
//         $username = $_POST['username'];
//         $password = $_POST['password'];

//         $email = $_POST['email'];
//         $contact = $_POST['contact'];
//         $address = $_POST['address'];
//         $gender = $_POST['gender'];
//         $age = $_POST['age'];
//         $bday = $_POST['bday'];

//         $temp = $_FILES["pic"]["tmp_name"];
//         $pic = $_FILES["pic"]["name"];
//         move_uploaded_file($temp, "../../images/$mainUser/" . $pic);
//         if ($pic == "") {
//             $pic = $_POST['pic1'];
//         }
//         $subject = "FROM : $system_title New Account Created";
//         $emailCode = substr(md5(mt_rand()), 0, 32);

//         $txt = "Your username is : $email.\nYour password is : $password.\n
// 	Please click this link to activate your account:
// 	http://phsite.tech/confirmation.php?email=$email&hash=$emailCode";

//         $to = $email;
//         $from = $server_email;
//         $headers = "From:" . $from;
//         mail($to, $subject, $txt, $headers);

//         $data = array("$mainUserNo" => $no, "fname" => $fname, "email" => $email, "contact" => $contact,
//             "lname" => $lname, "mname" => $mname, "username" => $username, "password" => $password,
//             "address" => $address, "gender" => $gender, "status" => 'Inactive', "emailCode" => $emailCode, "pic" => $pic, "age" => $age, "bday" => $bday, "created_at" => $dateTimeNow);
//         $query = db_insert($tbl, $data);
//         $message = "Information successfully save.";
//         echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
//         break;

//     case 'updateProfile':
//         $lname = $_POST['lname'];
//         $fname = $_POST['fname'];
//         $role = $_POST['role'];

//         $temp = $_FILES["pic"]["tmp_name"];
//         $pic = $_FILES["pic"]["name"];
//         move_uploaded_file($temp, "../../images/user/" . $pic);
//         if ($pic == "") {
//             $pic = $_POST['pic1'];
//             $_SESSION['pic'];
//         }

//         $_SESSION['pic'] = $pic;

//         $id = $_SESSION['user_id'];
//         $where = array('id' => $id);
//         $data = array('pic' => $pic, 'fname' => $fname, 'lname' => $lname);


//         $query = db_update('tbl_users', $data, $where);



//         $_SESSION['name'] = $fname . ' ' . $lname;
//         $message = "Profile successfully updated.";
//         echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
//         break;

//     case 'changePassword':
//         $existpassword = $_SESSION['password'];
//         $oldpassword = $_POST['oldpassword'];
//         $newpassword = $_POST['newpassword'];
//         $retypepassword = $_POST['retypepassword'];
//         if ($existpassword <> $oldpassword) {
//             $message = "Password not matched.";
//             echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
//             exit();
//         }

//         if ($newpassword <> $retypepassword) {
//             $message = "Retype password not matched.";
//             echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
//             exit();
//         }

//         $data = array("password" => $newpassword);
//         $where = array('id' => $_SESSION['user_id']);

//         if ($user_role == $mainUser) {
//             $query = db_update($tbl, $data, $where);
//         } else {
//             $query = db_update('tbl_users', $data, $where);
//         }

//         $_SESSION['password'] = $newpassword;
//         $message = "Password successfully updated.";
//         echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
//         break;

//     case "login":
//         $username = $_POST['username'];
//         $password = endecrypt($_POST['password'], 'e');

//         $result = $db->prepare("SELECT *,CONCAT(fname,' ',lname) fullname FROM tbl_users WHERE username='$username' ");
//         $result->execute();
//         if ($row = $result->fetch()) {
//             $id=$row['id'];
//             $_SESSION['user_id'] = $row['id'];
//             $_SESSION['fullname'] = $row['fullname'];
//             $_SESSION['role'] = $row['role'];
//             $_SESSION['username'] = $row['username'];
//             $_SESSION['logged_in'] = "true";
//             $_SESSION['user_profile'] = $row['pic'];
//             $_SESSION['pic'] = $row['pic'];
//             $_SESSION['user_name'] = $row['fullname'];
//             $_SESSION['last_login_timestamp'] = time();

//             $_SESSION['card_type'] = $row['card_type'];
//             $_SESSION['rfidno'] = $row['rfidno'];
//             $_SESSION['balance_amount'] = $row['balance_amount'];
//             $_SESSION['plateNo'] = $row['plate_no'];

//             if ($row['password'] == $password) { //Correct
//                 if( $row['role']=='Admin'){
//                     $message = "Log in successfully.";
//                     echo "<script type='text/javascript'>alert('$message');</script>";
//                     header("Location: ../index.php");
//                     exit();
//                 }else{
//                     $message = "Log in successfully.";
//                     echo "<script type='text/javascript'>alert('$message');window.location.href='../user-info.php';</script>";
//                     exit();
//                 }
//             } else {
//                 if ($row['attempt_no'] == 2) { //Correct
//                     $message = "You have 3 attempts. Your account will disable.";
//                     my_query("UPDATE `tbl_users` SET attempt_no=attempt_no+1  WHERE id='$id'");
//                     echo "<script type='text/javascript'>alert('$message');window.location.href='../index.php';</script>";
//                     exit();
//                 }

//             }


//         } else {
//             //
//             $message = "Invalid username or password.";
//             echo "<script type='text/javascript'>alert('$message');window.location.href='../signin.php';</script>";
//             exit();
//         }
//         break;

//     case "forgotPassword":
//         $email = $_POST['email'];
//         $result = my_query("SELECT * FROM $tbl  WHERE email='$email'");
//         if ($row = $result->fetch()) {

//             $subject = "FROM :  $system_title New Account Created";
//             $username = $row['username'];
//             $password = $row['password'];
//             $txt = "Your username is : $username.\nYour new password is : $password.";

//             $to = $email;
//             $from = $server_email;
//             $headers = "From:" . $from;
//             mail($to, $subject, $txt, $headers);
//             echo "<script type='text/javascript'>window.location.href='../../forgot-password.php?r=added';</script>";
//         } else {
//             echo "<script type='text/javascript'>window.location.href='../../forgot-password.php?r=invalid';</script>";
//         }
//         break;
// }


?>


