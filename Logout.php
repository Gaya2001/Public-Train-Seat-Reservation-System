<?php
// Start or resume the session
session_start();

// Destroy the session data
session_destroy();

// Redirect the user to the login page
header('Location: Login_Page.html');
exit();
?>
