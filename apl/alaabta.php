<?php
header('content-type: application/json');
include '../conn/conn.php';
session_start();
if(!$_SESSION['shirkada']){
    $shirkada = $_SESSION['shirkada'];
    header('location: ../index.php');
}
function reg($db){
    $id =$_SESSION['shirkada'];
    $data =array();
    extract($_POST);
    $s = "INSERT INTO `alaabta`(`name`, `intaxabu`, `lacagta`, `user_id`) VALUES('$name','$inta_xabu','$lacagta,'$id'')";
    $r = $db->query($s);
    if($r){
        $s = "INSERT INTO `alaabta_ibso`( `name`, `inta_xabu`, `inta_hartay`, `lacagta`, `user_id`, `status`) VALUES('$name','0','$inta_xabu','$lacagta','$id','0')";
        $r = $db->query($s);
        if($r){
            $data = array('status' => true,'data' => 'is sax hay ayaah u diwaangalisar');
        }else{
            $data = array('status' => false, 'data' => $db->error);
    }
    }else{
        $data = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($data);
}
function khar($db){
    $id =$_SESSION['shirkada'];
    $date = array();
    $mess = array();
    $s = "SELECT `id`, `name`, `intaxabu`, `lacagta`,`date` FROM `alaabta` WHERE user_id = '$id' ";
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
function all($db){
    $date = array();
    $mess = array();

    $id = $_POST['id'];
    $s = "SELECT * FROM alaabta WHERE id = '$id'";
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
function update($db){
    extract($_POST);

    $s = "UPDATE alaabta SET name='$name',intaxabu='$inta_xabu',lacagta='$lacagta' WHERE id= '$id'";

    $r = $db -> query($s);
    if($r){
        $data = array('status' => true,'data' => 'is sax hay ayaah loo updategareey');
    }
    else{
        $data = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($data);
}
function delete($db){
    $data = array();
    $id = $_POST['id'];

    $s = "DELETE FROM alaabta  WHERE id = '$id'";

    $r = $db -> query($s);
    if($r){
        $data = array('status' => true,'data' => 'Delete alaabta ');
    }
    else{
        $data = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($data);
}

if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($db);
}
else{
    echo json_encode(array('status' => false, 'data' => 'action ma jiro'));
}

?>