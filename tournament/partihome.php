<?php 
session_start();
$conn = new mysqli("localhost:3306", 'root','','tournament');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  if (!isset($_SESSION["user"])) {
    header("Location: admin.php", TRUE, 301);
    exit();
  }
  
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-97824898-1', 'auto');
ga('send', 'pageview');
</script>
</head>
<body>
<header>
<img src="tour.png" width="100px" height="80px">

<a href ="index.html"> <input type="button" value="Logout" style="float:right;width: 200px;" onclick="window.location='logout.php';"></a></h1>
</header>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Participant Access</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="upcomingtour.php">Upcoming Tournaments</a></li>
      <li><a href="profile.php">Profile</a></li>
      <li><a href="yourtour.php">Modify</a></li>
    </ul>
  </div>
</nav>
<?php
echo $_SESSION['user'];
?>
</body>
</html>