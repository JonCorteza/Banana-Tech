<?php
if (!isset($_SESSION)) {
    session_start();
}

function db_connect()
{
    // $hostname = "localhost";
    // $dbname = "bananatechpark";
    // $username = "root";
    // $password = "";

    //For Live
    $hostname = "localhost";
    $dbname = "u156797878_bananatechpark";
    $username = "u156797878_root";
    $password = "Bananatechpark_123";


    $db = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}

function db_get_result($tableName, $column, $where)
{
    $db = db_connect();
    $stringWhere = "";
    $value = "";
    $array = array();

    foreach ($where as $key => $values) {
        $stringWhere .= $key . "= '" . $values . "' AND ";
        $array[":" . $key] = $values;
    }

    $stringWhere = substr($stringWhere, 0, -4);
    $query = "SELECT " . $column . " FROM " . $tableName . " WHERE " . $stringWhere;

    try {
        $sth = $db->query($query);
        if (!empty($sth)) {
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            $value = $row[$column];

        } else $value = "";
    } catch (PDOException $e) {

    }

    return $value;
}

function db_update($tableName, $data, $where)
{
    $db = db_connect();
    $stringValues = "";
    $stringWhere = "";
    $array = array();

    foreach ($data as $key => $value) {
        $stringValues .= $key . " = :" . $key . ",";
        $array[":" . $key] = $value;
    }

    foreach ($where as $key => $values) {
        $stringWhere .= $key . "= :" . $key . " AND ";
        $array[":" . $key] = $values;
    }

    $boolean = "";
    $stringWhere = substr($stringWhere, 0, -4);
    $stringValues = substr($stringValues, 0, -1);
    $query = "UPDATE $tableName SET " . $stringValues . " WHERE " . $stringWhere;


    try {
        $sth = $db->prepare($query);
        $sth->execute($array);
        $boolean = true;
    } catch (PDOException $e) {
        $boolean = false;
    }

    return $boolean;
}

function db_insert($tableName, $data)
{
    $db = db_connect();
    $stringValues = "";
    $stringInit = "";
    $stringParam = "";
    $array = array();
    foreach ($data as $key => $value) {
        $stringInit .= $key . ",";
        $stringValues .= ":" . $key . ",";
        $array[":" . $key] = $value;
    }
    $boolean = "";
    $stringInit = substr($stringInit, 0, -1);
    $stringValues = substr($stringValues, 0, -1);
    $query = "INSERT INTO $tableName (" . $stringInit . ") VALUES(" . $stringValues . ")";
    try {
        $sth = $db->prepare($query);
        $sth->execute($array);
        $boolean = $db->lastInsertId();

    } catch (PDOException $e) {
        $boolean = $e;
    }

    return $boolean;
}

function last_insert()
{
    $db = db_connect();
    return $db->lastInsertId();
}


function db_delete($tableName, $data)
{
    $db = db_connect();
    $stringWhere = "";

    $array = array();

    foreach ($data as $key => $values) {
        $stringWhere .= $key . "= :" . $key . " AND ";
        $array[":" . $key] = $values;
    }

    $boolean = "";
    $stringWhere = substr($stringWhere, 0, -4);
    $query = "DELETE FROM $tableName WHERE " . $stringWhere;

    try {
        $sth = $db->prepare($query);
        $sth->execute($array);
        $boolean = true;
    } catch (PDOException $e) {
        $boolean = $e;
    }

    return $boolean;
}

function isExists($tableName, $where)
{
    $db = db_connect();
    $boolean = "";
    $where_string = "";
    foreach ($where as $key => $values) {
        $where_string .= $key . "= '" . $values . "' AND";
    }
    $where_string = substr($where_string, 0, -4);

    try {
        $query = "SELECT * FROM $tableName WHERE " . $where_string;
        $sth = $db->query($query);
        if ($sth->rowCount() > 0) $boolean = true;
        else $boolean = false;
    } catch (PDOException $e) {
        $boolean = false;
    }

    return $boolean;
}

function db_response($query)
{
    if ($query) echo json_encode(array('success' => true)); else echo json_encode(array('success' => false));
}


function db_select_where($tableName, $where)
{
    $db = db_connect();
    $stringWhere = "";
    $array = array();

    foreach ($where as $key => $values) {
        $stringWhere .= $key . " = '" . $values . "' AND ";
        $array[":" . $key] = $values;
    }
    $stringWhere = substr($stringWhere, 0, -4);

    $query = "SELECT * FROM $tableName  WHERE $stringWhere";
    $value = $db->query($query);
    return $value;
}

function db_error($e)
{
    echo json_encode(array("success" => false, "message" => $e));
}

function db_count($tableName, $where)
{
    $db = db_connect();
    $stringWhere = "";
    $array = array();
    $count = 0;

    foreach ($where as $key => $values) {
        $stringWhere .= $key . " = '" . $values . "' AND ";
        $array[":" . $key] = $values;
    }
    $stringWhere = substr($stringWhere, 0, -4);
    $query = "SELECT COUNT(*) as n FROM $tableName WHERE $stringWhere";
    try {
        $sth = $db->query($query);
        if (!empty($sth)) {
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            $count = $row['n'];
        }
    } catch (Exception $e) {
        $count = 0;
    }

    return $count;
}

//My Function ==================================
function my_query($qry)
{
    $db = db_connect();
    $query = $qry;
    $value = $db->query($query);
    return $value;
}

function peso_format($amount)
{
    $amount = number_format($amount, 2, ".", ","); // returns: 1,23
    if ($amount == '0.00') {
        $amount = "0.00";
    }
    //$amount = "<a class='text-align: right;'>".$amount."</a>";

    return $amount;
}

function format_date($val)
{
    if ($val <> '') {
        $val = date('M. d, Y ', strtotime($val));
    }
    return $val;
}

function format_time($val)
{
    if ($val <> '00:00:00') {
        $val = date('h:i A', strtotime($val));
    }
    return $val;
}

function format_datetime($val)
{
    if ($val <> '') {
        $val = date('M. d, Y h:i A', strtotime($val));
    }
    return $val;
}

function status($x)
{
    if ($x == 'Pending') {
        $status = 'info';
    } elseif ($x == 'Approved') {
        $status = 'warning';
    } elseif ($x == 'Completed') {
        $status = 'success';
    } elseif ($x == 'Cancelled') {
        $status = "danger";
    } else {
        $status = 'default';
    }
    return " <span class='label label-$status'> $x </span> ";
}

function addSpace($no)
{
    $data = '';
    for ($i = 0; $i < $no; $i++) {
        $data = $data . "&nbsp;";
    }
    return $data;
}


//Declaration
$db = db_connect();
date_default_timezone_set('Asia/Manila');
$dateTimeNow = date('Y-m-d H:i:sa');
$dateNow = date('Y-m-d');
$timeNow = date('h:i A');

//Change
$system_title = "Banana Tech Smart Parking System";
$system_description = "Banana Tech Smart Parking System";
$shortTitle = "   Parking System ";
$tt = "Banana Tech Smart Parking System";
$server_email = "bananatech@phsite.tech";
$defaultPassword = 'd3f@uLt2021';

(isset($_SESSION['user_id']) ? $user_id = $_SESSION['user_id'] : '');
(isset($_SESSION['role']) ? $user_role = $_SESSION['role'] : '');

function autoGenNo($cat)
{
    $val = strtoupper(substr(md5(mt_rand()), 0, 7));
    return $val;
}

function ualt($action)
{
    $data = array("userId" => $_SESSION['user_id'], "action" => $action);
    $query = db_insert('tbl_ualt', $data);
}

function rand_strInt($length, $x)
{
    if ($x == 's') {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    } else {
        $chars = "0123456789";
    }
    return substr(str_shuffle($chars), 0, $length);
}

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == "") { //For main user only
        $user_id = $_SESSION['user_id'];
        $strW = " WHERE reg_id='$user_id'";
        $strA = " AND reg_id='$user_id'";
    } else {
        $strW = '';
        $strA = '';
    }
}

function custom_echo($x, $length)
{
    if (strlen($x) <= $length) {
        echo $x;
    } else {
        $y = substr($x, 0, $length) . '...';
        echo $y;
    }
}

function newline($valNewline)
{
    $data = "";
    for ($i = 0; $i < $valNewline; $i++) {
        $data = $data . "<br/>";
    }

    return $data;
}

function endecrypt($string, $action = 'e')
{
    // you may change these values to your own
    $_SESSION['key'] = 'imBlessed@o1';
    $secret_key = $_SESSION['key'];
    $secret_iv = $_SESSION['key'];

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if ($action == 'e') {
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    } else if ($action == 'd') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

function datediffPark($timeFrom,$timeTo)
{
    $to_time = strtotime("2022-12-24 $timeFrom");
    $from_time = strtotime("2022-12-24 $timeTo");
    $val= round((abs($to_time - $from_time) / 60)/60,0);
    return $val;
}


$reserve_fee=20;
$park_fee = 50;
//7ed956
?>
