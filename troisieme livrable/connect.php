<?php 

$con=new mysqli('localhost','root','','Opensea');

if (!$con) {
  die(mysqli_error($con));
}
?>