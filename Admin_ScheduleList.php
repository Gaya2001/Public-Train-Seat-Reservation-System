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
  <link rel="stylesheet" href="Admin_ScheduleList.css">

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
    <li class="Logout"><a href="Logout"><i class=""></i>LOG OUT</a></li>

    </ul>
  </div>

  <!-- ======================Blue Bar========================= -->

  <div class="Add_Schedule">
    <label class="cc1">Schedule  List </label>
    <button class="ADD_NEW_Schedule" onclick="openPopupForm()">ADD NEW SCHEDULE</button>
  </div>
  <?php
  include 'connect.php';
  if(isset($_POST['Submit'])){
    $train_id=$_POST['train_id'];
    $route_id=$_POST['route_id'];
    $departure_time=$_POST['departure_time'];
    $arrival_time=$_POST['arrival_time'];
    $fc_fee=$_POST['fc_fee'];
    $sc_fee=$_POST['sc_fee'];
    $tc_fee=$_POST['tc_fee'];
    
    $sql = "INSERT INTO `admin_schedulelist` (`Train ID`, `Route ID`, `departure_time`, `Arrival Time`, `F.C Fee`, `S.C Fee`, `T.C Fee`)
    VALUES ('$train_id', '$route_id', '$departure_time', '$arrival_time', '$fc_fee', '$sc_fee', '$tc_fee')";
    $result = mysqli_query($con, $sql);

    if($result){
      //echo"Data insert successfully";
      header('location:Admin_ScheduleList.php');
    }else{
      die(mysqli_error($con));
    }
  }
  ?>
  <div class="popup-overlay" id="popup">
    <div class="popup-form">
      <h2>ADD NEW SCHEDULE</h2>
      <form method="post">
        <div class="form-field">
          <label for="train_id">Train ID:</label>
          <input type="text" id="train_id" name="train_id">
        </div>
        <div class="form-field">
          <label for="route_id">Route ID:</label>
          <input type="text" id="route_id" name="route_id">
        </div>
        <div class="form-field">
          <label for="departure_time">Departure Time:</label>
          <input type="text" id="departure_time" name="departure_time">
        </div>
        <div class="form-field">
          <label for="arrival_time">Arrival Time:</label>
          <input type="text" id="arrival_time" name="arrival_time">
        </div>
        <div class="form-field">
          <label for="fc_fee">F.C Fee:</label>
          <input type="text" id="fc_fee" name="fc_fee">
        </div>
        <div class="form-field">
          <label for="sc_fee">S.C Fee:</label>
          <input type="text" id="sc_fee" name="sc_fee">
        </div>
        <div class="form-field">
          <label for="tc_fee">T.C Fee:</label>
          <input type="text" id="tc_fee" name="tc_fee">
        </div>
        <button class="submit-button" name="Submit" type="submit">Submit</button>
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
    $train_id = $_POST['train_id1'];
    $route_id = $_POST['route_id1'];
    $departure_time = $_POST['departure_time1'];
    $arrival_time = $_POST['arrival_time1'];
    $fc_fee = $_POST['fc_fee1'];
    $sc_fee = $_POST['sc_fee1'];
    $tc_fee = $_POST['tc_fee1'];

    // Your SQL query to update the record
    $sql2 = "UPDATE `admin_schedulelist` SET 
    `Train ID` = '$train_id', 
    `Route ID` = '$route_id', 
    `departure_time` = '$departure_time',
    `Arrival Time` = '$arrival_time', 
    `F.C Fee` = '$fc_fee', 
    `S.C Fee` = '$sc_fee', 
    `T.C Fee` = '$tc_fee' 
    WHERE `Sehedule ID` = $id";

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
        <th>Schedule ID</th>
        <th>Train ID</th>
        <th>Route ID</th>
        <th>Departure Time</th>
        <th>Arrival Time</th>
        <th>F.C Fee</th>
        <th>S.C Fee</th>
        <th>T.C Fee</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql1 = "SELECT * FROM `admin_schedulelist`";
      $result1 = mysqli_query($con, $sql1);
      if ($result1) {
        while ($row = mysqli_fetch_assoc($result1)) {
          $id = $row['Sehedule ID'];
          $train_id = $row['Train ID'];
          $route_id = $row['Route ID'];
          $departure_time = $row['departure_time'];
          $arrival_time = $row['Arrival Time'];
          $fc_fee = $row['F.C Fee'];
          $sc_fee = $row['S.C Fee'];
          $tc_fee = $row['T.C Fee'];

          echo ' <tr>
          <td>' . $id . '</td>
          <td>' . $train_id . '</td>
          <td>' . $route_id . '</td>
          <td>' . $departure_time . '</td>
          <td>' . $arrival_time . '</td>
          <td>' . $fc_fee . '</td>
          <td>' . $sc_fee . '</td>
          <td>' . $tc_fee . '</td>
          <td>
            <button class="EDIT" onclick="openPopupForm1' . $id . '()">EDIT</button>

            <div class="popup-overlay1" id="popup1' . $id . '">
              <div class="popup-form">
                <h2>EDIT SCHEDULE</h2>
                <form method="post">
                  <input type="hidden" name="schedule_id" value="' . $id . '">
                  <div class="form-field">
                    <label for="train_id">Train ID:</label>
                    <input type="text" id="train_id" name="train_id1" value="' . $train_id . '">
                  </div>
                  <div class="form-field">
                    <label for="route_id">Route ID:</label>
                    <input type="text" id="route_id" name="route_id1" value="' . $route_id . '">
                  </div>
                  <div class="form-field">
                    <label for="departure_time">Departure Time:</label>
                    <input type="text" id="departure_time" name="departure_time1" value="' . $departure_time . '">
                  </div>
                  <div class="form-field">
                    <label for="arrival_time">Arrival Time:</label>
                    <input type="text" id="arrival_time" name="arrival_time1" value="' . $arrival_time . '">
                  </div>
                  <div class="form-field">
                    <label for="fc_fee">F.C Fee:</label>
                    <input type="text" id="fc_fee" name="fc_fee1" value="' . $fc_fee . '">
                  </div>
                  <div class="form-field">
                    <label for="sc_fee">S.C Fee:</label>
                    <input type="text" id="sc_fee" name="sc_fee1" value="' . $sc_fee . '">
                  </div>
                  <div class="form-field">
                    <label for="tc_fee">T.C Fee:</label>
                    <input type="text" id="tc_fee" name="tc_fee1" value="' . $tc_fee . '">
                  </div>
                  <button class="submit-button" name="Update" type="submit">Update</button>
                </form>
                <button class="close-button" onclick="closePopupForm1' . $id . '()">&times;</button>
              </div>
            </div>
            <button class="DELETE"><a href="delete2.php? deleted='.$id.'">DELETE</a></button>
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
</div>


<!-- JavaScript functions>
<script>
  function openPopupForm1() {
    document.getElementById("popup1").style.display = "block";
  }

  function closePopupForm1() {
    document.getElementById("popup1").style.display = "none";
  }
</script>
          <<button class="DELETE"><a href="delete.php? deleted='.$id.'">DELETE</a></button>
          </td>
          </tr>';
        }
      }

      ?>
      </tbody>
    </table>


  </div>-->


</body>

</html>