<?php
$da = date("Y-m-d");
$y = date('Y');
$m = date('m');
$d = date('d');
$de = $d - 7;
echo $y,'-',$m,'-',$de;
echo '</br>',date('Y-m-d');

echo '</br>';
$der = strtotime('tomorrow');
echo date('Y-m-d',$der);
echo '</br>';
$es = strtotime('-2 month');
echo date('Y-m-d',$es);

$maata2 = strtotime('+1 days'); 
    $maata = date('Y-m-d',$maata2);
    $week1 = strtotime('-7 days');
    $week = date('Y-m-d',$week1);
    echo '</br> ',$maata;
    echo '</br> ',$week;
?>