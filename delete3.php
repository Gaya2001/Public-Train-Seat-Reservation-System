<?php
include 'connect.php';
if(isset($_GET['deleted'])){
    $id=$_GET['deleted'];
    $sql="DELETE FROM `admindashboard_reservationlist` WHERE `reservation_id`=$id";
    /*$sql = "DELETE FROM admin_schedulelist WHERE `Schedule ID` = $id";*/

    $result=mysqli_query($con,$sql);
    if($result){
        /*echo "Deleted successfully";*/
        header('location:AdminDashboard_reservationList.php');
    }else{
        die(mysqli_error($con));
    }
}
?>