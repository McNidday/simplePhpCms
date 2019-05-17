<?php 

if (isset($_GET['edit_user'])){

        $edit_user_id = $_GET['edit_user'];
    
        $edit_user_query = "SELECT * FROM users WHERE user_id = {$edit_user_id} ";
    
        $edit_user_query_result = mysqli_query($conn, $edit_user_query);
    
    if ($edit_user_query_result) {
    
        while ($edit_user = mysqli_fetch_assoc($edit_user_query_result) ) {
    
           
            $username = $edit_user['user_name'];
            $user_password = $edit_user['user_password'];
            $first_name = $edit_user['first_name'];
            $last_name = $edit_user['last_name'];
            $user_email = $edit_user['user_email'];
            $user_role = $edit_user['user_role'];

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
        <input autocomplete="off" type="password" name="password" class="form-control" id="password" value="" placeholder="Update password">
    </div>

    <div class="form-group">
        <label class="input-group-text" for="user_role">Role Currently:
            <?php echo $user_role; ?></label><br>
        <select name="user_role" id="user_role">

            <option value="" selected disabled hidden>Commit..</option>
            <option value="admin">admin</option>
            <option value="subscriber">subscriber</option>


        </select>

    </div>



    <div class="form-group">

        <input class="btn btn-primary" type="submit" name="update_user" Value="Update User">

    </div>

</form>


<?php   }
        
    } else {
        
        die ("ERROR FETCHING UPDATE INFORMATION " . mysqli_error($conn));
        
    }

}

if(isset($_POST['update_user'] ) ) {
    
        $update_username = $_POST['username'];
    
        $update_first_name = $_POST['first_name'];
    
        $update_last_name = $_POST['last_name'];
    
        $update_email = $_POST['user_email'];
    
        $update_password = $_POST['password'];
    
        $update_user_role = $_POST['user_role'];
    
        
         if (empty($update_user_role)){
            
            $role = "SELECT user_role FROM users WHERE user_id = $edit_user_id";
            
            $role_result = mysqli_query($conn, $role);
            
            $row = mysqli_fetch_array($role_result);
            
            $update_user_role = $row['user_role'];
            
        }
    
    
       
        $update_password = password_hash($update_password, PASSWORD_BCRYPT, ["cost" => 12]);
    
        $update_query = "UPDATE users SET ";
    
        $update_query .= "user_name = '{$update_username}', ";
    
        $update_query .= "user_email = '{$update_email}', ";
    
        $update_query .= "last_name = '{$update_last_name}', ";
    
        $update_query .= "first_name = '{$update_first_name}', ";
    
        $update_query .= "user_role = '{$update_user_role}', ";
    
        $update_query .= "user_password = '{$update_password}' ";
    
        $update_query .= "WHERE user_id = '{$edit_user_id}' ";
    
        $update_post_result = mysqli_query($conn, $update_query);
    
    if(!$update_post_result) {
        
        die("ERROR UPDATING USER " . mysqli_error($conn));
        
    } else {
        
        echo "SUCCESSFULY UPDATED";
        
        header("Refresh:0");
        
    }
    
}

?>