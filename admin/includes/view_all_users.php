<table class="table table-bodered table-hover">


    <thead>

        <thead>
            <tr>
                <th>Id</th>
                <th>User</th>
                <th>First.N</th>
                <th>Last.N</th>
                <th>Email</th>
                <th>Role</th>
                <th>Adjust Role</th>
                <th>Edit</th>
                <th>Remove</th>
            </tr>
        </thead>


    </thead>

    <tbody>
        <?php 
                    
                            $query_display_users = "SELECT * FROM users";
                    
                            $query_display_users = mysqli_query($conn, $query_display_users);
                       
                            if (!$query_display_users){
                                
                                die("ERROR FETCHING users" . mysqli_error($conn));
                                
                            } else {
                                
                                while ($row_display_users = mysqli_fetch_assoc($query_display_users)){
                                    
                                    $user_id = $row_display_users['user_id'];
                                    
                                    $username = $row_display_users['user_name'];
                                   
                                    $first_name = $row_display_users['first_name'];
                                    
                                    $last_name = $row_display_users['last_name'];
                                    
                                    $user_role = $row_display_users['user_role'];
                                    
                                    $user_email = $row_display_users['user_email'];
                                    
                                    
                                    
                                  
                                    
                            ?>

        <tr>

            <td>
                <?php echo $user_id; ?>
            </td>
            <td>
                <?php echo $username; ?>
            </td>
            <td>
                <?php echo $first_name; ?>
            </td>
            <td>
                <?php echo $last_name; ?>
            </td>
            <td>
                <?php echo $user_email; ?>
            </td>
            <td>
                <?php echo $user_role; ?>
            </td>


            <?php 
                                    
                                    $role_asigned = $user_role;
                                    
                                            switch ($role_asigned){
                                                    
                                                    
                                                case "subscriber": echo "<td><a href='users.php?to_admin=$user_id' type='button' class='btn btn-default btn-md'><span class='glyphicon glyphicon-hand-right'> Admin</span></a></td>";
                                                    break;
                                                    
                                                case "admin": echo "<td><a href='users.php?to_Subscriber=$user_id' type='button' class='btn btn-default btn-md'><span class='glyphicon glyphicon-hand-right'> Subscriber</span></a></td>";
                                                    break;
                                               
                                                default: echo "<td><div class = 'alert alert-warning'>No Role Asigned<div></td>";
                                                    break;
                                                    
                                            }
                                    
                                    
                                     ?>


            <td><a href="users.php?edit_user=<?php echo $user_id; ?>&source=edit_user" type="button" class="btn btn-default btn-primary btn-md"><span class="glyphicon glyphicon-edit"></span></a></td>


            <td><a href="users.php?delete_user=<?php echo $user_id; ?>" type="button" class="btn btn-default btn-danger btn-md"><span class="glyphicon glyphicon-remove"></span></a></td>



        </tr>

        <?php      }
                                
                            }
                    
                       ?>



        <?php 
                      
                        if (isset($_GET['to_admin'])){
                            
                            $to_admin_id = $_GET['to_admin'];
                            
                            $admin_query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$to_admin_id} ";
                            
                            $admin_result = mysqli_query($conn, $admin_query);
                            
                            
                             header("LOCATION: users.php");
        
                        } else if (isset($_GET['to_Subscriber'])){
                            
                            $to_subscriber_id = $_GET['to_Subscriber'];
                            
                            $subscriber_query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$to_subscriber_id} ";
                            
                            $subscriber_result = mysqli_query($conn, $subscriber_query);
                            
                                                    
                            header("LOCATION: users.php");
                        }
                      
      
                      
                       ?>

        <?php 
                      
                            if (isset($_GET['delete_user'] ) ) {
                                
                                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'){
                                    
                                    $delete_user_id = mysqli_real_escape_string($conn, $_GET['delete_user']);

                                    $delete_user_query = "DELETE FROM users WHERE user_id = {$delete_user_id} ";

                                    $delete_user_query_result = mysqli_query($conn, $delete_user_query);

                                    confirm_query($delete_user_query_result, " DELETING USER");

                                    header("LOCATION: users.php");

                                    
                                    
                                }
                              
                    
                            }
                      
                      
                      ?>



    </tbody>

</table>