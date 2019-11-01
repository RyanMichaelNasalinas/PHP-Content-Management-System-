<?php  include "includes/admin_header.php"; ?>

  
    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>
        
        

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                         <h1 class="page-header text-center">
                            <i class="fa fa-dashboard"></i>&nbsp;Dashboard 
                        </h1>
                       
<!--
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
-->
                    </div>
                </div>
                <!-- /.row -->


                <!-- /.row -->

                      
                <!-- /.row -->
                
                <div class="row">
                   <!--Display post number dynamically-->
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    
                                    
                                    <?php  
                                        $query = "SELECT * from posts";
                                        $select_all_posts = mysqli_query($conn,$query);
                                        $count_posts = mysqli_num_rows($select_all_posts);
                                        
                                        echo  "<div class='huge'>{$count_posts}</div>";
                                    ?>
                                  
                                       
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    
                    
                    <!--Display comments number dynamically-->
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php  
                                        $query = "SELECT * from comments";
                                        $select_all_comments = mysqli_query($conn,$query);
                                        $count_comments = mysqli_num_rows($select_all_comments);
                                        
                                        echo  "<div class='huge'>{$count_comments}</div>";
                                    ?>
                                  
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    
                    <!--Display users number dynamically-->
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                     <?php  
                                        $query = "SELECT * from users";
                                        $select_all_users = mysqli_query($conn,$query);
                                        $count_users = mysqli_num_rows($select_all_users);
                                        
                                        echo  "<div class='huge'>{$count_users}</div>";
                                    ?>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                     <!--Display users number dynamically-->
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                        
                                        $query = "SELECT * from categories";
                                        $select_all_categories = mysqli_query($conn,$query);
                                        $count_categories = mysqli_num_rows($select_all_categories);
                                        
                                        echo  "<div class='huge'>{$count_categories}</div>";
                                    ?>
                                         <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> 
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                
                <?php 
                
            $query_published = "SELECT * from posts WHERE post_status='Published'";
            $select_published_post = mysqli_query($conn,$query_published);
            $count_published_post = mysqli_num_rows($select_published_post);    
                
            $query_draft = "SELECT * from posts WHERE post_status ='Draft'";
            $select_draft_posts = mysqli_query($conn,$query_draft);
            $count_draft_post = mysqli_num_rows($select_draft_posts);    
                
                
            $query_unapproved = "SELECT * from comments WHERE comment_status = 'Unapproved'";
            $select_unapproved = mysqli_query($conn,$query_unapproved);
            $count_unapproved_comments = mysqli_num_rows($select_unapproved);
                
            $query_users = "SELECT * from users WHERE user_role = 'User'";
            $select_users = mysqli_query($conn,$query_users);
            $count_not_admin = mysqli_num_rows($select_users);    
                
                
                ?>
                   
                <!-- /.row -->
                <div class="row">
                    <script>
                window.onload = function () {

                    var chart = new CanvasJS.Chart("chartContainer1", {
                        animationEnabled: true,
                        theme: "light2", // "light1", "light2", "dark1", "dark2"
                        title:{
                            text: "",
                        },

                    data: [{        
                        type: "column",  
                        showInLegend: true, 
                        legendMarkerColor: "",
                        legendText: "",
                        dataPoints: [ 
                            <?php 
                            $element_text = ['All Post','Published Post','Draft Posts','Comments','Pending Comments','Users','Not Admin','Categories'];
                            $element_count = [$count_posts,$count_published_post, $count_draft_post,  $count_comments,$count_unapproved_comments, $count_users, $count_not_admin,$count_categories];
                            
                            for($i = 0; $i < 8; $i++){
                                
                                echo "{". "y:{$element_count[$i]}," . "label:". "'{$element_text[$i]}'". "},";
                                
                                
                            }
                            ?>
                            
                        ]
                    }]
                });
                chart.render();
                
                    

                }
                </script>
    
                    <div id="chartContainer1" style="height: 370px; max-width: auto; margin: 0px auto;"></div>
                    
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
   
    
 <!--Canvas -->
   <script src="../js/canvasjs.min.js"></script>
    

   
   <?php  include "includes/admin_footer.php"; ?>
   