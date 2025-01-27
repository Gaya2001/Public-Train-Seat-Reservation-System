<?php

// Database connection settings
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'crudoperation';

// Create a database connection
$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to authenticate a user
function authenticateUser($email, $password, $connection) {

    session_start();

    // Escape user inputs to prevent SQL injection
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    // Check if the user is an admin
    $adminQuery = "SELECT * FROM admin  WHERE email='$email' AND Password='$password'";
    $adminResult = mysqli_query($connection, $adminQuery);

    if (mysqli_num_rows($adminResult) == 1) {
        // Redirect to the admin page
        $_SESSION['role'] = 'admin';
        header('Location: AdminDashboard_Home.php ');
        exit();
    }

 // Check if the user is an Support staff
 $supportQuery = "SELECT * FROM support_staff   WHERE email='$email' AND Password='$password'";
 $supportResult = mysqli_query($connection, $supportQuery);

 if (mysqli_num_rows($supportResult) == 1) {
     // Redirect to the Support staff page
     $_SESSION['role'] = 'support';
     header('Location: SupportStaff_Home.php ');
     exit();
 }


    // Check if the user is a local user
    $localUserQuery = "SELECT * FROM local_user WHERE email='$email' AND password='$password'";
    $localUserResult = mysqli_query($connection, $localUserQuery);

    if (mysqli_num_rows($localUserResult) == 1) {
        // Redirect to the local user page
        $_SESSION['role'] = 'local';
        header('Location: LocalProfile_RequestSeason.php');
        exit();
    }

    // Check if the user is a tourist user
    $touristUserQuery = "SELECT * FROM tourist_user WHERE email='$email' AND password='$password'";
    $touristUserResult = mysqli_query($connection, $touristUserQuery);

    if (mysqli_num_rows($touristUserResult) == 1) {
        // Redirect to the tourist user page
        $_SESSION['role'] = 'local';
        header('Location: LocalProfile_RequestSeason.php');
        exit();
    }

    // User not found or invalid credentials
    return "Invalid email or password";
}

// Check if the form is submitted
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $authResult = authenticateUser($email, $password, $connection);

    if ($authResult !== true) {
        // Authentication failed, display an error message
        header('Location: Login_Page2.html');
    }
} // echo '<script>alert("Invalid email or password");</script>';

mysqli_close($connection);
?>

