<?php
require_once "../config.php";

ualt("Logout");

error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_DEPRECATED);

    if (session_destroy()) {
        echo "<script type='text/javascript'>window.location.href='../index.php?r=logout';</script>";
    }



?>