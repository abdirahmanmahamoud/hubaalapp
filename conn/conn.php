<?php
$db = new mysqli('localhost','hblt_hubaal','Maryan@1234567890','hblt_hubaal');
//$db = new mysqli('localhost','root','','hubaal');

if($db->connect_error){
    echo $db->error;
}else{
}
