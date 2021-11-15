<?php
header('content-type: application/json');
include '../conn/conn.php';
session_start();
if(!$_SESSION['shirkada']){
    $shirkada = $_SESSION['shirkada'];
    header('location: ../index.php');
}
function reg_category($db){
    $data =array();
    extract($_POST);
    $s = "INSERT INTO `category`(`name`, `icon`) VALUES('$name','$icon')";
    $r = $db->query($s);
    if($r){
        $data = array('status' => true,'data' => 'is sax hay ayaah u diwaangalisar');
    }else{
        $data = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($data);
}

function update_category($db){
    extract($_POST);
    $data = array();
    $s = "UPDATE Category SET name='$name',icon='$icon' WHERE id= '$id'";
    $r = $db -> query($s);
    if($r){
        $data = array('status' => true,'data' => 'is sax hay ayaah loo updategareey');
    }
    else{
        $data = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($data);
}

function all_category($db){
    $date = array();
    $mess = array();

    $id = $_POST['id'];
    $s = "SELECT * FROM Category WHERE id = '$id'";
    $r = $db->query($s);
    if($r){
        while($row = $r->fetch_assoc()){
            $date [] = $row;
        }
        $mess = array('status' => true,'data' => $date);
    }else{
        $mess = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($mess);
}

function khar_category($db){
    $date = array();
    $mess = array();
    $s = "SELECT `id`, `name`, `icon`FROM `category`";
    $r = $db->query($s);
    if($r){
        while($row = $r->fetch_assoc()){
            $date [] = $row;
        }
        $mess = array('status' => true,'data' => $date);
    }else{
        $mess = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($mess);
}

function phplink(){
    $data = array();
    $data_array = array();
    $sa = glob('../des/*.php');
    foreach ($sa as $se) {
        $si_link = explode('/',$se);
        $data_array[] = $si_link[2];
    }
    if(count($si_link) > 0){
        $data = array('status' => true,'data' => $data_array);
    }else{
        $data = array('status' => false, 'data' => 'no file ');
    }
    echo json_encode($data);
}

function reg_link($db){
    $data =array();
    extract($_POST);
    $s = "INSERT INTO `link`(`name`, `link`,`category`) VALUES('$name','$link','$category')";
    $r = $db->query($s);
    if($r){
        $data = array('status' => true,'data' => 'is sax hay ayaah u diwaangalisar');
    }else{
        $data = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($data);
}

function update_link($db){
    extract($_POST);
    $data = array();
    $s = "UPDATE link SET name='$name',link='$link',category = '$category' WHERE id= '$id'";
    $r = $db -> query($s);
    if($r){
        $data = array('status' => true,'data' => 'is sax hay ayaah loo updategareey');
    }
    else{
        $data = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($data);
}

function all_link($db){
    $date = array();
    $mess = array();

    $id = $_POST['id'];
    $s = "SELECT * FROM link WHERE id = '$id'";
    $r = $db->query($s);
    if($r){
        while($row = $r->fetch_assoc()){
            $date [] = $row;
        }
        $mess = array('status' => true,'data' => $date);
    }else{
        $mess = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($mess);
}

function khar_link($db){
    $date = array();
    $mess = array();
    $s = "SELECT * FROM `link`";
    $r = $db->query($s);
    if($r){
        while($row = $r->fetch_assoc()){
            $date [] = $row;
        }
        $mess = array('status' => true,'data' => $date);
    }else{
        $mess = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($mess);
}

function khar($db){
    $date = array();
    $mess = array();
    $s = "SELECT category.id,category.name category_name,category.icon,link.id link_id,link.name link_name,link.link,link.category FROM `category`LEFT JOIN link ON category.id = link.category ORDER BY category.id,link.name";
    $r = $db->query($s);
    if($r){
        while($row = $r->fetch_assoc()){
            $date [] = $row;
        }
        $mess = array('status' => true,'data' => $date);
    }else{
        $mess = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($mess);
}

function user($db){
    $date = array();
    $mess = array();
    $s = "SELECT id, username FROM `users` ";
    $r = $db->query($s);
    if($r){
        while($row = $r->fetch_assoc()){
            $date [] = $row;
        }
        $mess = array('status' => true,'data' => $date);
    }else{
        $mess = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($mess);
}
function reg($db){
    extract($_POST);
    $data =array();
    $success = array();
    $error = array();
    $del = "DELETE FROM `user_authority` WHERE user_id = '$user_id'";
    $db = new mysqli('localhost','hblt_hubaal','Maryan@1234567890','hblt_hubaal');
//$db = new mysqli('localhost','root','','hubaal');
    $delete = $db->query($del);
    if($delete){
        for($i = 0; $i < count($link); $i++){
            $s = "INSERT INTO `user_authority`(`user_id`, `link`) VALUES ('$user_id','$link[$i]')";
            $r = $db->query($s);
            if($r){
                $success [] = array('status' => true,'data' => 'waa la diwaangeliyah');
            }else{
                $error [] = array('status' => false, 'data' => $db->error);
            }
        }
    }else{
        $error [] = array('status' => false, 'data' => $db->error);
    }
    if(count($success) > 0 && count($error) == 0){
        $data = array('status' => true,'data' => 'waa sax user authority');
    }elseif(count($error) > 0){
        $data  = array('status' => false, 'data' => $error);
    }
    if(count($error) > 0 && count($success) == 0){
        $data = array('status' => false, 'data' => $error);
    }
  
    echo json_encode($data);
}

function user_authority($db){
    extract($_POST);
    $date = array();
    $mess = array();
    $s = "SELECT category.id category_id,category.name category_name,category.icon category_icon,link.id link_id,link.name link_name,link.link,link.category,user_authority.link link_authority FROM `user_authority` JOIN link ON user_authority.link = link.id JOIN category ON link.category = category.id WHERE user_authority.user_id = '$user_id'";
    $r = $db->query($s);
    if($r){
        while($row = $r->fetch_assoc()){
            $date [] = $row;
        }
        $mess = array('status' => true,'data' => $date);
    }else{
        $mess = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($mess);
}

function menu($db){
    $id = $_SESSION['id'];
    $date = array();
    $mess = array();
    $s = "SELECT category.id category_id,category.name category_name,category.icon category_icon,link.id link_id,link.name link_name,link.link,link.category,user_authority.link link_authority FROM `user_authority` JOIN link ON user_authority.link = link.id JOIN category ON link.category = category.id WHERE user_authority.user_id = '$id' GROUP BY link.id ORDER BY category.id";
    $r = $db->query($s);
    if($r){
        while($row = $r->fetch_assoc()){
            $date [] = $row;
        }
        $mess = array('status' => true,'data' => $date);
    }else{
        $mess = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($mess);
}

if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($db);
}
else{
    echo json_encode(array('status' => false, 'data' => 'action ma jiro'));
}

?>