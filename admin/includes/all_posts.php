<?php 

include ("delete_modal.php");

    
     

 
?>
                    
                        <form action="" method="post">
                        
                          
                        
                            <div class="form-group col-lg-6 col-sm-12">
                                    <input type="text" class="form-control" id="my_filter" placeholder="Filter table..">
                            </div> 
                         
                         
                         <hr>
                          <table class="table table-bordered text-center table-hover">
                          <thead>
                           <tr>
                              <th class='text-center'><input type="checkbox" id="check_all_boxes"></th>
                               <th class='text-center'>ID</th>
                               <th class='text-center'>User</th>
                               <th class='text-center'>Title</th>
                               <th class='text-center'>Category</th>
                               <th class='text-center'>Status</th>
                               <th class='text-center'>Image</th>
                               <th class='text-center'>Tags</th>
                               <th class='text-center'>Comments</th>
                               <th class='text-center'>Date</th>
                               <th class='text-center'>View Post</th>
                               <th class='text-center'>Post views</th>
                               <th class='text-center'>Action</th>
                               <th class='text-center'>Delete</th>
                           </tr>
                        </thead>
                         <tbody id="my_table">
                          <?php 
                           

                              
    #Join table posts and categories for a better stability and keep the database have some enough memory to do other stuff.                          
    $query = "SELECT posts.post_id,posts.post_author, posts.post_user, posts.post_title, posts.post_cat_id, posts.post_status, posts.post_image, posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_count_views, categories.cat_id, categories.cat_title FROM posts LEFT JOIN categories ON posts.post_cat_id = categories.cat_id ORDER BY posts.post_id DESC LIMIT 5";
                           $posts_query = mysqli_query($conn, $query);
                           
                            if(!$posts_query){
                                die("Query failed " .  mysqli_error($conn));
                            }  
                              
                              
                           while($row = mysqli_fetch_assoc($posts_query))
                           {
                                $post_id = $row['post_id'];
                                $post_author = $row['post_author'];
                                $post_user = $row['post_user'];
                                $post_title = $row['post_title'];
                                $post_category = $row['post_cat_id'];
                                $post_status = $row['post_status'];
                                $post_image = $row['post_image'];
                                $post_tags = $row['post_tags'];
                                $post_comment_count = $row['post_comment_count'];
                                $post_date = $row['post_date'];
                                $post_count_views = $row['post_count_views'];
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];
                               
                               
                               echo "<tr>";
                               
                               
                               ?>
                               <td><input type="checkbox" class="checkBoxes" name="check_boxArray[]" value="<?php echo $post_id; ?>"></td>
                                <?php   
                                    echo "<td>{$post_id}</td>";
                               
                               //Check if the post author has user or no
                               
                               if(!empty($post_author)){
                                   
                                    echo "<td>{$post_author}</td>";
                                   
                               } elseif(!empty($post_user)){
                                   
                                    echo "<td>{$post_user}</td>";
                               }
                               
                               
                                    echo "<td>{$post_title}</td>";
                               
                               
                                    echo "<td>{$cat_title}</td>";
                             
                               
                                    
                                    echo "<td>{$post_status}</td>";
                                    echo "<td><img width='50' height='auto' alt='images' src='../images/{$post_image}'</td>";
                                    echo "<td>{$post_tags}</td>";
                               
                                //Count the numbers of comments        
                               $query_count = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                               $send_comment_count = mysqli_query($conn,$query_count);
                               $row = mysqli_fetch_array($send_comment_count);
                               $comment_id = $row['comment_id'];
                               $comment_count_row = mysqli_num_rows($send_comment_count);
                               
                               
                                    //Create a link to view the comments
                            echo "<td><a href='post_comment.php?id=$post_id'><span class='badge'>{$comment_count_row}</span></a></td>";
                            echo "<td>{$post_date}</td>";

                            echo "<td><a href='../blog-post.php?p_id={$post_id}'>View Post</a></td>"; 
                            echo "<td><span class='badge'>{$post_count_views}</span></td>";
                            echo "<td><a href='posts.php?src=edit_posts&p_id={$post_id}' class='btn btn-primary' data-toggle='tooltip' title='Edit Post'><i class='fa fa-edit'></i></a>&nbsp;</td>";    
//                            echo "<td><a href='posts.php?delete={$post_id}' class='btn btn-danger' data-toggle='tooltip' title='Delete Post' onClick=\"javascipt: return confirm('Are you sure you want to delete'); \"><i class='fa fa-trash'></i></a></td>"; 
                             echo "<td><a href='javascript:void(0)' rel='$post_id' class='btn btn-danger delete_link' data-toggle='tooltip' title='Delete Post'><i class='fa fa-trash'></i></a></td>";    
                               echo "</tr>";
                           }
                           
                        
                           ?>

                        
                            <?php 
                            if(isset($_GET['delete'])){
                                $delete_post_id = $_GET['delete'];
                                
                                $query = "DELETE from posts where post_id={$delete_post_id}";
                                $delete_query = mysqli_query($conn,$query);
                                
                                header("location: posts.php");
                            }        
                
                            

                            ?>
                            </tbody>
                       </table>
                  <hr>       
           <table>
             <tr>   
             <td><button class="btn btn-primary" name="published_all_select" title="Published All Selected" data-toggle="tooltip" data-placement="right"><i class='fa fa-newspaper-o'></i></button>&nbsp;</td>
                                        
            <td><button class="btn btn-primary" name="draft_all_selected" title="Draft All Selected" data-toggle="tooltip" data-placement="right"><i class='fa fa-pencil'></i></button>&nbsp;</td> 
            
            <td><button class="btn btn-primary" name="duplicate_all_selected" title="Duplicate All Selected" data-toggle="tooltip" data-placement="right"><i class="fa fa-angle-double-up"></i></button>&nbsp;</td>
                 
             <td><button class="btn btn-primary" name="reset_view_all_selected" title="Reset View Count All Selected" data-toggle="tooltip" data-placement="right"><i class='fa fa-undo'></i></button>&nbsp;</td>                       
                      
             <td><button class="btn btn-danger" name="delete_all_selected" title="Delete All Selected" data-toggle="tooltip" data-placement="right"><i class='fa fa-trash'></i></button>&nbsp;</td>
                                
              </tr>         
            </table>
                      
                       <?php
                            //Published all posts
                            if(isset($_POST['published_all_select'])){
                                
                                if(empty($_POST["check_boxArray"])){
                                    echo "Please tick the checkbox"; 
                                } else{ 
                                
                                foreach($_POST['check_boxArray'] as $check_box_array){
                                       
                                //Set a status value Publish  
                                $Published = "Published";
                                    
                                
                                $query_published_all = "UPDATE posts SET post_status ='{$Published}' WHERE post_id={$check_box_array}";
                                $update_to_published_all = mysqli_query($conn,$query_published_all);
                                if(!$update_to_published_all){
                                    die("Query failed". mysqli_error(conn));
                                }            
                                    
                                    header("Location: posts.php");  
                                }
                            }  
                               
                        } 
                            
                            //Draft all the post
                            if(isset($_POST['draft_all_selected'])){
                                
                                if(empty($_POST['check_boxArray'])){
                                    echo "Please tick the check box";
                                } else {
                                foreach($_POST['check_boxArray'] as $check_box_array){
                                $Draft = "Draft";
                                    
                                $query_update1 = "UPDATE posts SET post_status ='{$Draft}' WHERE post_id={$check_box_array}";
                                $update_to_published_status1 = mysqli_query($conn,$query_update1);
                                if(!$update_to_published_status1){
                                    die("Query failed". mysqli_error(conn));
                                }            
                                    
                                    header("Location: posts.php");
                                    } 
                                }    
                            }
                            
                            
                            //Duplicate all Selected in the tick box
                            if(isset($_POST['duplicate_all_selected'])){    
                                if(empty($_POST['check_boxArray'])){
                                    echo "Pleace tick the check box";
                                } else{
                                foreach($_POST['check_boxArray'] as $check_box_array){
                            
                            $query_duplicate_all = "SELECT * from posts WHERE post_id={$check_box_array}";
                            $update_duplicate_post = mysqli_query($conn,$query_duplicate_all);
                            while($row = mysqli_fetch_assoc($update_duplicate_post)){
                                    $post_cat_id = $row['post_cat_id'];
                                    $post_title = $row['post_title'];
                                    $post_author = $row['post_author'];
                                    $post_user = $row['post_user'];
                                    $post_date = $row['post_date'];
                                    $post_image = $row['post_image'];
                                    $post_content = $row['post_content'];
                                    $post_tags = $row['post_tags'];
                                    $post_status = $row['post_status'];
                    
                                    //If the posts if empty
                    
                                if(empty($post_tags)){
                                    $post_tags = "No tag for this post";
                                }

                            }    
                 
                            $update_duplicate_post = "INSERT into posts (post_cat_id, post_title, post_author,post_user, post_date, post_image,post_content,post_tags,post_status) VALUES ($post_cat_id,'$post_title','$post_author','$post_user',now(),'$post_image','$post_content','$post_tags','$post_status')";

                                $duplicate_post = mysqli_query($conn,$update_duplicate_post);          
                                    
                                if(!$duplicate_post){
                                    die("Query failed". mysqli_error($conn));
                                        } 
                                     header("Location: posts.php");
                                    }  
                                }
                            }
                            
                            //Reset all view counts
                            if(isset($_POST['reset_view_all_selected'])){
                                if(empty($_POST['check_boxArray'])){
                                    echo "Pleace tick the check box";
                                } else{
                                foreach($_POST['check_boxArray'] as $check_box_array){
                            
                                    $query_reset_view_counts = "UPDATE posts SET post_count_views = 0 WHERE post_id={$check_value_id}";
                                    $reset_view = mysqli_query($conn,$query_reset_view_counts);  
                                if(!$reset_view){
                                    die("Query failed". mysqli_error($conn));
                                    } 
                                     header("Location: posts.php");
                                    }  
                                }
                            }
                            
                            
                            
                            //Delete all Selected in the tick box
                            if(isset($_POST['delete_all_selected'])){
                                if(empty($_POST['check_boxArray'])){
                                    echo "Pleace tick the check box";
                                } else{
                                foreach($_POST['check_boxArray'] as $check_box_array){
                            
                                 $query_delete1 = "DELETE from posts WHERE post_id={$check_box_array}";
                                $update_to_delete_status1 = mysqli_query($conn,$query_delete1);
                                if(!$update_to_delete_status1){
                                    die("Query failed". mysqli_error($conn));
                                    } 
                                     header("Location: posts.php");
                                    }  
                                }
                            }
                            
                        ?> 
                          
                       </form>
                       
                       
                       
                      <script>
                          //Create a modal for deleteing the post
                          $(document).ready(function(){
                              //Delete post using modal
                              $(".delete_link").on("click", function(){
                                  //Get the attribute
                                var id = $(this).attr("rel");
                                  //Get the dynamic ID from php to javascript
                                 var delete_url = "posts.php?delete="+id+"";
                                  
                                  $(".modal-delete").attr("href", delete_url);
                                  
                                  $("#deleteModal").modal("show");
                                  
                              });
                              //Filter table
                              $("#my_filter").on("keyup", function(){
                                  var value = $(this).val().toLowerCase();
                                  $("#my_table tr").filter(function(){
                                      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                  });
                              });
                              
                              
                          });
                    
                    </script>
                       
                 
                   