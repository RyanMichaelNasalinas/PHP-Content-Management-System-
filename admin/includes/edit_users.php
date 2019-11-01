<?php 
    if(isset($_GET['user_id'])){
        $the_user_id = $_GET['user_id'];
  
        $select_users = "SELECT * FROM users WHERE user_id={$the_user_id}";
        $select_query = mysqli_query($conn,$select_users);


        while($row = mysqli_fetch_assoc($select_query)){
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_role = $row['user_role'];
            $user_name = $row['user_name'];
            $user_email = $row['user_email'];
            $user_password = $row['user_password'];
        
        }

        if(isset($_POST['edit_user'])){
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role']; 
        $user_name = $_POST['user_name'];
 
        $user_email = $_POST['user_email']; 
        $user_password = $_POST['user_password'];
        

    
        if(!empty($user_password)){
            $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
            $confirm_query_password = mysqli_query($conn,$query_password);
            
            if(!$confirm_query_password){
                die("Query failed". mysqli_error($conn));
            }
            
            $row = mysqli_fetch_array($confirm_query_password);
            $db_user_password = $row['user_password'];
            
            
            if($db_user_password != $user_password){
                $hashed_password = password_hash($user_password,PASSWORD_BCRYPT, array('cost' => 10));
            }
            
          $update_user_query = "UPDATE users set user_firstname='{$user_firstname}', user_lastname='{$user_lastname}',user_role='{$user_role}',user_name='{$user_name}',user_email='{$user_email}',user_password='{$hashed_password}' WHERE user_id={$the_user_id}";
            
        $create_user_query = mysqli_query($conn, $update_user_query);
        
        if(!$create_user_query){
            die("Query failed ". mysqli_error($conn));
        }
    
        echo "<div class='alert bg-success text-success'>User is now updated <a href='users.php'><b>View User?</b>  </a></div>";     
            
            
        } 
    }
        
} else{
        header("Location: index.php");   
    }
   
?>   
   <form action="" method="post" enctype="multipart/form-data">
    
    
    <div class="form-group">
        <label for="post_title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
    </div>
    
     <div class="form-group">
        <label for="post_author">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
    </div>
    
     <div class="form-group">
        <label for="post_id">Role</label>
        
        <select class="form-control" name="user_role">
        <?php
        echo "<option value='{$user_role}'>{$user_role}</option>";
            
        if($user_role == 'Admin'){
           echo "<option value='User'>User</option>";
        } else{
             echo "<option value='Admin'>Admin</option>";
        }
        ?>

         </select>
    </div>
  
     <div class="form-group">
        <label for="post_status">Username</label>
        <input type="text" class="form-control" name="user_name" value="<?php echo $user_name; ?>">
    </div>

     <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
    </div>
    
     <div class="form-group">
        <label for="post_content">Password</label>
         <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Update User" name="edit_user">
    </div>
 
</form>