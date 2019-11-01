<?php

//Create a function that escape every data
function escapeData($string){
    global $conn;
    return mysqli_real_escape_string($conn, trim($string));
    
}

 

//CHECK HOW MANY USERS ONLINE
function userOnline(){
           
        if(isset($_GET['onlineusers'])){
            
            global $conn;
            
            if(!$conn){
                
                session_start();
                
                include ("../includes/Database.php");
                
                
                $session          = session_id();
                $time             = time();
                $time_out_in_secs = 05;
                $time_out         = $time - $time_out_in_secs;

                $query_online = "SELECT * FROM user_online WHERE session= '$session'";
                $select_query = mysqli_query($conn,$query_online);
                $count_online = mysqli_num_rows($select_query);

                if($count_online == NULL){
                    mysqli_query($conn, "INSERT into user_online(session,time) VALUES('$session','$time')");
                } else{
                    mysqli_query($conn, "UPDATE user_online SET time = '$time' WHERE session = '$session'");
                }

                $users_online_query = mysqli_query($conn, "SELECT * FROM user_online WHERE time > '$time_out'");
                echo $count_user_online_query = mysqli_num_rows($users_online_query);  
                
            }
    
         }//isset request
 
    } 

userOnline();

 

//INSERT CATEGORIES QUERY 

function insertCategories(){ 
    global $conn;
        if(isset($_POST['catSubmit'])) {    
        $cat_title = ucfirst($_POST['catTitle']); 
            
            if($cat_title == "" || empty($cat_title)){
                echo "<div class='alert alert-danger alert-dismissible fade in'><b>Please input some text</b><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>"; 
            } elseif(strlen($cat_title) <= 8){
               echo "<div class='alert alert-danger alert-dismissible fade in'><b>Category must be longer than 8 characters</b><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>"; 
            } else {
            $query = "INSERT into categories(cat_title) VALUES ('{$cat_title}')";
            $insert_query = mysqli_query($conn,$query);
                echo "<div class='alert alert-success alert-dismissible fade in'><b>Category Inserted</b><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>"; 
                
                if(!$insert_query){
            die("Query failed" . mysqli_error($insert_query));
                }
            }  
         } if(isset($_POST['clear_category'])){
            $cat_title = $_POST['catTitle']; 
            unset($cat_title);
            
        }
    }  


 

//SHOW ALL CATEGORIES

function showCategories(){
    global $conn;
$query = "SELECT * FROM categories";
    $query_cat = mysqli_query($conn,$query);
    while($row = mysqli_fetch_assoc($query_cat))
    {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
            echo "<td>{$cat_title}</td>";
            echo "<td class='text-center'><a href='categories.php?edit={$cat_id}' class='btn btn-primary btn-sm'><i class='fa fa-edit'></i></a></td>";
            echo "<td class='text-center'><a href='categories.php?delete={$cat_id}' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a></td>";
        echo "</tr>";
    } 
}

 
    //DELETE CATEGORIES
function deleteCategories(){
    global $conn;
if(isset($_GET['delete'])){
   $cat_id = $_GET['delete'];
    $query = "DELETE from categories WHERE cat_id ={$cat_id}";
    $deletequery = mysqli_query($conn,$query);
    header("location: categories.php");
    }
}



//CHECK IF THE USER IS AN ADMIN
function is_admin($username = ''){
    
    global $conn;
    
    $query = "SELECT user_role FROM users WHERE user_name = '$username'";
    $result = mysqli_query($conn,$query);
    
    if(!$result){
        die("Query failed". mysqli_error($conn));
    }
    
    $row = mysqli_fetch_array($result);
    
    if($row['user_role'] == 'Admin'){
        return true;
    } else{
        return false;
    }
    
}


//CHECK IF THE USERNAME IS ALREADY EXISTING

function check_username($username){
    
    global $conn;
    
    $query = "SELECT user_name FROM users WHERE user_name = '$username'";
    $result = mysqli_query($conn,$query);
    
    if(!$result){
        die("Query failed" . mysqli_error($conn));
    }
    
    if(mysqli_num_rows($result) > 0){
        return true;
    } else{
        return false;
    }
    
}


//CHECK IF THE USER EMAIL IS ALREADY EXISTING

function check_email($email){
    
    global $conn;
    
    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($conn,$query);
    
    if(!$result){
        die("Query failed" . mysqli_error($conn));
    }
    
    if(mysqli_num_rows($result) > 0){
        return true;
    } else{
        return false;
    }
    
}


//FUNCTION RETURN HEADER

function redirect($location){
    return header("Location:" . $location);
}







//function to register user
function register_user($firstname, $lastname, $username, $email, $password){
    
    global $conn;
    
    
       $firstname = $_POST['firstname'];
       $lastname = $_POST['lastname'];
       $username = $_POST['username'];
       $email = $_POST['email'];
       $password = $_POST['password'];
        

      $firstname = mysqli_real_escape_string($conn,$firstname);
      $lastname = mysqli_real_escape_string($conn,$lastname); 
      $username = mysqli_real_escape_string($conn,$username);
      $email = mysqli_real_escape_string($conn,$email);
      $password = mysqli_real_escape_string($conn,$password);
        
    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
        
            
        $query_register = "INSERT into users (user_name, user_firstname, user_lastname, user_email, user_password, user_role) VALUES ('$username','$firstname','$lastname','$email','$password','User')";
        $insert_user_query = mysqli_query($conn,$query_register);
            
                
        if(!$insert_user_query){
                die("Query Failed". mysqli_error($conn));
            } 
        $message = "<h4 class='text-success text-center bg-success alert'>Success Registration</h4>";
            
        
        
         
    
    
}






//function login_user($username, $password){
//    
//        global $conn;
//    
//        $username = trim($username);
//        $password = trim($password);
//        
//        $username = mysqli_real_escape_string($conn,$username);
//        $password = mysqli_real_escape_string($conn,$password);
//        
//        
//        
//    $query = "SELECT * FROM users WHERE user_name='{$username}'";
//    $select_user_query = mysqli_query($conn,$query);
//    if(!$select_user_query){
//        die("QUERY FAILED". mysqli_error($conn));
//    } 
//        
//     
//        
//    while($row = mysqli_fetch_array($select_user_query)){
//        $user_id = $row['user_id'];
//        $user_name = $row['user_name'];
//        $user_password = $row['user_password'];
//        $user_firstname = $row['user_firstname']; 
//        $user_lastname = $row['user_lastname'];
//        $user_email = $row['user_email'];
//        $user_role = $row['user_role']; 
//    } 
//        
//
// 
//       $hashed_password = password_verify($password,$user_password); 
//    if($hashed_password == true){
//        
//         $_SESSION['user_name'] = $user_name;
//         $_SESSION['user_firstname'] = $user_firstname;
//         $_SESSION['user_lastname'] = $user_lastname;
//         $_SESSION['user_email'] = $user_email;
//         $_SESSION['user_role'] = $user_role;
//        
//        
//        header("Location: ../index.php");
//        
//    } elseif($hashed_password == false) {
//        header("Location: ../index.php");
//    }
//     
//    
//    
//}





//

?>


