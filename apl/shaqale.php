<?php
header('content-type: application/json');
include '../conn/conn.php';
session_start();
if(!$_SESSION['shirkada']){
    $shirkada = $_SESSION['shirkada'];
    header('location: ../index.php');
}
function reg($db){
    $data = array();
    extract($_POST);
    $user = $_SESSION['shirkada'];
    $query = "SELECT * FROM users WHERE id ='$user'";
    $conn = mysqli_query($db,$query);
    $sax = (mysqli_num_rows($conn));
    if($sax){
      $query2 = "SELECT * FROM `shaqale` WHERE shaqale.username='$username'";
      $results = mysqli_query($db, $query2);
      $re =(mysqli_num_rows($results));
      if($re){
        $data = array('status' => false,'data' => 'username number raaci');
      }else{
        $query3 = "SELECT * FROM users WHERE users.id = '$user'";
        $conn2 = $db ->query($query3);
        if($conn2){
            $row = $conn2 -> fetch_assoc();
            $user_numbar = $row['user_numbar'];
            $kajir = $user_numbar - 1;
            $query4 = "INSERT INTO `shaqale`(`magaca`, `phone`, `username`, `password`, `user_id`, `image`) VALUES ('$magaca','$phone','$username','$password','$user','hubaal.png')";
            $conn3 = $db ->query($query4);
            if($conn3){
                $query5 = "UPDATE users SET user_numbar = '$kajir' WHERE id = '$user'";
                $conn4 = $db ->query($query5);
                if($conn4){
                    $data = array('status' => true,'data' => 'is sax hay ayaah u diwaangalisar');
                }
            }else{
            $data = array('status' => false, 'data' => $db->error);
        }
         //   $data = array('status' => true,'data' => $kajir);
        }else{
            $data = array('status' => false, 'data' => $db->error);
        }
    }
    }else{
        $query6 = "SELECT * FROM shaqale WHERE id ='$user'";
        $conn5 = mysqli_query($db,$query6);
        $sax1 = (mysqli_num_rows($conn5));
        if($sax1){
            $query7 = "SELECT * FROM shaqale WHERE id = '$user'";
            $conn7 = $db ->query($query7);
            if($conn7){
                $row2 = $conn7 -> fetch_assoc();
                $user_id2 = $row2['user_id'];
                $query8 = "SELECT *FROM users WHERE id = '$user_id2'";
                $conn8 = $db -> query($query8);
                if($conn8){
                    $row3 = $conn8 -> fetch_assoc();
                    $user_numbar2 = $row3['user_numbar'];
                    $kajir2 = $user_numbar2 - 1;
                    $query9 = "SELECT * FROM shaqale WHERE username = '$username'";
                    $conn9 = mysqli_query($db,$query9);
                    $sax3 = (mysqli_num_rows($conn9));
                    if($sax3){
                        $data = array('status' => false,'data' => 'username number raaci');
                    }else{
                        $query10 = "INSERT INTO `shaqale`(`magaca`, `phone`, `username`, `password`, `user_id`, `image`) VALUES ('$magaca','$phone','$username','$password','$user_id2','hubaal.png')";
                        $conn10 = $db ->query($query10);
                        if($conn10){
                            $query11 = "UPDATE users SET user_numbar = '$kajir2' WHERE id = '$user_id2'";
                            $conn11 = $db ->query($query11);
                            if($conn11){
                                $data = array('status' => true,'data' => 'is sax hay ayaah u diwaangalisar');
                            }
                        }
                    }
                }
            }
            //$data = array('status' => true,'data' => $user_numbar2);
        }
    }
    echo json_encode($data);
}

function update($db){
    $data = array();
    extract($_POST);
    $query = "UPDATE shaqale SET magaca = '$magaca',phone = '$phone',password = '$password' WHERE id = '$id'";
    $conn = $db ->query($query);
    if($conn){
        $data = array('status' => true,'data' => 'is sax hay ayaah loo updategareey');  
    }else{
        $data = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($data);
}

function all($db){
    $data = array();
    extract($_POST);
    $query = "SELECT * FROM shaqale WHERE id = '$id'";
    $conn = $db ->query($query);
    if($conn){
        while($row = $conn->fetch_assoc()){
            $date [] = $row;
        }
        $data = array('status' => true,'data' => $date);
    }else{
        $data = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($data);
}

function khar($db){
    $id = $_SESSION['shirkada'];
    $data = array();
    extract($_POST);
    $query = "SELECT id,magaca,phone,username FROM shaqale WHERE user_id = '$id'";
    $conn = $db ->query($query);
    if($conn){
        while($row = $conn->fetch_assoc()){
            $date [] = $row;
        }
        $data = array('status' => true,'data' => $date);
    }else{
        $data = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($data);
}

function delete($db){
    $user = $_SESSION['shirkada'];
    $data = array();
    $id = $_POST['id'];
    $query = "DELETE FROM `shaqale` WHERE id = '$id'";
    $conn = $db ->query($query);
    if($conn){
        $query2 = "SELECT * FROM users WHERE id ='$user'";
        $conn2 = mysqli_query($db,$query2);
        $sax = (mysqli_num_rows($conn2));
        if($sax){
            $query3 = "SELECT * FROM users WHERE users.id = '$user'";
            $conn3 = $db ->query($query3);
            if($conn3){
                $row = $conn3 -> fetch_assoc();
                $user_numbar = $row['user_numbar'];
                $kajir = $user_numbar + 1;
                $query4 = "UPDATE users SET user_numbar = '$kajir' WHERE id = '$user'";
                $conn4 = $db ->query($query4);
                if($conn4){
                    $data = array('status' => true,'data' => 'Delete'); 
                }

                //$data = array('status' => true,'data' => $kajir);
                }
            }else{
                $query5 = "SELECT * FROM shaqale WHERE id = '$user'";
                $conn5 = $db ->query($query5);
                if($conn5){
                    $row = $conn5 -> fetch_assoc();
                    $user2 = $row['user_id'];  
                    $query6 = "SELECT * FROM users WHERE id = '$user2'";
                $conn6 = $db ->query($query6);
                if($conn6){
                    $row = $conn6 -> fetch_assoc();
                    $user_numbar2 = $row['user_numbar'];  
                    $kajir2 = $user_numbar2 + 1;
                    $query7 = "UPDATE users SET user_numbar = '$kajir2' WHERE id = '$user2'";
                    $conn7 = $db ->query($query7);
                    if($conn7){
                        $data = array('status' => true,'data' => 'Delete'); 
                    }
                } 
                }
            }
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