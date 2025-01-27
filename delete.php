<?php
include 'connect.php';
if(isset($_GET['deleteid'])){
    $ID=$_GET['deleteid'];

    $sql="delete from `sfeedback` where ID=$ID";
    $result=mysqli_query($con,$sql);
    if($result){
        //echo "Deleted successfull";
        header('location:SupportStaff_Feedback.php');
    }
    else{
        die(mysqli_error($con));
    }
}
?>