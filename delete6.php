<?php
include 'connect.php';
if(isset($_GET['deleted'])){
    $id=$_GET['deleted']; 
    $sql="DELETE FROM `local_user` WHERE `Local_ID`=$id";
    /*$sql = "DELETE FROM admin_users WHERE `user ID` = $id";*/

    $result=mysqli_query($con,$sql);
    if($result){
        /*echo "Deleted successfully";*/
        header('location:AdminDashboard_Users.php');
    }else{
        die(mysqli_error($con));
    }
}
?>