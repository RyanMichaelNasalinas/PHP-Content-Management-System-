<?php include "includes/admin_header.php"; ?>
 
    <div id="wrapper">

        <!-- Navigation -->
       
       
       <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <h1 class="page-header">
                            User Profile
                            <small>By Admin</small>
                        </h1>
            
                    <?php 
                        if(isset($_SESSION['user_name']))
                        {
                            $session_user_name = $_SESSION['user_name'];
                            $query = "SELECT * FROM users WHERE user_name='{$session_user_name}'";
                            $select_profile_query = mysqli_query($conn,$query);
                            
                            while($row = mysqli_fetch_assoc($select_profile_query)){
                                
                                $user_id = $row['user_id'];
                                $user_name = $row['user_name'];
                                $user_password = $row['user_password'];
                                $user_firstname = $row['user_firstname'];
                                $user_lastname = $row['user_lastname'];
                                $user_email = $row['user_email'];
                                $user_image = $row['user_image'];
                                $user_role = $row['user_role'];
                                
                            }
                        }    
                        if(isset($_POST['update_profile'])){
                            
                            $user_firstname = $_POST['user_firstname'];
                            $user_lastname = $_POST['user_lastname'];
                            $user_role = $_POST['user_role'];
                            $user_name = $_POST['user_name'];
                            $user_email = $_POST['user_email'];
                            $user_password = $_POST['user_password'];
                            
                            
                        $update_profile_query = "UPDATE users set user_firstname='{$user_firstname}', user_lastname='{$user_lastname}',user_role='{$user_role}',user_name='{$user_name}',user_email='{$user_email}',user_password='{$user_password}' WHERE user_name='{$session_user_name}'"; 
                        
                        $update_profile = mysqli_query($conn,$update_profile_query);    
                        header("location: profile.php");
                    if(!$update_profile){
                        die("Query failed" . mysqli_error($conn));
                    }        
                            
                          
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
        echo "<option value='User'>{$user_role}</option>";
            
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
        <input type="text" class="form-control" name="user_name" value="<?php echo $user_name; ?>" disabled>
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
        <input type="submit" class="btn btn-primary" value="Update Profile" name="update_profile">
    </div>
 
</form>       
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    
   
  <?php include "includes/admin_footer.php"; ?>