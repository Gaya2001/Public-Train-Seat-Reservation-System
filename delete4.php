<?php
include 'connect.php';
if(isset($_GET['deleted'])){
    $id=$_GET['deleted'];
    $sql="DELETE FROM `admindashboard_routes` WHERE `Route ID`=$id";
    /*$sql = "DELETE FROM admin_schedulelist WHERE `Schedule ID` = $id";*/

    $result=mysqli_query($con,$sql);
    if($result){
        /*echo "Deleted successfully";*/
        header('location:AdminDashboard_Routes.php');
    }else{
        die(mysqli_error($con));
    }
}
?>