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
    
            
                
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin'){
               $count_posts = "SELECT * FROM posts"; 
            }   else{
                $count_posts = "SELECT * FROM posts WHERE post_status = 'Published'";
            } 
                 
                
           
           $count_posts_query = mysqli_query($conn,$count_posts);
           $count = mysqli_num_rows($count_posts_query);    
               
            if($count < 1){
                echo "<h1 class='text-center'>No posts available</h1>";
            } else{
                

                
            $query = "SELECT * FROM posts";
            $post_query = mysqli_query($conn,$query);
                
            while($row = mysqli_fetch_assoc($post_query))
            {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'],0,150);
                $post_status = $row['post_status'];
                
                
        ?>
               
                 
                <h1 class="page-header">
                     <Heading>Page</Heading>
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="blog-post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?> </p>
                <hr>
                <a href="blog-post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="blog-post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                  
        <?php  } }?>

                 
                
              
              

            </div>

           
            <!-- Blog Sidebar Widgets Column -->
            
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
        
           <div class="row">
                 <!-- Pager -->
                      
                  <?php
                echo '<ul class="pager col-1g-12 col-md-12">';   
                    
                 //Create a pagination function 
                
                function pagination($conn,$table,$pageno,$no){
                    global $conn;
                  $query = $conn->query("SELECT COUNT(*) as rows FROM ". $table);
                    //Match this variables in function paramaters
                    $row = mysqli_fetch_assoc($query);
                    $page_num = $pageno;
                    $page_numperpage = $no;
                    
                    $last_page = ceil($row["rows"]/$page_numperpage);
                    
                    $pagination = "";
                    
                    if($last_page != 1){
                        //Crea a previous button 
                        if($page_num > 1){
                            $prev = "";
                            $prev = $page_num - 1;
                            $pagination .= "<li><a href='index.php?pageno=".$prev."'>Previous</a></li>";
                            
                        }
                        //Page number - 5  ,Loop the last_page = total records + display all pages
                        for($i = $page_num - 5;$i < $page_num; $i++){
                            
                            //Make sure that it will not going to be negative 
                             if($i > 0){
                               $pagination .= "<li><a href='index.php?pageno=".$i."'>".$i."</a></li>"; 
                            }
                          
                            
                        }
                        //Display the current page and putting an active class
                        $pagination .= "<li><a href='index.php?pageno=".$page_num."' style='background-color: red;color:white;'>$page_num</a></li>";
                        
                        //Display the next pages after the current page 
                        for($i = $page_num +1;$i <= $last_page;$i++){
                            $pagination .= "<li><a href='index.php?pageno=".$i."'>".$i."</a></li>";
                            //Break if the link is going to 5
                            if($i > 5){
                                break;
                            }
                        }
                        
                        //Display the next button
                        if($last_page > $page_num){
                            $next = $page_num + 1;
                            $pagination .= "<li><a href='index.php?pageno=".$next."'>Next</a></li>";
                        }
                    }
                    
                    //Limit for SQL query for ex 0,10 and 10,10
                    $limit = "LIMIT ".($page_num - 1) * $page_numperpage. ",".$page_numperpage;
                    
                    return ["pagination"=>$pagination,"limit"=>$limit];
                    
                    echo '</ul>';
                }
                    
                    if(isset($_GET['pageno'])){
                        $page_num = $_GET['pageno'];
                        $table = "posts";
                        
                         $array = pagination($conn,$table,$page_num,1);
                        
                        $sql = "SELECT * FROM ".$table." ".$array["limit"];
                        
                        $query = $conn->query($sql);
                        
                        
                        
                        while($row = mysqli_fetch_assoc($query)){
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_user'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = substr($row['post_content'],0,150);
                            $post_status = $row['post_status'];
                            
                        }
                        
                        echo $array["pagination"];
                    }
        
          
                ?>
               
                   
                
                
               
           </div>
           
           

        <!-- Footer -->
        <?php  include "includes/footer.php"; ?>;