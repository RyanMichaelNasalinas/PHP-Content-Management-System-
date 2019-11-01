<div class="col-md-4">               
               
                

               <!-- Login in form -->
                
                   
                    
                <?php //if(isset($_SESSION['user_role'])): ?>
<!--
                    <div class="well">
                   <h4 class='text-center'>Logged in as <?php //echo $_SESSION['user_name']; ?></h4>
                   <a href="admin" data-toggle="tool-tip" title="Manage Post"><i class='fa fa-tasks'></i></a>
                   <b>Manage Posts</b>
                    </div>
-->
                <?php //endif; ?> 
                     
                         <form action="" method="post" >
                    <?php 
                        if(isset($_SESSION['user_role'])){
                            echo " <div class='well'> <h4 class='text-center'>Logged in as  {$_SESSION['user_name']}</h4><i class='fa fa-tasks'></i>
                            <a href='admin' data-toggle='tool-tip' title='Manage Post' name='user'><b>Manage Posts</b></a>
                            
                            </div>";
                        }
                        
    
                    ?>
                     </form>
                     
                  <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>  
                    
               
               
            <?php 
                $query = "SELECT * FROM categories";
                $query_cat = mysqli_query($conn,$query);
            ?>
    
                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                               
                               <?php 
                                while($row = mysqli_fetch_assoc($query_cat))
                                {
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                    
                                    echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                                }
                                
                                ?>
                            </ul>
                        </div>
                       
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"; ?>

            </div>
