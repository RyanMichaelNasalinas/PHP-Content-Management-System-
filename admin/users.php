<?php include "includes/admin_header.php"; ?>

<?php 
    if(!is_admin($_SESSION['user_name'])){
        header("Location: index.php");   
    }


?>


    <div id="wrapper">

        <!-- Navigation -->
       
       
       <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <h1 class="page-header text-center">
                           <i class="fa fa-user"></i>&nbsp;Users
                        </h1>
            
                    <?php
                        if(isset($_GET['src'])){
                            $src = $_GET['src'];
                        } else {
                            $src = '';
                        }
                        
                        switch($src){
                                
                            case 'add_users';
                            include "includes/add_users.php";    
                            break;
                                
                            case 'edit_users';
                            include "includes/edit_users.php";   
                            break;
                            
                            case '22';
                            echo "WTF22";
                            break; 
                                
                            default:
                            include "includes/all_users.php";    
                                
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