<?php
header('content-type: application/json');
include '../conn/conn.php';
session_start();
if(!$_SESSION['shirkada']){
    $shirkada = $_SESSION['shirkada'];
    header('location: ../index.php');
}
function alaabta_taalla($db){
    $id = $_SESSION['shirkada'];
    extract($_POST);
    $data = array();
    $query = "SELECT * FROM `alaabta` WHERE alaabta.name = '$search_name'";
    $results = mysqli_query($db, $query);
    $re =(mysqli_num_rows($results));
    if($re){
        $select = "SELECT * FROM `alaabta_ibso` WHERE alaabta_ibso.name = '$search_name'";
        $conn = mysqli_query($db,$select);
        $sax = (mysqli_num_rows($conn));
        if($sax){
            $se = "SELECT * FROM `alaabta_ibso` WHERE alaabta_ibso.name = '$search_name' order by alaabta_ibso.date desc limit 1";
            $ra = $db ->query($se);
            if($ra){
                $row = $ra->fetch_assoc();
                    $inta_hartay = $row['inta_hartay'];
                
                $data = array('status' => true,'data' => $inta_hartay);
            }
        }
    }else{
        $data = array('status' => false, 'data' => 'ma taaku alaabta');
    }
    echo json_encode($data);
}

function alaabta_iib($db){
    $id1 = $_SESSION['shirkada'];
    extract($_POST);
    $data = array();
    $select = "SELECT * FROM `alaabta_ibso` WHERE alaabta_ibso.name = '$search_name'";
    $conn = mysqli_query($db,$select);
    $sax = (mysqli_num_rows($conn));
    if($sax){
        $se = "SELECT * FROM `alaabta_ibso` WHERE alaabta_ibso.name = '$search_name' order by alaabta_ibso.date desc limit 1";
        $ra = $db ->query($se);
        if($ra){
            $row = $ra->fetch_assoc();
                $inta_hartay = $row['inta_hartay'];
                if($inta_xabu <= $inta_hartay){
                    $se = "SELECT * FROM `alaabta_ibso` WHERE alaabta_ibso.name = '$search_name' and status ='0'";
                    $ra = $db ->query($se);
                    if($ra){
                        $row = $ra->fetch_assoc();
                            $lacagta = $row['lacagta'];
                            $haraaga = $inta_xabu * $lacagta;
                            $kajar = $inta_hartay - $inta_xabu;
                            $s = "INSERT INTO `alaabta_ibso`( `name`, `inta_xabu`, `inta_hartay`, `lacagta`, `user_id`, `status`) VALUES('$search_name','$inta_xabu','$kajar','$haraaga','$id1','1')";
                            $r = $db->query($s);
                            if($r){
                                $data = array('status' => true,'data' => 'is sax hay ayaah u diwaangalisar');
                            }else{
                                $data = array('status' => false, 'data' => $db->error);
                            }
                    }
                }else{
                    $data = array('status' => false, 'data' => 'inta kuma filna inta taarla waa '.$inta_hartay);
                }
        } 
    }else{
        $data = array('status' => false, 'data' => 'ma taarlu alaabta');
    }
    echo json_encode($data);
}

function khar($db){
    $id = $_SESSION['shirkada'];
    $date = array();
    $mess = array();
    $s = "SELECT `id`, `name`, `inta_xabu`, `inta_hartay`, `date` FROM `alaabta_ibso` WHERE alaabta_ibso.user_id = '$id' AND alaabta_ibso.status = '1' ";
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

function Statemnt($db){
    $id = $_SESSION['shirkada'];
    extract($_POST);
    $data = array();
    $s = "CALL alaabta ('$id','$fordate','$todate')";
    $r = $db->query($s);
    if($r){
        while($row = $r->fetch_assoc()){
            $table [] = $row;
        }
        $data = array('status' => true,'data' => $table);
    }else{
        $data = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($data);
}

function alaabta($db){
    $id = $_SESSION['shirkada'];
    $data = array();
    $s = "SELECT SUM(alaabta_ibso.inta_xabu)inta_xabu FROM alaabta_ibso WHERE alaabta_ibso.status = '1' AND alaabta_ibso.user_id = '$id'";
    $r = $db->query($s);
    if($r){
        while($row = $r->fetch_assoc()){
            $table [] = $row;
        }
        $data = array('status' => true,'data' => $table);
    }else{
        $data = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($data);
}

function week($db){
    $id = $_SESSION['shirkada'];
    $data = array();
    $maata2 = strtotime('+1 days'); 
    $maata = date('Y-m-d',$maata2);
    $week1 = strtotime('-7 days');
    $week = date('Y-m-d',$week1);
    $s = "SELECT SUM(alaabta_ibso.lacagta)week FROM alaabta_ibso WHERE alaabta_ibso.status = '1' AND alaabta_ibso.user_id = '$id' AND alaabta_ibso.date BETWEEN  '$week' AND '$maata'";
    $r = $db->query($s);
    if($r){
        while($row = $r->fetch_assoc()){
            $table [] = $row;
        }
        $data = array('status' => true,'data' => $table);
    }else{
        $data = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($data);
}

function lacagta($db){
    $id = $_SESSION['shirkada'];
    $data = array();
    $s = "SELECT lacagta ('$id')";
    $r = $db->query($s);
    if($r){
        while($row = $r->fetch_assoc()){
            $table [] = $row;
        }
        $data = array('status' => true,'data' => $table);
    }else{
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