       <table class="table table-bordered table-hover text-center">
                           <tr>
                               <th class="text-center">ID</th>
                               <th class="text-center">Username</th>
                               <th class="text-center">Firstname</th>
                               <th class="text-center">Lastname</th>
                               <th class="text-center">Email</th>
                               <th class="text-center">Role</th>
                               <th class="text-center">Make an admin</th>
                               <th class="text-center">Change to user</th>
                               <th class="text-center">Edit</th>
                               <th class="text-center">Delete</th>
                           </tr>
                        <?php 
                               
                           $query = "SELECT * FROM users";
                           $users_query = mysqli_query($conn, $query);
                           
                        ?>   
                          
                          <?php 
                           
                           while($row = mysqli_fetch_assoc($users_query))
                           {
                               
                                $user_id = $row['user_id'];
                                $user_name = $row['user_name'];
                                $user_password = $row['user_password'];
                                $user_firstname = $row['user_firstname'];
                                $user_lastname = $row['user_lastname'];
                                $user_email = $row['user_email'];
                                $user_image = $row['user_image'];
                                $user_role = $row['user_role'];
//                                $user_date_created = $row['comment_id'];
//                               
                                    echo "<tr>";
                                    echo "<td>{$user_id}</td>";
                                    echo "<td>{$user_name}</td>";
                                    echo "<td>{$user_firstname}</td>";
                                    echo "<td>{$user_lastname}</td>";
                                    echo "<td>{$user_email}</td>";
                               
                               
                               //Display post title dynamically
                               
                                    
                               
                               
                    echo "<td>{$user_role}</td>";
                    echo "<td class='text-center'><a href='users.php?change_to_admin={$user_id}' class='btn btn-warning' data-toggle='tooltip' title='Change to Admin' data-placement='top'><i class='fa fa-user'></i></a></td>"; 
                    echo "<td class='text-center'><a href='users.php?change_to_user={$user_id}' class='btn btn-primary' data-toggle='tooltip' title='Change to User' data-placement='top'><i class='fa fa-user'></a></td>";
                    echo "<td class='text-center'><a href='users.php?src=edit_users&user_id={$user_id}' class='btn btn-success'><i class='fa fa-edit'></i></a></td>";  
                    echo "<td class='text-center'><a href='users.php?delete_user={$user_id}' class='btn btn-danger'><i class='fa fa-trash'></i></a></td>";    
                    echo "</tr>";
                           }
                           
                           
                        ?>
                           
                        
                            <?php 
           
                            //Change user role to Admin
                            if(isset($_GET['change_to_admin'])){
                                $user_id = $_GET['change_to_admin'];
                                
                                $query = "UPDATE users SET user_role='Admin' WHERE user_id=$user_id";
                                $change_to_admin_query = mysqli_query($conn,$query);
                                header("location: users.php");
                            }
                                     
                            //Change user role to User
                            if(isset($_GET['change_to_user'])){
                                $user_id = $_GET['change_to_user'];
                                
                                $query = "UPDATE users SET user_role='User' WHERE user_id=$user_id";
                                $change_to_user_query = mysqli_query($conn,$query);
                                header("location: users.php");
                            }
                            
                            
                            //Delete comments query
                            if(isset($_GET['delete_user'])){
                                
                                if(isset($_SESSION['user_role'])){
                                    if($_SESSION['user_role'] == 'Admin'){
                                       
                                         $delete_user_id = mysqli_real_escape_string($conn,$_GET['delete_user']);

                                        $query = "DELETE from users WHERE user_id=$delete_user_id";
                                        $delete_query = mysqli_query($conn,$query);

                                        header("location: users.php");
                                        
                                    }
                                }
                                
                               
                            }        
                

                            ?>

                       </table>