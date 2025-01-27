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
    <link rel="stylesheet" href="AdminDashboard_ReservationList.css">

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
        <li class="Home"><a href="AdminDashboard_Home.html"><i class=""></i>HOME</a></li>
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

    <div class="Add_Train">
        <p>RESERVATION LIST </p>
    </div>
    <button class="ADD_NEW_TRAIN" onclick="openPopupForm()">ADD NEW RESERVATION</button>
    <?php
  include 'connect.php';
  if(isset($_POST['Submit'])){
    $r_no=$_POST['r_no'];
    $p_name=$_POST['p_name'];
    $r_route=$_POST['r_route'];
    $r_class=$_POST['r_class'];
    $rn_seats=$_POST['rn_seats'];
    
    $sql = "INSERT INTO `admindashboard_reservationlist` (`train_id`, `Passenger Name`, `Route ID`, `Class`, `No. Seats`)
    VALUES ('$r_no', '$p_name', '$r_route', '$r_class', '$rn_seats')";
    $result = mysqli_query($con, $sql);

    if($result){
      //echo"Data insert successfully";
      header('location:AdminDashboard_reservationList.php');
    }else{
      die(mysqli_error($con));
    }
  }
  ?>
    <!-- ===================== Add New User-Pop Up Box ============== -->

    <div class=" popup-overlay" id="popup">
                        <div class="popup-form">
                            <h2>ADD NEW RESERVATION</h2>
                            <form action="" method="post">
                                <div class="form-field">
                                    <label for="route_id">Train No:</label>
                                    <input type="text" id="route_id" name="r_no" required>
                                </div>
                                <div class="form-field">
                                    <label for="departure_time">Passenger Name:</label>
                                    <input type="text" id="departure_time" name="p_name" required>
                                </div>
                                <div class="form-field">
                                    <label for="arrival_time">Route:</label>
                                    <input type="text" id="arrival_time" name="r_route" required>
                                </div>
                                <div class="form-field">
                                    <label for="fc_fee">Class:</label>
                                    <input type="text" id="fc_fee" name="r_class" required>
                                </div>
                                <div class="form-field">
                                    <label for="sc_fee">No. Seats:</label>
                                    <input type="text" id="sc_fee" name="rn_seats" required>
                                </div>

                                <button class="submit-button" type="submit" name="Submit">Submit</button>
                            </form>
                            <button class="close-button" onclick="closePopupForm()">&times;</button>
                        </div>
    </div>

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
    if (isset($_POST['Update'])) {
    $id = $_POST['schedule_id'];
    $r_no = $_POST['r_no1'];
    $p_name = $_POST['p_name1'];
    $r_route = $_POST['r_route1'];
    $r_class = $_POST['r_class1'];
    $rn_seats = $_POST['rn_seats1'];

    // Your SQL query to update the record
    $sql2 = "UPDATE `admindashboard_reservationlist` SET  
    `train_id` = '$r_no', 
    `Passenger Name` = '$p_name',
    `Route ID` = '$r_route', 
    `Class` = '$r_class',
    `No. Seats` = '$rn_seats'
    WHERE `reservation_id` = $id";

    $result = mysqli_query($con, $sql2);

    if ($result){
        // You can optionally redirect the user to another page after successful update
        //header('location:AdminDashboard_reservationList.php');
    } else {
        die(mysqli_error($con));
    }
}
?>
    <div class="Container">

    <table class="">
    <thead>
            <tr>
                <th>Reservation ID</th>
                <th>Train No.</th>
                <th>Passenger Name</th>
                <th>Route</th>
                <th>Class</th>
                <th>No. Seats</th>
                <th>Action</th>
            </tr>
    </thead>
    <tbody>
    <?php
      $sql1 = "SELECT * FROM `admindashboard_reservationlist`";
      $result1 = mysqli_query($con, $sql1);
      if ($result1) {
        while ($row = mysqli_fetch_assoc($result1)) {
          $id = $row['reservation_id'];
          $r_no = $row['train_id'];
          $p_name = $row['Passenger Name'];
          $r_route = $row['Route ID'];
          $r_class = $row['Class'];
          $rn_seats = $row['No. Seats'];

          echo ' <tr>
          <td>' . $id . '</td>
          <td>' . $r_no . '</td>
          <td>' . $p_name . '</td>
          <td>' . $r_route . '</td>
          <td>' . $r_class . '</td>
          <td>' . $rn_seats . '</td>
          <td>
          <button class="EDIT" onclick="openPopupForm1' . $id . '()">EDIT</button>

          <div class="popup-overlay1" id="popup1' . $id . '">
            <div class="popup-form">
              <h2>EDIT RESERVATION</h2>
              <form method="post">
                <input type="hidden" name="schedule_id" value="' . $id . '">
                <div class="form-field">
                  <label for="train_id">Train No:</label>
                  <input type="text" id="train_id" name="r_no1" value="' . $r_no . '">
                </div>
                <div class="form-field">
                  <label for="route_id">Passenger Name:</label>
                  <input type="text" id="route_id" name="p_name1" value="' . $p_name . '">
                </div>
                <div class="form-field">
                  <label for="departure_time">Route:</label>
                  <input type="text" id="departure_time" name="r_route1" value="' . $r_route . '">
                </div>
                <div class="form-field">
                  <label for="arrival_time">Class:</label>
                  <input type="text" id="arrival_time" name="r_class1" value="' . $r_class . '">
                </div>
                <div class="form-field">
                  <label for="fc_fee">No. Seats:</label>
                  <input type="text" id="fc_fee" name="rn_seats1" value="' . $rn_seats . '">
                </div>
                <button class="submit-button" name="Update" type="submit">Update</button>
              </form>
              <button class="close-button" onclick="closePopupForm1' . $id . '()">&times;</button>
            </div>
          </div>
          <button class="DELETE"><a href="delete3.php? deleted='.$id.'">DELETE</a></button>
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
            <!--<tr>
                <td>01</td>
                <td>Ruhunu kumari</td>
                <td>Kavindu Gayashan</td>
                <td>Galle to matara</td>
                <td>First class</td>
                <td>02</td>
                <td><button class="EDIT" onclick="Open_EDIT_PopupForm" ">EDIT</button>
                    <button class=" DELETE" onclick="" ">DELETE</button>
                </td>
            </tr>-->









        </table>


    </div>

    <!-- =====================UPDATE-Pop Up Box ============== -->

    <!-- ========================script============================ -->

</body>

</html>