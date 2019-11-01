<?php session_start(); ?>
<?php include "Database.php"; ?>
<?php include "../admin/functions/functions.php"?>

<?php 
    if(isset($_POST['login'])){
         $username = $_POST['username'];
         $password = $_POST['password'];
        
        
        //Login Function see in functions.php
        login_user($username,$password); 
       
        }
?>  