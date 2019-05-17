<?php
function username_Exists ($username = '', $email = ''){
    global $conn;
    
    $queryOne = "SELECT user_name FROM users WHERE user_name = '{$username}'";
    $queryTwo = "SELECT user_email FROM users WHERE user_email = '{$email}'";
    $resultsTwo = mysqli_query($conn, $queryTwo);
    $resultsOne = mysqli_query($conn, $queryOne);
    
    if(mysqli_num_rows($resultsOne) > 1 || mysqli_num_rows($resultsTwo) > 1){
        return false;
    } else {
        return true;
    }
    
}
?>