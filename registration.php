<?php  include "connection.php"; ?>
<?php  include "includes/header.php"; ?>
<?php include "includes/functions.php"; ?>


<?php 
    
    $VALUE = null;

    if (isset($_POST['submit'])){
        
        
        
        if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])){
            
                $username = trim(mysqli_real_escape_string ($conn, $_POST['username']));
                $email = trim(strtolower(mysqli_real_escape_string ($conn, $_POST['email'])));
            if(username_Exists($username, $email)){
                
                
                $password = mysqli_real_escape_string ($conn, $_POST['password']);

            
                $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);
            


                    $new_query = "INSERT INTO users (user_name, user_email, user_password, user_role) ";

                    $new_query .= "VALUES ('{$username}', '{$email}', '{$password}', 'subscriber' ) ";

                    $register_user_query = mysqli_query($conn, $new_query);


                if (!$register_user_query){

                    die ("ERROR PARSING INFO " . mysqli_error($conn));

                    } else {
                    
                    
                        $VALUE = "<div class='alert alert-success'>You have been successfuly registered  <a href='index.php'>Head home</a></div>";
                    
                     }
               
            } else {
                
                $VALUE =  "<div class='alert alert-danger'>Username/Email already exists! You maybe having a twin from another dimention</div>";
            }
                
        } else {
            
            $VALUE =  "<div class='alert alert-danger'>Seriously!! You Think I Process Empty Data</div>";
            
        }
        
        
    }



?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    
                  <?php echo $VALUE; ?>
                    
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 <?php include "includes/footer.php";?>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>




