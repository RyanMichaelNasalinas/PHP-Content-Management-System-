<?php 

ob_start();
session_start(); 

if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
//         $_SESSION['user_name'] = null;
//         $_SESSION['user_firstname'] = null;
//         $_SESSION['user_lastname'] = null;
//         $_SESSION['user_email'] = null;
//         $_SESSION['user_role'] = null;   

    
    
        header("location: ../index.php");
} else{
    header("Location: ../index.php");
}
        





?>