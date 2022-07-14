<?php 
session_start();
$conn = new mysqli("localhost:3306", 'root','','tournament');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  if (!isset($_SESSION["user"])) {
    header("Location: login.php", TRUE, 301);
    exit();
  }
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Player Info</title>
  <h3 class="liketext">Push Yourselves to compete with others</h3>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">-->
</head>
<body>

<?php
$s=$_SESSION['user'];
$sql="SELECT * FROM participants WHERE pid='".$s."' ";

$data = mysqli_query($conn,$sql);
$res=$data -> fetch_row();
$name=$res[1];
$age=$res[3];
$email=$res[4];
$address=$res[6];
$bloodgrp=$res[7];
?>


<header>

</header>
<div style="padding-top:20px;">
<nav class="navbar navbar-default" >
  <div class="container-fluid">
    <div class="navbar-header">
    <img src="tour.png" width="150px" height="50px">
    </div>
    <ul class="nav navbar-nav">
      <li style="padding-left:20px;"><a href="yourtour.php">Home Page</a></li>
      <li><a href="upcomingtour.php">Upcoming Tournaments</a></li>
      <li class="active"><a href="profile.php">Profile</a></li>
    </ul>
    <input type="button" value="Logout" style="float:right;width: 100px;margin-top:10px;margin-bottom:10px;background-color:red;border-radius:5px;border:None;color:white;" onclick="window.location='logout3.php';"></h1>
  </div>
</nav>
</div>


<div class="container">
  <div class="card" style="width:400px;">
    <div class="card-body">
      <h4 class="card-title">Name        : <?php echo $name;?></h4>
      <h4 class="card-text">Age          : <?php echo $age;?></h4>
      <h4 class="card-text">Email        : <?php echo $email;?></h4>
      <h4 class="card-text">Address      : <?php echo $address;?></h4>
      <h4 class="card-text">Blood Group  : <?php echo $bloodgrp;?></h4>
    </div>
  </div>

</body>
</html>
