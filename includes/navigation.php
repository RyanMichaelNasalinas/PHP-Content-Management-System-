 
       

         <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<!--         <div class="bg-danger">asdasdasdsada</div>-->
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <a class="navbar-brand" href="index.php">Blog</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                
                
               
               
               <?php
                $query = "SELECT * FROM categories LIMIT 3";
                $cat_query = mysqli_query($conn,$query); 
                
                    while($row = mysqli_fetch_assoc($cat_query))
                    {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        
                        //Empty category active class name
                        $category_class = '';
                        
                        //Empty registration actibe class name
                        $registration_class = '';
                        
                        //Empty index active class name
                        $index_class = '';
                        
                         //Empty contact active class name
                        $contact_class = '';
                        
                        //Get the name on what link we are
                        $page_name = basename($_SERVER['PHP_SELF']);
                        
                        //Registration.php name
                        $registration = 'registration.php';
                        
                        //Registration.php name
                        $index = 'index.php';
                        
                        //Registration.php name
                        $contact = 'contact.php';
                        
                        if(isset($_GET['category']) && $_GET['category'] == $cat_id){
                            $category_class = 'active';
                        } elseif($page_name == $registration){
                            $registration_class = 'active';
                        } elseif($page_name == $index){
                            $index_class = 'active';
                        } elseif($page_name == $contact){
                            $contact_class = 'active';
                        }
                        ?>
                        
                        
                        
                        
                        <?php
            
                        echo "<li  class='$category_class'><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                        
                    }
                     
                ?>
                
                   
                     <li  class="<?php echo $contact_class; ?>">
                        <a href="contact.php">Contact</a>
                    </li>
                    
                    
                <?php 
                    if(isset($_SESSION['user_role'])){
                        if($_SESSION['user_role'] == 'Admin'){
                               if(isset($_GET['p_id'])){
                                $p_id = $_GET['p_id'];
                                echo "<li><a href='admin/posts.php?src=edit_posts&p_id={$p_id}'>Edit Post</a><li>";
                            } 
                        }
                        
                    }    
                        
                ?>
               
                </ul>
                 <form class="navbar-form navbar-right" action="includes/logout.php" method="post">
                 <?php 
                    //Check if session user_role is active
                    if(isset($_SESSION['user_role'])){
                        echo ' <button type="submit" class="btn btn-danger" name="logout"><i class="fa fa-sign-out">&nbsp;Log Out</i></button>';
                    } else {
                        echo '<a href="login.php" class="btn btn-default"><i class="fa fa-sign-in">&nbsp;Log In</i></a>';
                    }     
                ?>
                </form>
                <?php 
                    if(!isset($_SESSION['user_role'])){
                        echo ' <ul class="nav navbar-nav navbar-right">
                                <li><a href="registration.php">Sign Up</a></li>
                            </ul>';
                    }
                
                
                ?>
               
               
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>