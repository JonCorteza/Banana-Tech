<?php
require_once "../../config.php";
$function = $_POST['func_param'];

switch ($function) {

    case "addReserve":
        $res = my_query("SELECT * FROM tbl_parks WHERE status='Available' AND sub_status='' LIMIT 1");
        if ($r = $res->fetch()) {
            // $park_id = $r['id'];
            // $park_id = "";
            // $parkingNonPriorityIds = [3, 4];

            // foreach ($parkingNonPriorityIds as $nonPriorityId) {
            //     $parkingQuery = my_query("SELECT * FROM tbl_parks WHERE status='Available' AND sub_status='' AND id=$nonPriorityId LIMIT 1");
    
            //     if ($parkingOutput = $parkingQuery->fetch()) {
            //         $park_id = $parkingOutput['id'];
            //     }
            // }

            //New Code
            //Fetch User
            $userId = $_POST['user_id'];
            $query = my_query("SELECT * FROM tbl_users WHERE id='$userId' LIMIT 1");
            $data = $query->fetch();

            // Check Card Type
            if ($data['card_type'] == 'Senior' || $data['card_type'] == 'PWD') {
                $park_id = "";
                $priorityParkingIds = [1, 2];

                foreach ($priorityParkingIds as $priorityId) {
                    $parkingQuery = my_query("SELECT * FROM tbl_parks WHERE status='Available' AND sub_status='' AND id=$priorityId LIMIT 1");

                    if ($parkingOutput = $parkingQuery->fetch()) {
                        $park_id = $parkingOutput['id'];
                        break; // Exit the loop if a parking space is found
                    }
                }

                $reserve_hr = datediffPark($_POST['time_reserved'], $_POST['time_arrival']);
                $reserveNo = rand_strInt('7', 's');
                $data = array(
                    "reserveNo" => $reserveNo, "park_id" => $park_id, "user_id" => $userId,
                    "time_reserved" => $_POST['time_reserved'], "time_arrival" => $_POST['time_arrival'], "reserve_hr" => $reserve_hr, "status" => 'Reserved',
                    "card_type" => $_SESSION['card_type'], "guest_type" => 'Reserved'
                );

                $query = db_insert('tbl_reservations', $data);
                $query = db_update('tbl_parks', ["sub_status" => 'Reserved', 'user_id' => $userId], ["id" => $park_id]);
                echo "<script type='text/javascript'>window.location.href='../manage-bookings.php';</script>";
            } else {
                $park_id = "";
                $parkingNonPriorityIds = [3, 4];

                foreach ($parkingNonPriorityIds as $nonPriorityId) {
                    $parkingQuery = my_query("SELECT * FROM tbl_parks WHERE status='Available' AND sub_status='' AND id=$nonPriorityId LIMIT 1");

                    if ($parkingOutput = $parkingQuery->fetch()) {
                        $park_id = $parkingOutput['id'];
                        break; // Exit the loop if a parking space is found
                    }
                }

                $reserve_hr = datediffPark($_POST['time_reserved'], $_POST['time_arrival']);
                $reserveNo = rand_strInt('7', 's');
                $data = array(
                    "reserveNo" => $reserveNo, "park_id" => $park_id, "user_id" => $userId,
                    "time_reserved" => $_POST['time_reserved'], "time_arrival" => $_POST['time_arrival'], "reserve_hr" => $reserve_hr, "status" => 'Reserved',
                    "card_type" => $_SESSION['card_type'], "guest_type" => 'Reserved'
                );

                $query = db_insert('tbl_reservations', $data);
                $query = db_update('tbl_parks', ["sub_status" => 'Reserved', 'user_id' => $userId], ["id" => $park_id]);
                echo "<script type='text/javascript'>window.location.href='../manage-bookings.php';</script>";
            }

        } else {
            $message = "No available parking.";
            echo "<script type='text/javascript'>alert('$message');window.location.href='../index.php#parking';</script>";
            exit();
        }

        // $reserve_hr = datediffPark($_POST['time_reserved'], $_POST['time_arrival']);
        // $reserve_total = $reserve_hr * $reserve_fee;
        // $reserveNo = rand_strInt('7','s');
        // $data = array("reserveNo" => $reserveNo, "park_id" => $park_id, "user_id" => $user_id,
        //     "time_reserved" => $_POST['time_reserved'], "time_arrival" => $_POST['time_arrival'], "reserve_hr" => $reserve_hr  , "status" => 'Reserved',
        //     "card_type"=>$_SESSION['card_type'], "guest_type"=>'Reserved'
        // );


        // $query = db_insert('tbl_reservations', $data);
        // $query = db_update('tbl_parks', ["sub_status" => 'Reserved','user_id'=>$user_id], ["id" => $park_id]);
        // echo "<script type='text/javascript'>window.location.href='../manage-bookings.php';</script>";

        break;

    //Fare
    case "IUFare" :
        $data = array("card_type" => $_POST['card_type'], "is_walkin" => $_POST['is_walkin']  , "amount_per_hr" => $_POST['amount_per_hr']
        , "succeed_hr" => $_POST['succeed_hr'], "suceeding_amount" => $_POST['suceeding_amount']);

        if (isset($_POST['id'])) {  //Update
            $id = $_POST['id'];
            $where = array('id' => $id);
            $query = db_update('tbl_fares', $data, $where);
            echo "<script type='text/javascript'>window.location.href='../fares.php?r=updated';</script>";
        } else {
            $query = db_insert('tbl_fares', $data);
            echo "<script type='text/javascript'>window.location.href='../fares.php?r=added';</script>";
        }
        break;

    case "deleteFare" :
        $id = $_POST['id'];
        $where = array('id' => $id);
        $query = db_delete('tbl_fares', $where);
        echo "<script type='text/javascript'>window.location.href='../fares.php?r=deleted';</script>";
        break;


    case "addPenalty" :
        $data = array("penalty" => $_POST['penalty']);
        $id = $_POST['id'];
        $where = array('id' => $id);
        $query = db_update('tbl_reservations', $data, $where);
        echo "<script type='text/javascript'>window.location.href='../reservations.php?r=updated';</script>";
        break;

    //Parkings
    case "IUParkings" :
        $reserve_hr = datediffPark($_POST['time_reserved'], $_POST['time_arrival']);
        $reserve_total = $reserve_hr * $reserve_fee;

        $park_hr = datediffPark($_POST['park_in'], $_POST['park_out']);
        if ($_POST['park_out'] == '') {
            $park_hr = 0;
        }
        $park_total = $park_hr * $park_fee;

        //Computation
        $overall_amt = $reserve_total + $park_total;
        $payment_amt = 0;
        $balance = $overall_amt - $payment_amt;
        $status = $_POST['status'];

        if ($status == 'Reserved') {
            $stat = 'Not Available';
        } elseif ($status == 'Park In') {
            $stat = 'Not Available';
        } elseif ($status == 'Park Out') {
            $stat = 'Available';
        } elseif ($status == 'Available') {
            $stat = 'Available';
        } else {
            $stat = 'Available';
        }
        $query = db_update('tbl_parks', ["status" => $stat], ["id" => $_POST['park_id']]);

        $data = array("park_id" => $_POST['park_id'], "user_id" => $_POST['user_id'],
            "time_reserved" => $_POST['time_reserved'], "time_arrival" => $_POST['time_arrival'], "reserve_hr" => $reserve_hr, "reserve_total" => $reserve_total,
            "park_in" => $_POST['park_in'], "park_out" => $_POST['park_out'], "park_hr" => $park_hr, "park_total" => $park_total,
            "payment_amt" => $payment_amt, "overall_amt" => $overall_amt, "status" => $status);

        if (isset($_POST['id'])) {  //Update
            $id = $_POST['id'];
            $where = array('id' => $id);
            $query = db_update('tbl_parkings', $data, $where);
            echo "<script type='text/javascript'>window.location.href='../index.php#parking';</script>";
        } else {
            $query = db_insert('tbl_parkings', $data);
            echo "<script type='text/javascript'>window.location.href='../index.php#parking';</script>";
        }
        break;

    case "deleteParkings" :
        $id = $_POST['id'];
        $where = array('id' => $id);
        $query = db_delete('tbl_parkings', $where);
        echo "<script type='text/javascript'>window.location.href='../index.php#parking';</script>";
        break;



    case "addBalance" :
        $data = array("balance_amount" => $_POST['balance_amount'] + $_POST['balance_amount_add']);

        $id = $_POST['id'];
        $where = array('id' => $id);
        $query = db_update('tbl_users', $data, $where);


        $query = db_insert('tbl_payments', ['user_id'=>$id,'type'=>'Pay In','amount'=>$_POST['balance_amount_add']]);


        echo "<script type='text/javascript'>window.location.href='../rfids.php?r=updated';</script>";

        break;


    //RFID
    case "IURFID" :
        $data = array("plate_no" => $_POST['plate_no'], "card_type" => $_POST['card_type'], "rfidno" => $_POST['rfidno'], "balance_amount" => $_POST['balance_amount']);

        if (isset($_POST['id'])) {  //Update
            $id = $_POST['id'];
            $where = array('id' => $id);
            $query = db_update('tbl_users', $data, $where);
            echo "<script type='text/javascript'>window.location.href='../rfids.php?r=updated';</script>";
        } else {

        }
        break;


    //Parkings
    case "IUParking" :
        $data = array("park_code" => $_POST['park_code'], "lat" => $_POST['lat']
        , "lng" => $_POST['lng']);
        //   `loc_id`, ``, `if_rfid`, `if_reserved` `sub_status`, `status`,

        if (isset($_POST['id'])) {  //Update
            $id = $_POST['id'];
            $where = array('id' => $id);
            $query = db_update('tbl_parks', $data, $where);
            echo "<script type='text/javascript'>window.location.href='../parkings.php?r=updated';</script>";
        } else {
            $query = db_insert('tbl_parks', $data);
            echo "<script type='text/javascript'>window.location.href='../parkings.php?r=added';</script>";
        }
        break;

    case "deleteParking" :
        $id = $_POST['id'];
        $where = array('id' => $id);
        $query = db_delete('tbl_parks', $where);
        echo "<script type='text/javascript'>window.location.href='../parkings.php?r=deleted';</script>";
        break;


//User
    case "IUUser" :
        $temp = $_FILES["pic"]["tmp_name"];
        $pic = $_FILES["pic"]["name"];

        if (isset($_POST['id'])) { //Edit Img
            if ($pic == "") {
                $pic = $_POST['pic1'];
            } else {
                move_uploaded_file($temp, "../../images/user/" . $pic);
            }
        } else {
            if ($pic == "") {
                $pic = 'default.png';
            } else {
                move_uploaded_file($temp, "../../images/user/" . $pic);
            }
        }

        $userNo = $_POST['userNo'];
        $role = 'User';
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mname = $_POST['mname'];
        $username = $_POST['username'];
        $password = endecrypt($_POST['password'], 'e');
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $bday = $_POST['bday'];
        $status = $_POST['status'];


        $data = array("userNo" => $userNo, "fname" => $fname, "lname" => $lname, "mname" => $mname, "username" => $username, "password" => $password, "pic" => $pic,
            "email" => $email, "contact" => $contact, "address" => $address, "gender" => $gender, "age" => $age, "bday" => $bday, "status" => $status, "role" => $role);
        if (isset($_POST['id'])) {  //Update
            $id = $_POST['id'];
            $where = array('id' => $id);
            $query = db_update('tbl_users', $data, $where);
            echo "<script type='text/javascript'>window.location.href='../users.php?t=$role&r=updated';</script>";
        } else {
            $query = db_insert('tbl_users', $data);
            echo "<script type='text/javascript'>window.location.href='../users.php?t=$role&r=added';</script>";
        }
        break;

    case 'deleteUser':
        $id = $_POST['id'];
        $role = $_POST['role'];
        $where = array('id' => $id);
        $data = array('status' => 'Deleted');
        $query = db_update('tbl_users', $data, $where);
        echo "<script type='text/javascript'>window.location.href='../users.php?t=$role&r=deleted';</script>";
        break;


    case "update" . $mainUser . "Profile" :
        $userNo = $_POST['userNo'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mname = $_POST['mname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $bday = $_POST['bday'];

        //  `xagree`, `username`, `password`, `pic`, `status`,

        $data = array("userNo" => $userNo, "fname" => $fname, "lname" => $lname, "mname" => $mname,
            "email" => $email, "contact" => $contact, "address" => $address, "gender" => $gender, "age" => $age, "bday" => $bday);
        $id = $_POST['id'];
        $query = db_update($tbl, $data, ['id' => $id]);
        echo "<script type='text/javascript'>window.location.href='../profile.php?r=updated&id=$id';</script>";
        break;

    //Constant
    case "IUConstant" :
        $category = $_POST['category'];
        $value = $_POST['value'];
        $sub_value = $_POST['sub_value'];
        $data = array("category" => $category, "value" => $value
        , "sub_value" => $sub_value);

        if (isset($_POST['id'])) {  //Update
            $id = $_POST['id'];
            $where = array('id' => $id);
            $query = db_update('tbl_constants', $data, $where);
            echo "<script type='text/javascript'>window.location.href='../constants.php?r=updated';</script>";
        } else {
            $query = db_insert('tbl_constants', $data);
            echo "<script type='text/javascript'>window.location.href='../constants.php?r=added';</script>";
        }
        break;

    case "deleteConstant" :
        $id = $_POST['id'];
        $where = array('id' => $id);
        $query = db_delete('tbl_constants', $where);
        echo "<script type='text/javascript'>window.location.href='../constants.php?r=deleted';</script>";
        break;


} ?>