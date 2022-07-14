<?php
session_start();
$conn = new mysqli("localhost:3306", 'root','','tournament');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  if (!isset($_SESSION["userid"])) {
    header("Location: admin.php", TRUE, 301);
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<header>
​<img src="tour.png" width="100px" height="80px">


<h3 class="liketext">Once you get to the tournament, it's like, win or go home.</h3>

</header>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Admin Access</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="createtournament.php">Create Tournament</a></li>
      <li><a href="info.php">Info</a></li>
      <li><a href="reporttour.php">Reports</a></li>
	  <li><a href="resulttour.php">Results</a></li>
    </ul>
  </div>
</nav>
<!-- <div class="container">-->  
<div>
  <h3>The Admin has access to the following tasks</h3>
  <ul>
      <li class="active">Create Tournament</li>
      <li>Tournament Info</li>
      <li>Modify Tournament</li>
      <li>Edit Tournament</li>
      <li>Check Reports of the tournament like the no of teams participating and the no of persons per team</li>
	  <li>Check the Results of all the tournaments </li>
    <li>Cancel a team and a tournament</li>
    </ul>
</div>
​
</body>
</html>
​
