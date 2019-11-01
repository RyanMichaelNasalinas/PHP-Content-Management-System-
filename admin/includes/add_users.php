<?php 
    

    if(isset($_POST['create_user'])){    
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role']; 
        $user_name = $_POST['user_name'];
        
  
       
        $user_email = $_POST['user_email']; 
        $user_password = $_POST['user_password'];
    
        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
        
        $query = "INSERT into users(user_firstname,user_lastname,user_role,user_name,user_email,user_password) VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$user_name}','{$user_email}','{$user_password}')";
        $create_post_query = mysqli_query($conn, $query);
        
        if(!$create_post_query){
            die("Query failed ". mysqli_error($conn));
        }
        
        echo " <div class='alert alert-success'><b>User has been created <a href='users.php'>View User</a></b></div>";
        
    }
 
   
    
   
?>   
  
   <form action="" method="post" enctype="multipart/form-data">
    
    
    <div class="form-group">
        <label for="post_title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    
     <div class="form-group">
        <label for="post_author">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    
     <div class="form-group">
        <label for="post_id">Role</label>
        
        <select class="form-control" name="user_role">
        
        <option value="User">Select Role</option>
        <option value="Admin">Admin</option>
        <option value="User">User</option>
         </select>
    </div>
    
   
    
     <div class="form-group">
        <label for="post_status">Username</label>
        <input type="text" class="form-control" name="user_name">
    </div>
<!--
    
     <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>
    
-->
     <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    
     <div class="form-group">
        <label for="post_content">Password</label>
         <input type="password" class="form-control" name="user_password">
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Add User" name="create_user">
    </div>
    
</form>