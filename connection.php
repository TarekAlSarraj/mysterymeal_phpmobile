<?php

$db_host='localhost';
$db_user='id16644001_mysterymealdb';
$db_password='gmd$0RC09+{NCa%U';
$db_database='id16644001_mysterymeal_db';
try{
    $con=mysqli_connect($db_host,$db_user,$db_password,$db_database);
    echo"Connected Successfully";
}catch(PDOException $exc){
    echo $exc->getMessage();
    die("couldn't connect");
}
?>