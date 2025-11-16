<?php 
include "connection.php";
if(isset($_GET['deletenbr'])){
    $id = $_GET['deletenbr'];
    $sql = "DELETE from users WHERE Identity='$id'";
    $query = mysqli_query($conn,$sql);

    if($query == true){
        echo "<script>window.location.href='selectuser.php';</script>";
    }else{
       echo "You are not allowed to delete this user!";
    }
}
?>