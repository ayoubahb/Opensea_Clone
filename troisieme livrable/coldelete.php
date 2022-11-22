<?php
include 'connect.php';
if (isset($_GET['deleteid'])) {
  $id=$_GET['deleteid'];

  $sql="delete from `collections` where id=$id";

  $result=mysqli_query($con,$sql);
  if ($result) {
    header('location: own-col.php');
  }else{
    die(mysqli_error($con));
  }
}
?>