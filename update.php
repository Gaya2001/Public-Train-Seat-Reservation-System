<?php
include 'connect.php';
$ID=$_GET['updateID'];
$sql = "select * from `sfeedback` where ID=$ID";

$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['name'];
$phone=$row['phone'];
$email=$row['email'];
$Subject=$row['Subject'];
$Message=$row['Message'];

if(isset($_POST['submit'])){
  $name=$_POST['name'];
  $phone=$_POST['phone'];
  $email=$_POST['email'];
  $Subject=$_POST['Subject'];
  $Message=$_POST['Message'];

  $sql = "update `sfeedback` SET ID='$ID', name='$name', phone='$phone', email='$email', Subject='$Subject', Message='$Message' WHERE ID='$ID'";
  $result = mysqli_query($con,$sql);
  if($result){
    echo "Updated successfully";
    //header('location:SupportStaff_Feedback.php');
  }
  else{
    die(mysqli_error($con));
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="contact.css" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register Page-Local</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Irish+Grover:400" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Francois+One:400" />
  <link rel="stylesheet" href="RegisterPage_Local.css" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    .mapouter {
      width: 100%;
      height: 130px; /* Same height as the navigation bar */
      margin-top: 0px; /* Place the map after the navigation bar */
    }

    .gmap_canvas {
      width: 100%;
      height: 100%;
    }
  </style>
</head>
<body>
  
  <div class="anu-Main">
  <div class="anu-Header">
    <h1 class="Logo">IMAGINE <span class="SEATS">SEATS</span></h1>
      <a class="anu-Home" href="http://localhost/online%20train%20seat%20booking%20system/Home.html">Home</a>
      <a class="anu-AboutUs" href="http://localhost/online%20train%20seat%20booking%20system/Home.html">About Us</a>
      <a class="anu-Contact" href="contact.php">Contact</a>
     
    </div>
    <div class="mapouter">
      <div class="gmap_canvas">
        <iframe class="gmap_canvas" width="500" height="400" id="gmap_convas" src="https://maps.google.com/maps?q=sliit%20university%20matara&t=k&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
      </div>
    </div>
    <div class="anu-innerBackground">
      <div class="left-div">
        <ul class="listOfContacts">
          <li>Our Office</li>
          <li>Hands Global Holdings (Pvt) Ltd.</li>
          <li>No. 21/5, Pagoda Road</li>
          <li>Nugegoda.</li>
        </ul>
        <ul class="listOfContacts">
          <li>Phone : (+94)11 2444 021</li>
          <li>Hot line : (+94)11 2777 876</li>
          <li>Email : info@trainsl.lk</li>
          <li>Web site : trainsl.lk</li>
          <li>Skype : TrainLanka</li>
        </ul>
      </div>
      <div class="right-div">
        <form class="co" method="post">
          <h1>Contact Us..</h1>
          <br><br>
          Your name:
          <input type="text" name="name" placeholder="Enter your full name" required value=<?php echo $name;?>><br><br>
          Phone number:
          <input type="tel" id="phone" name="phone" placeholder="Enter phone number" value=<?php echo $phone;?>><br><br>
          E-mail:
          <input type="email" name="email" placeholder="123@abc.com"value=<?php echo $email;?>><br><br>
          Subject:
          <input name="Subject" rows="6" cols="25" value=<?php echo $Subject;?>><br><br>
          Message:
          <input name="Message" rows="8" cols="25" value=<?php echo $Message;?>><br><br><br>
  
        <button type="submit" style="margin-bottom: 20px; font-size: 20px;" name="submit">Update</button>
</form>
      </div>
    </div>
  </div>
  <script>
    // JavaScript code for phone number validation
    var phoneInput = document.getElementById("phone");

    phoneInput.addEventListener("input", function() {
      var phoneNumber = phoneInput.value.replace(/\D/g, '');
      if (phoneNumber.length === 10) {
        phoneInput.setCustomValidity('');
      } else {
        phoneInput.setCustomValidity('Please enter a 10-digit phone number.');
      }
    });
  </script>
</body>
</html>
