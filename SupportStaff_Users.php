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
    <link rel="stylesheet" href="SupportStaff_Users.css">

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
            <li class="Users"><a href="SupportStaff_Users.php"><i class=""></i>USERS</a></li>
            <li class="News"><a href="SupportStaff_News.php"><i class=""></i>NEWS</a></li>
            <li class="Logout"><a href="Logout.php"><i class=""></i>LOG OUT</a></li>

        </ul>
    </div>

    <div class="SEASON_INQUIRiES">
        <P>TOURIST USERS </P>
    </div>
    <?php
// Include your database connection code here (e.g., $con = mysqli_connect(...);)
include 'connect.php';
if (isset($_POST['Update'])) {
    $id = $_POST['schedule_id'];
    $user_name = $_POST['user_name'];
    $train_name = $_POST['train_name'];
    $train_class = $_POST['train_class'];
    $Arrival = $_POST['Arrival'];
    $Departure = $_POST['Departure'];

    // Your SQL query to update the record
    $sql2 = "UPDATE `user_requests` SET 
    `user_name` = '$user_name', 
    `train_name` = '$train_name', 
    `train_class` = '$train_class',
    `Arrival` = '$Arrival', 
    `Departure` = '$Departure'
    WHERE `invoice_id` = $id";

    $result=mysqli_query($con,$sql2);

    if ($result) {
        echo "Data updated successfully";
        // You can optionally redirect the user to another page after successful updates
        // header('location:Admin_ScheduleList.php');
    } else {
        die(mysqli_error($con));
    }
}
?>




    <div class="Container">
        <table class="">
            <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Train name</th>
                <th>User Name</th>
                <th>Class seats</th>
                <th>Arrival</th>
                <th>Departure</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                
                $sql1 = "SELECT * FROM `user_requests`";
                $result1 = mysqli_query($con, $sql1);
                if ($result1) {
                    while ($row = mysqli_fetch_assoc($result1)) {
                        $id = $row['invoice_id'];
                        $train_name = $row['train_name'];
                        $user_name = $row['user_name'];
                        $train_class = $row['train_class'];
                        $Arrival = $row['Arrival'];
                        $Departure = $row['Departure'];

                         echo ' <tr>
                        <td>' . $id . '</td>
                        <td>' . $user_name . '</td>
                        <td>' . $train_name . '</td>
                        <td>' . $train_class . '</td>
                        <td>' . $Arrival . '</td>
                        <td>' . $Departure . '</td>
                        <td>
                        <button class="EDIT" onclick="openPopupForm1' . $id . '()">EDIT</button>

            <div class="popup-overlay" id="popup1' . $id . '">
              <div class="popup-form">
                <h2>EDIT SCHEDULE</h2>
                <form method="post">
                  <input type="hidden" name="schedule_id" value="' . $id . '">
                  <div class="form-field">
                    <label for="train_id">User Name:</label>
                    <input type="text" id="train_id" name="user_name" value="' . $user_name . '">
                  </div>
                  <div class="form-field">
                    <label for="route_id">Train name:</label>
                    <input type="text" id="route_id" name="train_name" value="' . $train_name . '">
                  </div>
                  <div class="form-field">
                    <label for="departure_time">Class seats:</label>
                    <input type="text" id="departure_time" name="train_class" value="' . $train_class . '">
                  </div>
                  <div class="form-field">
                    <label for="arrival_time">Arrival:</label>
                    <input type="text" id="arrival_time" name="Arrival" value="' . $Arrival . '">
                  </div>
                  <div class="form-field">
                    <label for="fc_fee">Departure:</label>
                    <input type="text" id="fc_fee" name="Departure" value="' . $Departure . '">
                  </div>
                  <button class="submit-button" name="Update" type="submit">Update</button>
                </form>
                <button class="close-button" onclick="closePopupForm1' . $id . '()">&times;</button>
              </div>
            </div>
            <button class="DELETE"><a href="delete5.php? deleted='.$id.'">DELETE</a></button>
          </td>
        </tr>';

          echo '
          <script>
            function openPopupForm1' . $id . '() {
              document.getElementById("popup1' . $id . '").style.display = "block";
            }

            function closePopupForm1' . $id . '() {
              document.getElementById("popup1' . $id . '").style.display = "none";
            }
          </script>';
                    }
                }
                ?>
            </tbody>
        </table>


</body>

</html>