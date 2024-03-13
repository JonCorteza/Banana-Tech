<?php
require_once "config.php";

if($_GET['r']){  
 $id=$_GET['a']; 
 $r=$_GET['r']; 
 
    if($r <= 100 ){
        $stat ='Not Available';
        $ss='Park In';
    }else{
        $stat ='Available';
         $ss='';
    
    }
    
    
    $query = db_update('tbl_parks', ['sub_status'=>$ss,'status'=>$stat],['id'=>$id]); 
}  


?>