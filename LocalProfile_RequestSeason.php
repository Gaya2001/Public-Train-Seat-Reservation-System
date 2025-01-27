<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local profile Request season</title>
    <link rel="stylesheet" href="LocalProfile_RequestSeason.css">
</head>
<body>
    <header >
        <img id="logo" src="../images/LOGO.png" alt="Imagine seats">
        <nav >
            <ul id="navigate">
               <a href="Home.html"> <li>Home</li></a>
               <a href="Home.html"> <li>Services</li></a>
               <a href="#"> <li>contact</li></a>
               <a href="Home.html"><li>About us</li></a>
            </ul>
            <a id="me_account" href="#"><button type="button" class="Btn">My Account</button></a>
        </nav>
    </header> 

    <div id="longrec">
        <hr id="hori_line">
        <h4><img id="use_acc" src="../images/user account.png" 
            alt="user account">Kavindu Gayashan</h4><br>
        <h4><a href="">Account Settings</a></h4><br>
        <h4><a href="">Bookings</a></h4><br>
        <h4><a href="">Season </a></h4><br>
        <h4><a href="">Log out</a></h4><br>
    </div>
         


    <div id="topic">
        <h2>User Dashboard</h2>
    </div>

    <div id="thinrec">
           <div><h3>Local season</h3></div>
           
           <div class="Add_Season">
            <label class="cc1">Season form </label>
            <button class="add_season_details" onclick="openPopupForm()">Request season</button>
          </div>

  <?php

  include 'connect.php';

  if(isset($_POST['submit'])){
    $user_name=$_POST['user_name'];
    $train_name=$_POST['train_name'];
    $departure=$_POST['Departure'];
    $arrival=$_POST['Arrival'];
    $train_class=$_POST['train_class'];
    
    $sql = "INSERT INTO `user_requests` (`user_name`,`train_name`,`train_class`,`Departure`,`Arrival`)
    VALUES ('$user_name', '$train_name', '$train_class','$departure', '$arrival')";

    $result = mysqli_query($con, $sql);

    
      if ($result) {
            // Data insert was successful
          echo '<script type="text/javascript">
            alert("Data inserted successfully");
            window.location = "LocalProfile_RequestSeason.php";
          </script>';
      } else {
          die(mysqli_error($con));
      }
    }
    ?>


          <div class="popup-overlay" id="popup">
            <div class="popup-form">
              <h2>Reserve a season pass</h2>
              <form method="POST">
                <div class="form-field">
                  <label for="user name">User Name:</label>
                  <input type="text" id="user name" name="user_name">
                </div>
                <div class="form-field">
                  <label for="train name">Train Name:</label>
                  <input type="text" id="train name" name="train_name">
                </div>
                <div class="form-field">
                  <label for="train class">Class:</label>
                  <input type="text" id="train class" name="train_class">
                </div>
                <div class="form-field">
                  <label for="arrival">Arrival:</label>
                  <input type="text" id="arrival" name="Arrival">
                </div>
                <div class="form-field">
                  <label for="departure">Departure:</label>
                  <input type="text" id="departure" name="Departure">
                </div>
                <button class="submit-button" type="submit" name="submit" >Submit</button>
              </form>
              <button class="close-button" onclick="closePopupForm()">&times;</button>
            </div>
          </div>
           
    </div>

    <div class="card">

        <h1>season status</h1>
        <h2>ACTIVE</h2><br>
        <span id="A" style="padding-left: 20px;"></span>From <input type="text">
        <span id="A" style="padding-left: 600px;"></span> TO <input type="text"><br>
        <div id="valid_till"></id><span style="padding-left: 792px;"></span> Valid Till <input type="text"><br></div>
        <div id="season_no"><span style="padding-left: 20px;">SEASON NO:628904</span><br></div>
    

    </div>

    <div id="thinrec_ash">
       <button id="big_button"><h3>Update season for the next month</h3></button>

       <script>
        function openPopupForm() {
          document.getElementById("popup").style.display = "block";
        }
      
        function closePopupForm() {
          document.getElementById("popup").style.display = "none";
        }
      </script>
    </div>

  </body>
</html>