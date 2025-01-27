<?php
include 'connect.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = $_POST["user_type"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $mobile_number = $_POST["mobile_number"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    }
    // Determine which ID to insert based on the user_type
    if ($user_type == "Local") {
        $nic_number = $_POST["nic_number"];

        $sql = "INSERT INTO `local_user`(first_name, last_name, mobile_number, email, password, nic_number ) 
        VALUES ('$first_name', '$last_name', '$mobile_number', '$email', '$password', '$nic_number' )";


        header('location:Login_Page.html');
    } 
    
    elseif ($user_type == "Tourist") {
        $passport_number = $_POST["passport_number"];

        $sql = "INSERT INTO `tourist_user` (first_name, last_name, mobile_number, email, password,passport_number) 
        VALUES ('$first_name', '$last_name', '$mobile_number', '$email', '$password','$passport_number')";

        header('location:Login_Page.html');
    }

    // Insert data into the database
    // $sql = "INSERT INTO local_user (first_name, last_name, mobile_number, email, password, nic_number, ) 
    //         VALUES ('$user_type', '$first_name', '$last_name', '$mobile_number', '$email', '$password', '$nic_number', )";

    // $sql = "INSERT INTO tourist_user (first_name, last_name, mobile_number, email, password,  passport_number) 
    //    VALUES ('$user_type', '$first_name', '$last_name', '$mobile_number', '$email', '$password','$passport_number')";

    if ($con->query($sql) === TRUE) {
        echo "User registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

?>