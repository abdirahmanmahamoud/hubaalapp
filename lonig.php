<?php
header('content-type: application/json');
include 'conn.php';
session_start();
function lonig($db){
    extract($_POST);
    $data = array();
    $query = "SELECT * FROM users WHERE username ='$username' AND password = '$password'";
    $conn = mysqli_query($db,$query);
    $sax = (mysqli_num_rows($conn));
    if($sax){
        $query1 = "SELECT * FROM users WHERE username = '$username'";
        $conn1 = $db ->query($query1);
        if($conn1){
            $row = $conn1->fetch_assoc();
            $date = $row['date2'];
            $days = date('d-m-Y');
            if($date <= $days){
                $data = array('status' => false,'data' => 'fadlan bixi lacagta biha');
            }else{
                $_SESSION['shirkada'] = $row['id'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['name'] = $row['magaca_kooad'].' ' . $row['magaca_labaad'];
                $_SESSION['image'] = $row['image'];
                $data = array('status' => true,'data' => 'sax');
            }
        }
    }else{
            $query2 = "SELECT * FROM shaqale WHERE username = '$username' AND password ='$password'";
            $conn2 = mysqli_query($db,$query2);
            $sax2 = (mysqli_num_rows($conn2));
            if($sax2){
                $query3 = "SELECT * FROM shaqale WHERE username = '$username' ";
                $conn3 = $db ->query($query3);
                $row1 = $conn3 ->fetch_assoc();
                $user_id = $row1['user_id'];
                $query4 = "SELECT * FROM users WHERE id = '$user_id'";
                $conn4 = $db ->query($query4);
                $row2 = $conn4 ->fetch_assoc();
                $date2 = $row2['date2'];
                $days2 = date('d-m-Y');
                if($date2 <= $days2){
                    $data = array('status' => false,'data' => 'fadlan bixi lacagta biha');
                }else{
                    $_SESSION['shirkada'] = $user_id;
                    $_SESSION['name'] = $row1['magaca'];
                    $_SESSION['id'] = $row1['id'];
                    $_SESSION['image'] = $row1['image'];
                    $data = array('status' => true,'data' => 'sax');
                }
            }else{
                $data = array('status' => false,'data' => 'waa khalad username iyo password');
            }

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