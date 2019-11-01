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
             
        //Making the pagination dynamically
                
            //Items per page of the pagination   
            $page_rows = 5;
                
                
                
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
                
                
        //Last page of the pagination       
        $last = ceil($count/$page_rows);
                
        if($last < 1){
            
            //Make sure last page cannot be less than one
            $last = 1;
    
        }  
         //Establish pagenumber       
        $pagenum = 1;
                
            //Get num variable from URL vars if it is prensent else 1    
        if(isset($_GET['pagen'])){
            $pagenum = preg_replace('#[^0-9]#', '',$_GET['pagen']);
        }        
        //Make sure pagenum number isn`t below 1, or more than our last page
            
        if ($pagenum < 1){
            $pagenum = 1;
        } elseif($pagenum > $last){
            $pagenum = $last;
        }         
                
        //Make a limit variable to limit the outcome on our database
        $limit = 'LIMIT '.($pagenum - 1) *  $page_rows. ','.$page_rows;       
            
                
            $query = "SELECT * FROM posts WHERE post_status = 'Published' ORDER BY post_id DESC $limit";
            $post_query = mysqli_query($conn,$query);
                
            //Make an variabe shows like this page 7 of etc.
           
            $textline = "Page <b>$pagenum</b> of <b>$last</b>";
              
                
            //Pagination controls
                
                $pagination = "";
                
            //Check if there are more than one results
                
                if($last != 1){
                    
                    if($pagenum > 1){
                        $prev = $pagenum - 1;
                        $pagination .= '<li ><a href="'.$_SERVER['PHP_SELF'].'?pagen='.$prev.'" ><i class="fa fa-angle-double-left"></i></a><li>';
                        
                        //Make a clickable on the left side
                        for($i = $pagenum - 4; $i < $pagenum; $i++){
                            if($i > 0){
                                $pagination .= '<li><a href="'.$_SERVER['PHP_SELF'].'?pagen='.$i.'">'.$i.'</a><li>';   
                            }
                             
                        }
                    }
                    
                    //Render the target page but not being a link
                    $pagination .= "<li><a class='activelink'>$pagenum</a><li>";
                    
                    for($i = $pagenum +1; $i <= $last;$i++){
                        $pagination .= '<li><a href="'.$_SERVER['PHP_SELF'].'?pagen='.$i.'">'.$i.'</a><li>';
                        if($i >= $pagenum + 4){
                            break;  
                        }
                    }
                    //Next button 
                    if($pagenum != $last){
                        $next = $pagenum + 1;
                        $pagination .= '<li><a href="'.$_SERVER['PHP_SELF'].'?pagen='.$next.'"><i class="fa fa-angle-double-right"></i></a><li>';   
                    }
                }
                
                
                echo $textline."<hr>";
                
                    
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
                <ul class="pager col-1g-12 col-md-12">
                   
                <!--Use for loop for the pagination-->
                <?php
                     
                   echo $pagination; 
                    
                    
                   ?>
                   

                    
                </ul>
               
           </div>
           
           

        <!-- Footer -->
        <?php  include "includes/footer.php"; ?>