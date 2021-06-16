<?php

$db_host='http://143.244.152.251/';
$db_user='mysterymeal_user_2';
$db_password='mysterymeal_62021';
$db_database='mysterymealdb';
try{
    $con=mysqli_connect($db_host,$db_user,$db_password,$db_database);
    echo"Connected Successfully Tarek!";
}catch(PDOException $exc){
    echo $exc->getMessage();
    die("couldn't connect");
}
?>
