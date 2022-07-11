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
​<img src="tour.png" width="100px" height="80px"><br>

<input type="button" value="Logout" onclick="window.location='logout.php';">
</header>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Participant Access</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="upcomingtour.php">Upcoming Tournaments</a></li>
      <li class="active"><a href="profile.php">Profile</a></li>
      <li><a href="yourtour.php">Modify</a></li>
    </ul>
  </div>
</nav>
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
