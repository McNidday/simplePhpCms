<?php include "includes/header.php"; ?>

<?php include "functions.php"; ?>

<?php ob_start(); ?>
    
   
    <div id="wrapper">

    <?php include "includes/navigation.php";?>


        <div id="page-wrapper">

            <div class="container-fluid">



            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

               
                <h1 class="page-header">
                    
                    WELCOME TO ADMIN
                    
                    <small>Author</small>
 
                </h1>
               <?php 
                    
                    if (isset($_SESSION['username'])){
                        
                        $username = $_SESSION['username'];
                        
                        
                        $query = "SELECT * FROM users WHERE user_name = '{$username}'";
                        
                        $select_user_profile = mysqli_query($conn, $query);
                        
                        
                        
                        while($user_row = mysqli_fetch_array($select_user_profile)){
                            
                            
                                    $user_id = $user_row['user_id'];
                                    
                                    $username = $user_row['user_name'];
                                   
                                    $first_name = $user_row['first_name'];
                                    
                                    $last_name = $user_row['last_name'];
                                    
                                    $user_role = $user_row['user_role'];
                                    
                                    $user_email = $user_row['user_email'];
                            
                                    $password = $user_row['user_password'];
                                    
                            
                            
                        }
                        
                    }

        
   
    
            ?>

            <form action="" method="post" enctype="multipart/form-data">

        
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" id="first_name" value="<?php echo $first_name; ?>">
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" id="last_name" value="<?php echo $last_name; ?>">
            </div>
            
            <div class="form-group">
                <label for="user_email">Email</label>
                <input type="email" name="user_email" class="form-control" id="user_email" value="<?php echo $user_email; ?>">
            </div>
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="usernamee" value="<?php echo $username; ?>">
            </div>
            
             <div class="form-group">
                <label for="username">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            
            <div class="form-group">
                <label class="input-group-text" for="user_role">Role Currently: <?php echo $user_role; ?></label><br>
                <select name="user_role" id="user_role">

                <option value="" selected disabled hidden>Commit..</option>
                <option value="admin" >admin</option>
                <option value="subscriber" >subscriber</option>
                

                </select>

            </div>



            <!--<div class="form-group">
                <div class="input-group mb-3">

                    <div class="input-group-prepend">
                    <label class="input-group-text" for="post_status">Post Status</label>
                    </div>

                    <select class="custom-select" id="post_status" name="post_status">

                    <option selected>Choose...</option>
                    <option value="Draft">Draft</option>
                    <option value="Published">Published</option>
                    <option value="Do not care">Do not care</option>

                </select>

                </div>
            </div>-->




            <div class="form-group">

                <input class="btn btn-primary" type="submit" name="update_profile" Value="Update Profile">

            </div>

            </form>

            
     <?php 
        
    

if(isset($_POST['update_profile'] ) ) {
    
        $update_username = $_POST['username'];
        $update_first_name = $_POST['first_name'];
        $update_last_name = $_POST['last_name'];
        $update_email = $_POST['user_email'];
        $update_password = $_POST['password'];
        $update_user_role = $_POST['user_role'];
       
        
    
   
        $update_query = "UPDATE users SET ";
    
        $update_query .= "user_name = '{$update_username}', ";
    
        $update_query .= "user_email = '{$update_email}', ";
    
        $update_query .= "last_name = '{$update_last_name}', ";
    
        $update_query .= "first_name = '{$update_first_name}', ";
    
        $update_query .= "user_role = '{$update_user_role}', ";
    
        $update_query .= "user_password = '{$update_password}' ";
    
        $update_query .= "WHERE user_id = '{$user_id}' ";
    
        $update_post_result = mysqli_query($conn, $update_query);
    
    if(!$update_post_result) {
        
        die("ERROR UPDATING USER " . mysqli_error($conn));
        
    } else {
        
        echo "SUCCESSFULY UPDATED";
        
        header("Refresh:0");
        
    }
    
}

?>
                   
                </div>  
                   
                    <!--DELETE CATEGORIES-->

                    <?php delete_categories(); ?>


                </div>
                <!-- /.row -->

            <!-- /.container-fluid -->

            </div>


        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->

    <script src="js/jquery.js"></script>


    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="js/scripts.js"></script>
    </body>

    </html>
