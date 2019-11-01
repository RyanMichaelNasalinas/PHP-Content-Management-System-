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
                          Comments
                            <small>By Admin</small>
                        </h1>

   <?php
    if(isset($_POST['check_boxArray'])){
        foreach($_POST['check_boxArray'] as $comment_id_value){
            $bulk_comment_option = $_POST['bulk_comment_option'];
            
            switch($bulk_comment_option){
                //Approve all comments query    
                case 'Approve':
                $query_approve_comment = "UPDATE comments set comment_status='{$bulk_comment_option}' WHERE comment_id={$comment_id_value}";
                $send_approve_comment = mysqli_query($conn,$query_approve_comment);
                    if(!$send_approve_comment){
                        die("Query failed".mysqli_error($conn));
                    }
                break;  
                //Unpprove all comments query     
                case 'Unapprove':
                $query_unapprove_comment = "UPDATE comments set comment_status='{$bulk_comment_option}' WHERE comment_id={$comment_id_value}";
                $send_unapprove_comment = mysqli_query($conn,$query_unapprove_comment);
                    if(!$send_unapprove_comment){
                        die("Query failed" . mysqli_error($conn));
                    } 
                break;
                //Delete all comments query  
                case 'Delete':
                $query_delete_comment = "DELETE from comments WHERE comment_id={$comment_id_value}";
                $send_delete_query = mysqli_query($conn,$query_delete_comment);
                    if(!$send_delete_query){
                        die("Query failed". mysqli_error($conn));   
                    }
                break;
            }
        }
    }



?>
                         
                         <form action="" method="post">
                             <div class="row" >
                                <div class='col-xs-4'>
                                 <select name="bulk_comment_option" id="" class='form-control'>
                                   <option value="">Select Option --</option>
                                    <option value="Approve">Approve</option>
                                    <option value="Unapprove">Uanpprove</option>
                                    <option value="Delete">Delete</option>
                                 </select>
                                 
                                </div> 
                                <div class='col-xs-4'>
                                    <input type="submit" class='btn btn-success' value='Apply'>
                                </div>
                             </div>
                             
                         
                          
                          
                          <table class="table table-bordered table-hover text-center">
                           <tr>
                              <th class='text-center'><input type="checkbox" id="check_all_boxes"></th>
                               <th class='text-center'>ID</th>
                               <th class='text-center'>Author</th>
                               <th class='text-center'>Comment</th>
                               <th class='text-center'>Email</th>
                               <th class='text-center'>Status</th>
                               <th class='text-center'>Post title</th>
                               <th class='text-center'>Date</th>
                               <th class='text-center'>Approve</th>
                               <th class='text-center'>Unapprove</th>
                                <th class='text-center'>Delete</th>
                           </tr>
                        <?php 
                    
                              
                           $query = "SELECT * FROM comments WHERE comment_post_id =".mysqli_real_escape_string($conn,$_GET['id'])."";
                           $comment_query = mysqli_query($conn, $query);
                           
                           while($row = mysqli_fetch_assoc($comment_query))
                           {
                               
                                $comment_id = $row['comment_id'];
                                $comment_post_id = $row['comment_post_id'];
                                $comment_author = $row['comment_author'];
                                $comment_email = $row['comment_email'];
                                $comment_content = $row['comment_content'];
                                $comment_status = $row['comment_status'];
                                $comment_date = $row['comment_date'];
                                
                               
                               
                                    echo "<tr>";
                               ?>
                                <td><input type="checkbox"  class="checkBoxes" name="check_boxArray[]" value="<?php echo $comment_id; ?>"></td>
                               <?php
                                    echo "<td>{$comment_id}</td>";
                                    echo "<td>{$comment_author}</td>";
                                    echo "<td>{$comment_content}</td>";
                                    echo "<td>{$comment_email}</td>";
                                    echo "<td>{$comment_status}</td>";
                               
                               
                               //Display post title dynamically
                               
                                    $query = "SELECT * FROM posts WHERE post_id=$comment_post_id";
                                    $select_post_comment_id = mysqli_query($conn,$query);
                                    while($row = mysqli_fetch_assoc($select_post_comment_id)){
                                        $post_id = $row['post_id'];
                                        $post_title = $row['post_title'];
                                        
                                        echo "<td><a href='../blog-post.php?p_id=$post_id'>{$post_title}</a></td>";
                                    }
                               
                               
                                    echo "<td>{$comment_date}</td>";
                                    echo "<td><a href='post_comment.php?Approve=$comment_id&id=".$_GET['id']."' class='btn btn-success'><i class='fa fa-thumbs-up'></i></a></td>";    
                                    echo "<td><a href='post_comment.php?Unapprove=$comment_id&id=" .$_GET['id']. "' class='btn btn-primary'><i class='fa fa-thumbs-down'></i></a></td>";        
                                    echo "<td><a href='post_comment.php?delete_comment=$comment_id&id=" .$_GET['id']. "' class='btn btn-danger'><i class='fa fa-trash'></i></a></td>";    
                                echo "</tr>";
                           }
                           
                           
                           ?>
                           
                        
                            <?php 
           
                            //Approve comment status
                            if(isset($_GET['Approve'])){
                                $comment_id = $_GET['Approve'];
                                
                                $query = "UPDATE comments SET comment_status='Approved' WHERE comment_id=$comment_id";
                                $Approve_query = mysqli_query($conn,$query);
                                //Create a new get request because we are unable to identify this ID.
                                 header("location: post_comment.php?id=".$_GET['id']."");
                            }
                                     
                            //Unapprove comment status
                            if(isset($_GET['Unapprove'])){
                                $comment_id = $_GET['Unapprove'];
                                
                                $query = "UPDATE comments SET comment_status='Unapproved' WHERE comment_id=$comment_id";
                                $Unapprove_query = mysqli_query($conn,$query);
                                //Create a new get request because we are unable to identify this ID.
                                 header("location: post_comment.php?id=".$_GET['id']."");
                            }
                            
                            
                            //Delete comments query
                            if(isset($_GET['delete_comment'])){
                                $delete_comment_id = $_GET['delete_comment'];
                                
                                $query = "DELETE from comments WHERE comment_id=$delete_comment_id";
                                $delete_query = mysqli_query($conn,$query);
                                //Create a new get request because we are unable to identify this ID.
                                header("location: post_comment.php?id=".$_GET['id']."");
                            }        
                

                            ?>

                       </table>
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