<?php
session_start();
//<!--Habiyaremye daniel 2220007495--->

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to index.php
header("Location: index.html");
exit();
?>
