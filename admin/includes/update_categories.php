
           <form action="" method="post">
            <div class="form-group">
            <label for="catTitle">Edit Category</label>
            <?php //EDIT QUERY 
                if(isset($_GET['edit'])){
                $cat_id = $_GET['edit'];
                $query = "SELECT * FROM categories WHERE cat_id={$cat_id}";
                    
                $edit_query = mysqli_query($conn,$query);
                  
                    
                while($row = mysqli_fetch_assoc($edit_query)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                ?>

                 <input type="text" class="form-control" name="editcatTitle" placeholder="Edit Category" value="<?php if(isset($cat_title)){echo $cat_title;} ?>"/>
                
                <?php  }}?> 

               <?php //UPDATE QUERY
                    if(isset($_POST['editCat'])){
                        $cat_title = ucfirst($_POST['editcatTitle']);
                        
                        if($cat_title == "" || empty($cat_title)){
                            echo "<div class='alert alert-danger alert-dismissible fade in'><b>Category must not be empty</b><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>"; 
                        }elseif(strlen($cat_title) <= 8){
                            echo "<div class='alert alert-danger alert-dismissible fade in'><b>Category must be longer than 8 characters</b><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                        } 
                        else{
                        
                        $query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = {$cat_id}";
                        $update_query = mysqli_query($conn,$query);
                            
                        echo "<div class='alert alert-success alert-dismissible fade in'><b>Category successfully updated</b><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                        
                        if(!$update_query){
                            die("Query Faild". mysqli_error());
                        }
                            }
                    } elseif(isset($_POST['cancelEdit'])){
                        header("Location: categories.php");
                    }
                
                
                ?>
               
                </div>
                <div class="form-group">
                <input type="submit" class="btn btn-success" name="editCat" value="Update"/>
                <input type="submit" class="btn btn-primary" name="cancelEdit" value="Cancel">
                </div>
                </form>