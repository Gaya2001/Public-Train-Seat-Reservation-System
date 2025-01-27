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
  <link rel="stylesheet" href="AdminDashboard_Users.css">

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

  <div class="Add_Users">
    <label class="cc1">Train Users </label>
    <button class="ADD_NEW_USERS" onclick="openPopupForm()">ADD NEW USERS</button>
  </div>
  <?php
  include 'connect.php';
  if(isset($_POST['Submit'])){
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $mobile_number=$_POST['mobile_number'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $nic_number=$_POST['nic_number'];
    
    $sql = "INSERT INTO `local_user` (`first_name`, `last_name`, `mobile_number`,  `email`,`password`,`nic_number`)
    VALUES ('$first_name', '$last_name', '$mobile_number', '$email', '$password','$nic_number')";
    $result = mysqli_query($con, $sql);

    if($result){
      //echo"Data insert successfully";
      header('location:AdminDashboard_Users.php');
    }else{
      die(mysqli_error($con));
    }
  }
  ?>
  <div class="popup-overlay" id="popup">
    <div class="popup-form">
      <h2>ADD NEW USERS</h2>
      <form method="post">
        <div class="form-field">
          <label for="Class">First_Name:</label>
          <input type="text" id="Class" name="first_name" required>
        </div>
        <div class="form-field">
          <label for="Name">Last_Name:</label>
          <input type="text" id="Name" name="last_name" required>
        </div>
        <div class="form-field">
          <label for="mobile_number">Mobile_Number:</label>
          <input type="text" id="Email" name="mobile_number" required>
        </div>
        <div class="form-field">
          <label for="Contact_number">Email:</label>
          <input type="email" id="Contact_number" name="email" required>
        </div>
        <div class="form-field">
          <label for="Passport_No">Password:</label>
          <input type="text" id="Passport_No" name="password" required>
        </div>
        <div class="form-field">
          <label for="nic_number">NIC:</label>
          <input type="text" id="nic_number" name="nic_number">
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
    include 'connect.php';
    if (isset($_POST['Update'])) {
    $id = $_POST['User_ID'];
    $first_name = $_POST['first_name1'];
    $last_name = $_POST['last_name1'];
    $mobile_number = $_POST['mobile_number1'];
    $email = $_POST['email1'];
    $password = $_POST['password1'];
    $nic_number = $_POST['nic_number1'];
    

    
    $sql2 = "UPDATE `local_user` SET 
    `first_name` = '$first_name', 
    `last_name` = ' $last_name ', 
    `mobile_number` = '$mobile_number',
    `email`= '$email', 
    `password` = '$password',
    `nic_number` = '$nic_number'
    WHERE `Local_ID` = $id";

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
        <th>Local_ID</th>
        <th>First_name</th>
        <th>Last_name</th>
        <th>Mobile_Number</th>
        <th>Email</th>
        <th>Password</th>
        <th>NIC</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
         <?php
      $sql1 = "SELECT * FROM `local_user`";
      $result1 = mysqli_query($con, $sql1);
      if ($result1) {
        while ($row = mysqli_fetch_assoc($result1)) {
          $id = $row['Local_ID'];
          $first_name = $row['first_name'];
          $last_name = $row['last_name'];
          $mobile_number = $row['mobile_number'];
          $email = $row['email'];
          $password = $row['password'];
          $nic_number = $row['nic_number'];
         
          echo ' <tr>
          <td>' . $id . '</td>
          <td>' .  $first_name . '</td>
          <td>' .  $last_name . '</td>
          <td>' . $mobile_number . '</td>
          <td>' .  $email . '</td>
          <td>' .  $password. '</td>
          <td>' .  $nic_number. '</td>
          <td>
            <button class="EDIT" onclick="openPopupForm1' . $id . '()">EDIT</button>

            <div class="popup-overlay1" id="popup1' . $id . '">
              <div class="popup-form">
                <h2>EDIT USERS</h2>
                <form method="post">
                  <input type="hidden" name="User_ID" value="' . $id . '">
                  <div class="form-field">
                    <label for="Class">First Name:</label>
                    <input type="text" id="Class" name="first_name1" value="' . $first_name . '">
                  </div>
                  <div class="form-field">
                    <label for="Name">Last Name:</label>
                    <input type="text" id="Name" name="last_name1" value="' .  $last_name . '">
                  </div>
                  <div class="form-field">
                    <label for="Email">Email:</label>
                    <input type="text" id="Email" name="mobile_number1" value="' .  $mobile_number  . '">
                  </div>
                  <div class="form-field">
                    <label for="Contact_number">Email:</label>
                    <input type="email" id="Contact_number" name="email1" value="' .  $email . '">
                  </div>
                  <div class="form-field">
                    <label for="Passport_No">Password:</label>
                    <input type="text" id="Passport_No" name="password1" value="' . $password . '">
                  </div> <div class="form-field">
                    <label for="nic_number">NIC:</label>
                    <input type="text" id="nic_number" name="nic_number1" value="' . $nic_number . '">
                  </div>
                  <button class="submit-button" name="Update" type="submit">Update</button>
                </form>
                <button class="close-button" onclick="closePopupForm1' . $id . '()">&times;</button>
              </div>
            </div>
            <button class="DELETE"><a href="delete6.php? deleted='.$id.'">DELETE</a></button>
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