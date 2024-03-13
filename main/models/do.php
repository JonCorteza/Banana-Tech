<?php
require_once "../../config.php";


if ($_GET['do']=='status') {
    $id=$_GET['id'];
    $stat=$_GET['stat'];
    if ($stat=='Active'){
        $stat='Inactive';
    }else{
        $stat='Active';
    }
    $q = my_query("UPDATE tbl_users set status='$stat'  WHERE id='$id'");

    echo "<script type='text/javascript'>window.location.href='../users.php?r=updated';</script>";
}




if ($_GET['do']=='cancelled') {
    
    $id=$_GET['id'];
    $pid=$_GET['pid'];
    
     my_query("UPDATE tbl_parks set sub_status=''  ,status='Available'  WHERE id='$pid'");
     my_query("UPDATE tbl_reservations set notif='Cancelled Reservation'  ,status='Cancelled'  WHERE id='$id'");
    
        $message = "Successfully cancelled.";
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
    
    
}

?>

