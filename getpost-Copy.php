<?php include('config.php');

//NODEMCU FUNCTION
//Park IN
if (isset($_GET['pinid'])) {
    $id = $_GET['pinid'];
    db_update('tbl_parks', ['sub_status' => 'Park In', 'status' => 'Not Available'], ["id" => $id]);
}

//Park OUT
if (isset($_GET['poutid'])) {
    $id = $_GET['poutid'];
    db_update('tbl_parks', ['sub_status' => '', 'status' => 'Available'], ["id" => $id]);
}

//END NODEMCU FUNCTION



//IF RFID TAP
if (isset($_GET['id'])) {
    $rfid = $_GET['id'];
    $cat= $_GET['c'] ; 


     if ($cat == 'Reg') {
        db_update('tbl_constants', ['value' => $rfid], ["category" => 'RFID']);
         exit();
     } else if ($cat == 'In') {
 
     } elseif ($cat == 'Out') {
 
     } else {
 
    }

    $reserve_hr = 0;

    //Alamin kung naka IN or out
    $result = my_query("SELECT   *,rfidno,r.id rid  FROM tbl_parks p
    INNER JOIN tbl_reservations r ON p.id=r.park_id INNER JOIN tbl_users u ON u.id=r.user_id WHERE  rfidno LIKE '%$rfid%'  AND xdate='$dateNow'    LIMIT 1");
    if ($row = $result->fetch()) { //If Have Reservation
        $rid = $row['rid'];
        $card_type = $row['card_type'];
        $guest_type = $row['guest_type'];
        $balance = $row['balance_amount'];
        $userid = $row['user_id'];

        if ($row['park_in'] == NULL) {  //Park In
            db_update('tbl_reservations', ['status' => 'Park In', 'park_in' => $timeNow], ["id" => $rid]);
            $message = "Successfully Parking.";
//            echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
//            exit();
        } else {  //Park Out
            db_update('tbl_reservations', ['park_out' => $timeNow], ["id" => $rid]);

            $res = my_query("SELECT   *  FROM   tbl_reservations  WHERE  id='$rid'   ");
            if ($r = $res->fetch()) {
                //Compute hours
                if ($r['time_arrival'] == NULL) {
                    $reserve_hr = 0;
                } else {
                    $reserve_hr = datediffPark($r['time_reserved'], $r['time_arrival']);
                }

                $park_hr = datediffPark($r['park_in'], $r['park_out']);

                //Total Hours
                $tthr = $reserve_hr + $park_hr;
                //Get and Compute Fare
                //  `$card_type`, `is_walkin`, `amount_per_hr`, `suceeding_amount`, `comments`, `created_at` FROM `tbl_fares`

                //$card_type , $guest_type
                $fare = 10 * $tthr; //GET FROM DATABASE FARE  PER HR
                if ($card_type <> 'Guest') {
                    $discount = ($fare * .20);
                } else {
                    $discount = 0;
                }
                $sub_total = $fare;
                $penalty = $r['penalty'];
                $total = (($sub_total + $r['penalty']) - $discount);

                if ($total > $balance) {

                    $message = "Insufficient Balance.  Balance: " . $balance . " <br/> Cost: " . $total;
//                    echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
//                    exit();
                } else {
                    db_update('tbl_reservations', ['total_hr' => $tthr, 'sub_total' => $fare, 'discount' => $discount, 'penalty' => $penalty, 'total' => $total, 'status' => 'Park Out'], ["id" => $rid]);

                    my_query("UPDATE tbl_users SET balance_amount=balance_amount-$total WHERE id='$userid'");
                    db_insert('tbl_payments', ["user_id" => $userid, "type" => 'Pay Out', "amount" => $total]);
                    $message = "Successfully Park Out.";
//                    echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
//                    exit();
                }
            }
        }
        db_update('tbl_reservations', ['notif' => $message], ["id" => $rid]);

    } else {
        $res = my_query("SELECT   *  FROM   tbl_users  WHERE  rfidno='$rfid'   ");
        if ($r = $res->fetch()) {
            $user_id = $r['id'];
            $card_type = $r['card_type'];

            $res = my_query("SELECT   *  FROM   tbl_parks  WHERE  status='Available'   ");
            if ($r = $res->fetch()) {
                $park_id = $r['id'];
            } else {
                $message = "No parking available";
            }

            $reserveNo = rand_strInt('7','s');
            $message = "Successfully Parking Guest Walkin";
            $data = array("reserveNo"=>$reserveNo, "park_id" => $park_id, 'user_id' => $user_id, 'card_type' => $card_type, 'guest_type' => 'Walkin', 'park_in' => $timeNow,
                'notif' => $message, 'status' => 'Park In');
            db_insert('tbl_reservations', $data);

        } else {
            //No Data Record

        }


    }


    // echo   "%". $id . "%" .  $stat . "%" .  "3". "%" .  "4";

}


?>
