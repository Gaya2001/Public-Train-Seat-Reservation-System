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
    <link rel="stylesheet" href="SupportStaff_Feedback.css">

    <!-- ========================Icon Link======================= -->

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- ===============Google Font Link=================== -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Francois+One&display=swap" rel="stylesheet">

</head>

<body>

    <div class="NAME">
        <div class="Administrator">Administrator Dashboard </div>
    </div>


    <!-- ============== Side navigation Bar============= -->


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
            <li class="Users"><a href="#"><i class=""></i>USERS</a></li>
            <li class="News"><a href="SupportStaff_News.php"><i class=""></i>NEWS</a></li>
            <li class="Logout"><a href="Logout.php"><i class=""></i>LOG OUT</a></li>

        </ul>
    </div>

    <div class="Feedbacks">
        <P>All Feedbacks</P>
    </div>

    <div class="Container">
        <table class="">
            <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Phone Number</th>
              <th>Inquire Email</th>
              <th>Subject</th>
              <th>Message</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include 'connect.php';
            $sql = "select * from `sfeedback`";
            $result = mysqli_query($con, $sql);
            
            if ($result) {
                while($row=mysqli_fetch_assoc($result)){
                    $ID=$row['ID'];
                    $name=$row['name'];
                    $phone=$row['phone'];
                    $email=$row['email'];
                    $Subject=$row['Subject'];
                    $Message=$row['Message'];

                    echo ' <tr>
                    <td>' . $ID . '</td>
                    <td>' . $name . '</td>
                    <td>' . $phone . '</td>
                    <td>' . $email . '</td>
                    <td>' . $Subject . '</td>
                    <td>' . $Message . '</td>
                    <td>
                    <button class="EDIT"><a href="update.php?updateID=' . $ID . '">Edit</a></button>
                    <button class="DELETE"><a href="delete7.php?deleteid=' . $ID . '">Delete</a></button>
                    </td>
            
                    </tr>';

                   
                }
            }
               
            ?>
            </tbody>
        </table>


</body>

</html>