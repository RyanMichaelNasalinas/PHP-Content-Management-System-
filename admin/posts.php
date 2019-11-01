<?php include "includes/admin_header.php"; ?>
 
 
    <div id="wrapper">

        <!-- Navigation -->
       
       
       <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <h1 class="page-header text-center">
                           <i class="fa fa-file-text"></i>&nbsp; Posts
                            
                        </h1>
            
                    <?php 
                        if(isset($_GET['src'])){
                            $src = $_GET['src'];
                        } else {
                            $src = '';
                        }
                        
                        switch($src){
                                
                            case 'add_posts';
                            include "includes/add_posts.php";    
                            break;
                                
                            case 'edit_posts';
                            include "includes/edit_posts.php";   
                            break;
                            
                            case '22';
                            echo "WTF22";
                            break; 
                                
                            default:
                            include "includes/all_posts.php";    
                                
                        }
                        
                    ?>
                           
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