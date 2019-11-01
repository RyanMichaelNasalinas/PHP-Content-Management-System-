<?php 

    if(isset($_GET['p_id'])){
        $the_get_post_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM posts where post_id={$the_get_post_id}";
    $selectQuery = mysqli_query($conn,$query);

    while($row = mysqli_fetch_assoc($selectQuery)){
        $post_cat_id = $row['post_cat_id'];
        $post_title = $row['post_title'];
        $post_user = $row['post_user'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];
    }
    if(isset($_POST['edit_post'])){
        
        $post_title = $_POST['post_title'];
        $post_category = $_POST['post_category'];
        $post_user = $_POST['post_user'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['post_image_file']['name'];
        $post_image_temp =  $_FILES['post_image_file']['tmp_name'];
        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
        
        move_uploaded_file($post_image_temp,"../images/$post_image");
        
        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id={$the_get_post_id}";
            $select_image = mysqli_query($conn,$query);
            
            while($row = mysqli_fetch_assoc($select_image)){
                $post_image = $row['post_image'];
                
            }
        }
        
    $query = "UPDATE posts SET post_title = '{$post_title}', post_cat_id = '{$post_category}', post_date = now(), post_user='{$post_user}', post_status ='{$post_status}', post_tags = '{$post_tags}', post_content = '{$post_content}', post_image='{$post_image}' WHERE post_id='{$the_get_post_id}'";
        
        
        $update_query = mysqli_query($conn,$query);
        
        if(!$update_query){
            die("Query failed ". mysqli_error($conn));
        }
        
         echo " <div class='alert alert-success'><b>Post has been updated <a href='../blog-post.php?p_id={$the_get_post_id}'>View Post</a></b> or <b><a href='posts.php'>Edit More Posts</a></b></div>";
    }

?>
   

   
   
   <form action="" method="post" enctype="multipart/form-data">
    
    
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input  value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title" >
    </div>
    
    
     <div class="form-group">
        <label for="post_id">Post Category</label>
        
        <select class="form-control" name="post_category">
        <?php 
         
         $query = "SELECT * FROM categories";
         $select_categories = mysqli_query($conn,$query);
         
        if(!$select_categories){
            die("Query failed". mysqli_error($conn));    
        }
            
         while($row = mysqli_fetch_assoc($select_categories)){
             $cat_id = $row['cat_id'];
             $cat_title = $row['cat_title'];
             
             
             if($cat_id == $post_cat_id){
                echo "<option  selected value='{$cat_id}'>{$cat_title}</option>";
            } else {
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
             
             
         }
            
            
         
         ?>
         
         </select>
    </div>
    
     <div class="form-group">
        <label for="post_user">Post User</label>
        
        <select class="form-control" name="post_user">
       
        <?php echo "<option value='{$post_user}'>{$post_user}</option>"; ?>
        <?php 
         //Pull out user incase the post has no user
         $query = "SELECT * FROM users";
         $select_users = mysqli_query($conn,$query);
         
        if(!$select_users){
            die("Query failed". mysqli_error($conn));    
        }
            
         while($row = mysqli_fetch_assoc($select_users)){
             $user_id = $row['user_id'];
             $user_name = $row['user_name'];
             
             echo "<option value='{$user_name}'>{$user_name}</option>";
         }
         
         ?>
         
         </select>
    </div>
    
    
     <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="" class="form-control">
         <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>
            <?php 
            
                if($post_status == 'Published'){
                   echo "<option value='Draft'>Draft</option>";
                } else{
                   echo "<option value='Published'>Published</option>";
                }
            ?>
            
        </select>
    </div>
    
     <div class="form-group">
        <label for="post_image">Post Image</label>
        <br>
        <img src="../images/<?php echo $post_image; ?>" width="100" name="post_image">
        <br>
        <br>
        <input type="file" name="post_image_file">
    </div>
    
     <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>
    
     <div class="form-group">
        <label for="post_content">Post Content</label>
         <textarea class="tinymce" name="post_content" id="" cols="30" rows="10" ><?php echo str_replace('\r\n','</br>',$post_content);?>
         </textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Update Post" name="edit_post">
    </div>
    
</form>