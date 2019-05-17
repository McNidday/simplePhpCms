<?php
    session_start();
if (isset($_COOKIE[session_name()])){
    
    setcookie(session_name(), '', time()-86400, '/');
    
}

session_unset();

session_destroy();

include('../includes/header.php');

?>

<h1>Logged out</h1>

<p class="lead">You've been logged out. See you next time!</p>
<p>Not done yet!..<a href="..">Head Back to site</a></p>
<?php
include('../includes/footer.php');
?>