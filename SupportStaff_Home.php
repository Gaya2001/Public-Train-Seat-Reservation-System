<!-- =========================support stuff sessions=============== -->

<?php
session_start();

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    if ($role === 'support') {

    } else {
        // Handle unauthorized access
        header('Location:Login_Page.html'); // Redirect to the login page if the role is not recognized
        exit();
    }
} else {
    // User is not logged in, redirect to the login page
    header('Location:Login_Page.html');
    exit();
}  

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="SupportStaff_Home.css">

    <!-- ========================Icon Link======================= -->

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- ===============Google Font Link=================== -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Francois+One&display=swap" rel="stylesheet">

</head>

<body>
    <!-- ============== Side navigation Bar============= -->

    <div class="NAME">
        <div class="Administrator">Administrator Dashboard </div>
    </div>

    <div class="sidebar">
        <header>
            <h2 class="LOGO_ADMIN"><span class="IMAGINE">IMAGINE</span> SEATS</h2>
        </header>
        <header class="DATE">WED 13, OCT 21</header>
        <header class="SUPPORT_STAFF">SUPPORT STAFF</header>
        <ul>
            <li class="Home"><a href="SupportStaff_Home.php"><i class=""></i>HOME</a></li>
            <li class="Feedback"><a href="SupportStaff_Feedback.php"><i class=""></i>FEEDBACK</a></li>
            <li class="Season_inquiry"><a href="SupportStaff_SeasonInquiry.php"><i class=""></i>SEASON INQUIRiES</a>
            </li>
            <li class="Users"><a href="SupportStaff_Users.php"><i class=""></i>USERS</a></li>
            <li class="News"><a href="SupportStaff_News.php"><i class=""></i>NEWS</a></li>
            <li class="Logout"><a href="Logout.php"><i class=""></i>LOG OUT</a></li>

        </ul>
    </div>
    <!-- ======================Blue Bar========================= -->
    <div class="Support">
        <p>HI,Support Administrator </p>
    </div>

    <div class="Passengers">
        <p>Passengers</p>
        <p>35</p>
        <hr>
    </div>

    <div class="Trains">
        <p>Trains</p>
        <p>5</p>
        <hr>
    </div>

    <div class="Received">
        <p>Feedback Received</p>
        <p>12</p>
        <hr>
    </div>

    <div class="Routes1">
        <p>Routes</p>
        <p>8</p>
        <hr>
    </div>

    <div class="Users1">
        <p>No.Users</p>
        <p>8</p>
        <hr>
    </div>




</body>

</html>