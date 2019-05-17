<?php 

$server = 'localhost';
$user = 'root';
$password = '';
$db = 'cms';

$conn = mysqli_connect($server, $user, $password, $db);


If (!$conn){
    
    die ("ERROR CONNECTING TO DATABASE" . mysqli_error($conn));
    
}
?>