<?php include "includes/Database.php"; ?>
<?php include "includes/header.php"; ?>


    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>


    <?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        
       $firstname   = trim($_POST['firstname']);
       $lastname    = trim($_POST['lastname']);
       $username    = trim($_POST['username']);
       $email       = trim($_POST['email']);
       $password    = trim($_POST['password']);
       $confirm_password = trim($_POST['confirm_password']);
        
        //Make an error message error to check if the fields is empty
        $error = ['Firstname' => '','Lastname' => '','Username' => '','Email' => '','Password' => '','ConfirmPassword' => ''];
        
             //Check for the firstname
        if($firstname == ''){
            $error['Firstname'] = 'Firstname should not be empty';
        }
            //Check for the lastname
        if($lastname == ''){
            $error['Lastname'] = 'Lastname should not be empty';
        } 
        
            //Check for the usernane
        if(strlen($username) < 8){
            $error['Username'] = 'Username needs to be longer than 8 characters';
        }
        
        if(check_username($username)){
            $error['Username'] = 'Usernane already exists, get another one';
        }
          
        if(empty($username)){
            $error['Username'] = 'Username should not be empty';
        }
        
            //Check for the email
        if($email == ''){
            $error['Email'] = 'Email should not be empty';
        } else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error['Email'] = "Invalid email format";
            }
            
        }
        
        if(check_email($email)){
            $error['Email'] = 'Email already exists, get another one';
        }
        
            //Check for the password
        if(strlen($password) < 8){
             $error['Password'] = 'Password should be longer than 8 characters';
        }
        
         if($password == '' || empty($password)){
            $error['Password'] = 'Password should not be empty';
        }
    
            //Confirm password
        if($confirm_password != $password){
            $error['ConfirmPassword'] = 'Password is not matched';
        }
        
        if(empty($confirm_password)){
            $error['ConfirmPassword'] = 'Confirm password should not be empty';
        }
        
          //Loop the error message
        foreach($error as $key => $value){
            if(empty($value)){
                   
            unset($error[$key]);
            }
            
        } if(empty($error)){
           //Use register function to register the user
                register_user($firstname, $lastname, $username, $email, $password); 
            
                unset($firstname, $lastname, $username, $email, $password,$confirm_password);
                echo "<div class='container'>";
                echo "<div class='row'>";
                    echo "<div class='col-xs-6 col-xs-offset-3 text-center alert-success'>Registration successfull login <a href='index.php'>here</a></div>";
                echo "</div>";
                echo "</div>";
        }
        
        } if(isset($_POST['cancel'])){
        
      
        
        header("Location: registration.php");
    }
 
?>
    

    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-xs-12">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="login-form" autocomplete="on" ecntype="multipart/form-data">
                      
                    <p class="text-danger text-center alert-danger"><?php echo isset($error['Firstname']) ? $error['Firstname'] : '';?></p>
                    <p class="text-danger text-center alert-danger"><?php echo isset($error['Lastname']) ? $error['Lastname'] : '';?></p>
                    <p class="text-danger text-center alert-danger"> <?php echo isset($error['Username']) ? $error['Username'] : '';?></p>
                    <p class="text-danger text-center alert-danger"> <?php echo isset($error['Email']) ? $error['Email'] : '';?></p>
                    <p class="text-danger text-center alert-danger"><?php echo isset($error['Password']) ? $error['Password'] : ''; ?></p>
                    <p class="text-danger text-center alert-danger"><?php echo isset($error['ConfirmPassword']) ? $error['ConfirmPassword'] : ''; ?></p>
                      
                      
                       
                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                                                    <!-- Echo the value if the input is wrong-->
                            <input type='text' name='firstname' id='username' class='form-control' placeholder='Firstname' autocomplete="on" value="<?php echo isset($firstname) ? $firstname  : ''; ?>">
                        </div>
                        
                                                    <!-- Echo the value if the input is wrong-->
                         <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type='text' name='lastname' id='username' class='form-control' placeholder='Lastname' autocomplete="on" value="<?php echo isset($lastname) ? $lastname : ''; ?>">
                           
                        </div>
                        
                                                    <!-- Echo the value if the input is wrong-->
                         <div class="form-group">
                            <label for="username">Username</label>
                            <input type='text' name='username' id='username' class='form-control' placeholder='Username' autocomplete="on" value="<?php echo isset($username) ? $username : ''; ?>">
                            
                            
                            
                        </div>
                                                    <!-- Echo the value if the input is wrong-->
                         <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Example@example.com" autocomplete="on" value="<?php echo isset($email) ? $email : ''; ?>">
                            
                        </div>
                        
                        
                         <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            
                        </div>
                        
                        
                         <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" name="confirm_password" id="key" class="form-control" placeholder="Confirm Password">
                             
                        </div>
                
                        <input type="submit" name="register" id="btn-login" class="btn btn-success btn-lg btn-success success" value="Register">
                        
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
       
        <hr>



  <?php  include "includes/footer.php"; ?>
