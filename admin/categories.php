<?php include "includes/admin_header.php"; ?>
   
    <div id="wrapper">

        <!-- Navigation -->   
       <?php include "includes/admin_navigation.php"; ?>

       
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                       
                         <h1 class="page-header text-center">
                            <i class="fa fa-list"></i>&nbsp; Categories
                        </h1>
                           <div class="col-xs-12 col-sm-6">
                             
                                    <?php //Insert new categories 
                                        insertCategories(); 
                                    ?> 
                                           
                    <form action="" method="post">
                        <div class="form-group">
                        <label for="catTitle">Add Category</label>
                        <input type="text" class="form-control" name="catTitle" placeholder="Add Category"/>
                       
                        </div>
                         <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="catSubmit" value="Add Category"/>
                         <input type="submit" class="btn btn-default" name="clear_category" value="Clear"/>
                        </div>
                           
                            </form>
                                <?php //Edit Query 
                                if(isset($_GET['edit'])){
                                    $cat_id = $_GET['edit'];
                                    include "includes/update_categories.php";
                                    }
                                ?> 
                            </div>                               
                            <div class="col-xs-6 table-responsive">
                                <table class="table table-hover text-center" > 
                                    <head>
                                        <tr style="background-color:#e6e6e6;">
<!--                                            <th class='text-center'>Id</th>-->
                                            <th class='text-center'>Category</th>
                                            <th class='text-center'>Edit</th>
                                            <th class='text-center'>Delete</th>
                                        </tr>
                                    </head>
                                    
                                    <?php //SHOW ALL CATEGORIES
                                        showCategories();
                                    ?>
                                    
                                    
                                    <?php //DELETE CATEGORIES
                                       deleteCategories();
                                    
                                    ?>
                                    
                                </table>
                            </div>
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