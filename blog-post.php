<!--Includes-->
<?php include "includes/Database.php"; ?>
<?php include "includes/header.php"; ?>
  
   
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">       
                
        <?php
            if(isset($_GET['p_id'])){
                $post_id = $_GET['p_id'];
                
            $query_count_post = "UPDATE posts set post_count_views = post_count_views + 1 WHERE post_id ={$post_id}";     
            $query_count_post_views = mysqli_query($conn,$query_count_post);
                
            if(!$query_count_post_views){
                die("Query failed". mysqli_error($conn));
            }    
              
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin'){
               $query = "SELECT * FROM posts WHERE post_id= $post_id"; 
            } 
            else{
                $query = "SELECT * FROM posts WHERE post_id= $post_id AND post_status = 'Published'"; 
            }   
                
            
            $post_query = mysqli_query($conn,$query);
                
            if(mysqli_num_rows($post_query) < 1){
                echo "No posts available";
            }  else{  
                    
            while($row = mysqli_fetch_assoc($post_query))
            {
                
                $post_title = $row['post_title'];
                $post_author = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];    
        ?>
                
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?> </p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
               

                <hr>
                  
        <?php 
            } ?>

     
               
                <!-- Blog Comments -->
                
                <?php  
                        if(isset($_POST['create_comment'])){
                                $post_id = $_GET['p_id'];
                                $comment_author = $_POST['comment_author'];
                                $comment_email = $_POST['comment_email'];
                                $comment_content = $_POST['comment_content'];
                            
                            
                            if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                                //If fields are emptied ech
                            $query = "INSERT into comments (comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) 
                            VALUES ($post_id,'{$comment_author}','{$comment_email}','{$comment_content}','Unapproved',now())";
                            
                            $insert_comment_query = mysqli_query($conn,$query);
                             
                            if(!$insert_comment_query){
                                die("Query failed". mysqli_error($conn));
                            }
//                              
                          
                                } else{
                                echo "<script>window.alert('Fields cannot be empty')</script>";
                            }
                        }
                
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post" action="">
                       <div class="form-group">
                           <label for="Author">Author:</label>
                           
                          <?php 
                           if(isset($_SESSION['user_name'])){
                               $user_name =  $_SESSION['user_name'];
                               
                               ?>
                               <input type='text' name='comment_author' class='form-control' value='<?php echo "{$user_name}"; ?>'>
                               <?php
                               }
                             else{
                               
                               echo "<input type='text' name='comment_author' class='form-control'>";
                           }
                           
                           
                           ?> 
                            
                        </div>
                        
                        <div class="form-group">
                           <label for="Email">Email:</label>
                            <input type="email" name="comment_email" class="form-control" placeholder="example@email.com">
                        </div>
                        
                        <div class="form-group">
                           <label for="Comment">Comment Here:</label>
                            <textarea class="tinymce" name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit"  name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>    

                <!-- Posted Comments -->

               <?php
                $the_post_id = $_GET['p_id'];
                $query = "SELECT * from comments WHERE comment_post_id={$the_post_id} AND comment_status='Approved' ORDER BY comment_id DESC";
                $select_comment_query = mysqli_query($conn,$query);
                
                while($row = mysqli_fetch_assoc($select_comment_query)){
                    
                    $comment_author = $row['comment_author'];
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                ?>
            
                
                 <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>  
                   
                   
            <?php } } }else {

                header("Location: index.php");    
                }
            ?>
            

            </div>

            <!-- Blog Sidebar Widgets Column -->
            
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php  include "includes/footer.php"; ?>