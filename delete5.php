<?php
include 'connect.php';
if(isset($_GET['deleted'])){
    $id=$_GET['deleted'];
    $sql="DELETE FROM `user_requests` WHERE `invoice_id`=$id";
    /*$sql = "DELETE FROM admin_schedulelist WHERE `Schedule ID` = $id";*/

    $result=mysqli_query($con,$sql);
    if($result){
        /*echo "Deleted successfully";*/
        header('location:SupportStaff_SeasonInquiry.php');
    }else{
        die(mysqli_error($con));
    }
}
?>