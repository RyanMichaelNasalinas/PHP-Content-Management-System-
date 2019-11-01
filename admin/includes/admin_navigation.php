           <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php" class="text-bold">Content Management System</a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
<!--               <li><a>User Online:<?php //echo userOnline(); ?></a></li>-->
<!--               <li><a href="#">User Online:<span class="useronline"></span></a></li>-->
                <li><a href="../index.php"><i class="fa fa-home fa-lg" data-toggle="tooltip" title="Home" data-placement="bottom"></i></a></li>
               
               
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                     <?php if(isset($_SESSION['user_name'])){
                            echo $_SESSION['user_name']; } ?> 
                   <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
<!--<li class="divider"></li>-->
                        
                    </ul>
                </li>
            </ul>
              
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                   
                    <li><a href='index.php'><i class='fa fa-dashboard fa-2x' style="color:#0099ff;"></i>&nbsp; Dashboard</a></li>

                    <li>
                        <a href="categories.php"><i class="fa fa-list fa-2x text-info" style="color:#0099ff;"></i>&nbsp; Categories</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#post"> <i class="fa fa-file-text fa-2x text-info" style="color:#0099ff;"></i>&nbsp; Posts<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="post" class="collapse">
                           
                           
                            <li>
                                <a href="posts.php"><i class="fa fa-eye"></i>&nbsp;View all posts</a>
                            </li>
                           
                            <li>
                            <a href="posts.php?src=add_posts"><i class="fa fa-plus"></i>&nbsp;Add posts</a>
                            </li>
                            
                            
                        </ul>
                    </li>
                    <li>
                        <a href="comments.php"><i class="fa fa-comments fa-2x text-info" style="color:#0099ff;"></i>&nbsp; Comments</a>
                    </li>
                    
                    <?php 
                        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Admin'){
                            echo '<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-user fa-2x text-info" style="color:#0099ff;"></i>&nbsp; Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="users" class="collapse">
                            <li>
                                <a href="users.php"><i class="fa fa-eye"></i>&nbsp;View all users</a>
                            </li>
                            <li>
                                <a href="users.php?src=add_users"><i class="fa fa-plus"></i>&nbsp;Add users</a>
                            </li>
                        </ul>
                    </li>';
                        }
                    ?>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>