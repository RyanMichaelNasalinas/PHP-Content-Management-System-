<?php include "includes/Database.php"; ?>
<?php include "includes/header.php"; ?>


    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Navigation -->
   
   
    <?php
    if(isset($_POST['login'])){
        
        $error = '';
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        
        
    if(empty($username) || empty($password)){
        $error = "Username or password cannot be empty";
        
    }  else {
        
    $query = "SELECT * FROM users WHERE user_name='{$username}'";    
    $select_user_query = mysqli_query($conn,$query);
    if(!$select_user_query){
        die("QUERY FAILED". mysqli_error($conn));
    } 
        
     
        
    while($row = mysqli_fetch_array($select_user_query)){
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname']; 
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role']; 
    } 
      
        

 
    $hashed_password = password_verify($password,$user_password); 
    if($hashed_password == true){
        
         $_SESSION['user_name'] = $user_name;
         $_SESSION['user_firstname'] = $user_firstname;
         $_SESSION['user_lastname'] = $user_lastname;
         $_SESSION['user_email'] = $user_email;
         $_SESSION['user_role'] = $user_role;
        
        
        header("Location: index.php");
        
        } elseif($hashed_password == false) {
        echo  "Password if not matched"; 
            
        header("Location: login.php");
        }
    }    
} 
?>
    

    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
           <!--col-md-offset-3-->
            <div class="col-lg-6 col-lg-offset-3 col-md-offset-3 col-md-8 col-sm-12">
                <div class="form-wrap">
                <h1>Sign In</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="on">
                        
                         <p class="text-default text-center alert-danger"><?php echo isset($error) ? $error : '';?></p> 
                         <div class="form-group">
                            <label for="username">Username</label>
                            <input type='text' name='username' id='username' class='form-control' placeholder='Username' autocomplete="on" value="<?php echo isset($username) ? $username : ''; ?>">  
                        </div>
                         
                        
                        
                         <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                                
                        </div>
                           
                         
                        <input type="submit" name="login" id="btn-login" class="btn btn-success btn-lg" value="Sign In">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
        <hr>



  <?php  include "includes/footer.php"; ?>
