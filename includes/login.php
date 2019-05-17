<?php 

 include "..\connection.php";

?>


<?php 


if (isset($_POST['login'])){
    
  $username = $_POST['username'];

  $password = $_POST['password'];
    
    
    if (!empty($username) && !empty($password)){
        
        
    $username = mysqli_real_escape_string($conn, $username);
    
    $password = mysqli_real_escape_string($conn, $password);
   
    
    $query = "SELECT * FROM users WHERE user_name = '{$username}'";
    $query_result = mysqli_query($conn, $query);
    
    if (!$query_result){
        
        die ("QUERY FAILED ". mysqli_error($conn));
        
    } else {
        
        while ($row = mysqli_fetch_assoc($query_result)){
            
            $db_id = $row['user_id'];
            $db_user_name = $row['user_name'];
            $db_first_name = $row['first_name'];
            $db_last_name = $row['last_name'];
            $db_user_role = $row['user_role'];
            $db_user_password = $row['user_password'];
            
        }
        
        if (password_verify($password, $db_user_password ) && $username === $db_user_name){
            
             session_start();
            
            $_SESSION['username'] = $db_user_name;
            $_SESSION['firstname'] = $db_first_name;
            $_SESSION['lastname'] = $db_last_name;
            $_SESSION['user_role'] = $db_user_role;
   
            
            header ("Location: ../admin");
            
        } else {
            
             header ("Location: ../index.php?wrong_password=true");
            
        }
    }
        
        
    } else {
        
        
        header ("Location: ../index.php?empty_words=true");
        
        
    }
    
    
   
}

?>