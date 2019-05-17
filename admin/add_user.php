<?php 

    if (isset($_POST['add_user'])){
        
   
        $first_name =$_POST['first_name'];
        
        $last_name = $_POST['last_name'];
        
        $username = $_POST['username'];
        
        $user_email = $_POST['email'];
        
        $user_role = $_POST['role'];
        
        
        if (empty($user_role)){
            
            $user_role = 'subscriber';
            
        }
        
//        $post_image = $_FILES['post_image']['name'];
//        $post_image_temp = $_FILES['post_image']['tmp_name'];
        
        
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT, ["cost" => 12]);
        
//        $post_date = date('d-m-y');
        
//        move_uploaded_file($post_image_temp, "../images/$post_image");
        
        $query = "INSERT INTO users(user_id, user_name, user_password, first_name, last_name, user_role, user_email) ";
        $query .= "VALUES(NULL, '{$username}', '{$password}', '{$first_name}', '{$last_name}', '{$user_role}', '{$user_email}')";
        $query_result = mysqli_query($conn, $query);
        
        
            /*CONFIRM QUERY POR FAVOR*/
            
            confirm_query($query_result, " USER");
            
        
        
    }


?>


   

   <form action="" method="post" enctype="multipart/form-data">
   
   
     <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" class="form-control" id="first_name">
    </div>

     <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" class="form-control" id="last_name">
    </div>
    
    <div class="form-group">
        <label for="username">UserName</label>
        <input type="text" name="username" class="form-control" id="username">
    </div>
    
     <div class="form-group">
        <label for="username">Email</label>
        <input type="email" name="email" class="form-control" id="email">
    </div>
    
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password">
    </div>
    
      <div class="form-group">
        <label class="input-group-text" for="role">Role</label><br>
                <select name="role" id="role">

               
                <option value="" selected disabled hidden>Commit..</option>
                <option value="admin">admin</option>
                <option value="subscriber">subscriber</option>
                

               
                </select>

    
    
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
    </div>
    -->
    <!--<div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image" id="post_image">
    </div>-->
    
    <hr/>
    
   
    <div class="form-group">
        
        <input class="btn btn-primary" type="submit" name="add_user" Value="Add User">
        
    </div>
    
</form>