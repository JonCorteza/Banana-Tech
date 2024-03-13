<?php  
include_once('config.php'); 
//Verify SMS
  if(isset($_GET['hash'])){ 
    $hash = $_GET['hash'];   
    $email = $_GET['email'];    

    // $result = $db->prepare("SELECT * FROM tbl_users WHERE email='$email' AND emailCode='$hash'");
    $result = my_query("SELECT * FROM tbl_users WHERE email='$email' AND emailCode='$hash'");
    // $result->execute();
    
    if($row = $result->fetch()) {
      $id=$row['id'];
      $q = db_update('tbl_users', ["registered=>'1"], ["id" => $id]);
    //   $q->execute(array());

      $message = 'Your account has been activated, you can now login';
      echo "<script type='text/javascript'>alert('$message');window.location.href='index.php';</script>";
      exit();

    } else { 
      $message = 'Invalid activation.';
      echo "<script type='text/javascript'>alert('$message');window.location.href='index.php';</script>";
      exit();
    }
}

  