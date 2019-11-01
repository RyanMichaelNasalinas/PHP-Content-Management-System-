<?php 
    

    if(isset($_POST['create_post'])){
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category'];
        $post_user = $_POST['post_user'];
        $post_status = $_POST['post_status'];
        
        //Upload image
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        
        $post_tags = $_POST['post_tags']; 
        strip_tags($post_content = $_POST['post_content'], '<p><a>');
      
        
        //For date and comment count
        $post_date = date('d-m-y');
        $post_comment_count = 4;
        
        
        move_uploaded_file($post_image_temp, "../images/$post_image");
        
        
        $query = "INSERT into posts(post_cat_id,post_title,post_user,post_date,post_image,post_content,post_tags,post_status) VALUES({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";
        $create_post_query = mysqli_query($conn, $query);
        
        if(!$create_post_query){
            die("Query failed ". mysqli_error($conn));
        }
        
        $the_post_id = mysqli_insert_id($conn);
        echo " <div class='alert alert-success'><b>Post has been updated <a href='../blog-post.php?p_id={$the_post_id}'>View Post</a></b> or <b><a href='posts.php'>Edit More Posts</a></b></div>";
    }
 
   
   
   
?>   
   <form action="" method="post" enctype="multipart/form-data">
    
    
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    
    
     <div class="form-group">
        <label for="post_id">Post Category</label>
        
        <select class="form-control" name="post_category">
        <option>Select Category</option>
        <?php 
         
         $query = "SELECT * FROM categories";
         $select_categories = mysqli_query($conn,$query);
         
        if(!$select_categories){
            die("Query failed". mysqli_error($conn));    
        }
            
         while($row = mysqli_fetch_assoc($select_categories)){
             $cat_id = $row['cat_id'];
             $cat_title = $row['cat_title'];
             
             echo "<option value='{$cat_id}'>{$cat_title}</option>";
         }
         
         ?>
         
         </select>
    </div>
    
   <div class="form-group">
        <label for="post_user">Post User</label>

        <select class="form-control" name="post_user">
        <option>Select Users</option>
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
            <option value="Draft">Select Status</option>
            <option value="Draft">Draft</option>
            <option value="Published">Published</option>
        </select>
    </div>
    
     <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>
    
     <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    
     <div class="form-group">
        <label for="post_content">Post Content</label>
         <textarea class="tinymce" name="post_content" id="" cols="30" rows="10"></textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Publish Post" name="create_post">
    </div>
    
</form>