<?php
session_start();
include "connect.php";
	if(isset($_POST['email']) && isset($_POST['password'])){
    
    $email = $_POST['email'];
    $psw = $_POST['password'];

    if(empty($email)){
      header("location: login_page.php?error=Email required");
      exit();
    }else if(empty($psw)){
      header("location: login_page.php?error=Password required");
      exit(); 
    }else{
      $sql="SELECT * FROM artist WHERE email = '$email' AND password = '$psw'";

      $result = mysqli_query($con,$sql);

      if(mysqli_num_rows($result)=== 1){
        $row = mysqli_fetch_assoc($result);
        if($row['email'] === $email && $row['password'] === $psw){
          $_SESSION['id']=$row['id'];
          $_SESSION['name']=$row['name'];
          $_SESSION['img']=$row['artist_img'];
          header("location: home.php");

        }else{
          header("location: login_page.php?error=incorrect email or password");
          exit();
        }
      }else{
          header("location: login_page.php?error=incorrect email or password");
          exit();
        }
    }
	}else{
		header("location: login_page.php?error");
    exit();
	}
?>