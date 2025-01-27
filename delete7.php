<?php
include 'connect.php';
if(isset($_GET['deleteid'])){
    $ID=$_GET['deleteid'];
    $sql="DELETE FROM `sfeedback` WHERE ID=$ID";
    /*$sql = "DELETE FROM admin_schedulelist WHERE `Schedule ID` = $id";*/

    $result=mysqli_query($con,$sql);
    if($result){
        /*echo "Deleted successfully";*/
        header('location:SupportStaff_Feedback.php');
    }else{
        die(mysqli_error($con));
    }
}
?>