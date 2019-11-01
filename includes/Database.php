<?php 
ob_start();

$db_host = "localhost";
$db_user = "root";
$db_pass = "";


//Create connecton 
$conn = mysqli_connect($db_host,$db_user,$db_pass);

$db = mysqli_select_db($conn,"cms");


//Check connection
if(!$conn){
    die("Connection failed").mysqli_connect_error();
} 
//else{
//    echo "We are connected";
//}



?>