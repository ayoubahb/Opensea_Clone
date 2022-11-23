<?php
include 'connect.php';
if (isset($_GET['deleteid'])) {
  $id=$_GET['deleteid'];
  
  $sql="select coll_id from nfts where id=$id";
  $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_assoc($result);
  
  $sql1="update collections set num_nfts=num_nfts-1 where id='".$row['coll_id']."'"; 
  $result1=mysqli_query($con,$sql1);

  $sql2="delete from nfts where id=$id";
  
  $result2=mysqli_query($con,$sql2);
  if ($result && $result1 && $result2) {
    header('location: own-nft.php');
  }else{
    die(mysqli_error($con));
  }
}
?>