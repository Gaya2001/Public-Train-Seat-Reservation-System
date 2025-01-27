<!-- =========================admin sessions=============== -->

<?php
session_start();

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    if ($role === 'admin') {

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
    <link rel="stylesheet" href="AdminDashboard_Routes.css">

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
        <header class="SUPPORT_STAFF">ADMIN</header>
        <ul>
            <li class="Home"><a href="AdminDashboard_Home.php"><i class=""></i>HOME</a></li>
            <li class="Feedback"><a href="#"><i class=""></i>FEEDBACK</a></li>
            <li class="Route"><a href="AdminDashboard_Routes.php"><i class=""></i>ROUTE</a></li>
            <li class="Train_List"><a href="AdminDashboard_TrainList.php"><i class=""></i>TRAIN LIST</a></li>
            <li class="Schedule_List"><a href="Admin_ScheduleList.php"><i class=""></i>SCHEDULE LIST</a></li>
            <li class="Reservation_List"><a href="AdminDashboard_reservationList.php"><i class=""></i>RESERVATION LIST </a></li>
            <li class="USERS"><a href="AdminDashboard_Users.php"><i class=""></i>USERS</a></li>
            <li class="Logout"><a href="Logout.php"><i class=""></i>LOG OUT</a></li>

        </ul>
    </div>
    <!-- ======================Blue Bar========================= -->

    <div class="Add_route">
        <legend class="cc1">Route List </legend>
        <button class="ADD_NEW_ROUTE" onclick="openPopupForm()">ADD NEW ROUTE</button>
    </div>
    <?php
  include 'connect.php';
  if(isset($_POST['submit'])){
    $from_id=$_POST['from'];
    $to_id=$_POST['to'];
    
    $sql = "INSERT INTO `admindashboard_routes`(`From`,`To`)
    VALUES ('$from_id','$to_id')";
    $result = mysqli_query($con, $sql);

    if($result){
      //echo"Data insert successfully";
      header('location:AdminDashboard_Routes.php');
    }else{
      die(mysqli_error($con));
    }
  }
  ?>
    <div class="popup-overlay" id="popup">
        <div class="popup-form">
            <h2>ADD NEW ROUTE</h2>
            <form method="post">
                <div class="form-field">
                    <label for="train_id">From:</label>
                    <input type="text" id="train_id" name="from">
                </div>
                <div class="form-field">
                    <label for="route_id">To:</label>
                    <input type="text" id="route_id" name="to">
                </div>
                <button class="submit-button" name="submit" type="submit">Submit</button>
            </form>
            <button class="close-button" onclick="closePopupForm()">&times;</button>
        </div>
    </div>
    <!-- ========================script============================ -->
    <script>
        function openPopupForm() {
            document.getElementById("popup").style.display = "block";
        }

        function closePopupForm() {
            document.getElementById("popup").style.display = "none";
        }
    </script>
    <!-- ========================Table============================ -->
    <?php
// Include your database connection code here (e.g., $con = mysqli_connect(...);)

if (isset($_POST['Update'])) {
    $id = $_POST['schedule_id'];
    $from_id = $_POST['from1'];
    $to_id = $_POST['to1'];

    // Your SQL query to update the record
    $sql2 = "UPDATE `admindashboard_routes` SET 
    `From` = '$from_id',
    `To` = '$to_id'
    WHERE `Route ID` = $id";

    $result = mysqli_query($con, $sql2);

    if ($result) {
        echo "Data updated successfully";
        // You can optionally redirect the user to another page after successful update
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
                <th>Routes ID</th>
                <th>From</th>
                <th>To</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
           $sql1 = "SELECT * FROM `admindashboard_routes`";
           $result1 = mysqli_query($con, $sql1);
           if ($result1) {
            while ($row = mysqli_fetch_assoc($result1)) {
                $id = $row['Route ID'];
                $from_id = $row['From'];
                $to_id = $row['To'];
                echo
                ' <tr>
                <td>' . $id . '</td>
                <td>' . $from_id .'</td>
                <td>' . $to_id . '</td>
                <td>
                <button class="EDIT" onclick="openPopupForm1' . $id . '()">EDIT</button>
                <div class="popup-overlay1" id="popup1' . $id . '">
                  <div class="popup-form">
                    <h2>EDIT SCHEDULE</h2>
                    <form method="post">
                      <input type="hidden" name="schedule_id" value="' . $id . '">
                      <div class="form-field">
                        <label for="train_id">Train Name:</label>
                        <input type="text" id="train_id" name="from1" value="' . $from_id . '" required>
                      </div>
                      <div class="form-field">
                        <label for="route_id">First Class Seats:</label>
                        <input type="text" id="route_id" name="to1" value="' . $to_id . '">
                      </div>
                      <button class="submit-button" name="Update" type="submit">Update</button>
                    </form>
                    <button class="close-button" onclick="closePopupForm1' . $id . '()">&times;</button>
                  </div>
                </div>
                <button class="DELETE"><a href="delete4.php? deleted='.$id.'">DELETE</a></button>
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
    </dive>
</body>

</html>