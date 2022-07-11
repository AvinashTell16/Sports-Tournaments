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
	<title>Create Tournament</title>
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

 <input type="button" value="Logout" style="float:right;width: 200px;" onclick="window.location='logout1.php';"></h1>
</header>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Admin Access</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="adminhome.php">Admin Home Page</a></li>
	  <li  class="active"><a href="createtournament.php">Create Tournament</a></li>
      <li><a href="info.php">Info</a></li>
      <li><a href="reporttour.php">Reports</a></li>
	  <li><a href="resulttour.php">Results</a></li>
    </ul>
  </div>
</nav>
               
<div class="col-12">
<div style="padding-left:2%;width:100%;border-style:solid; border-radius:10px;border-color:#0000ff">
  <center><h1>Add New Tournament</h1></center>                          

<form action="addtour.php" method="post">
Tournament name:
<input type="text" name="tname" required class="smalltext">
Type: <select name="type" required class="smalltext">
  <option value="single">single</option>
  <option value="team">team</option>

</select><br><br>
Minteams                                                                      
<input type="text" name="minteams" required class="bigtext"><br><br>
Participants per team                                                                      
<input type="text" name="pperteam" required class="bigtext"><br><br>
  Start Date:  
<input type="date" name="startdate" required class="smalltext">
  End Date:  
<input type="date" name="enddate" required class="smalltext"><br><br>
Event Time:  
<input type="time" name="time" required class="smalltext"><br><br>
<input type="submit" value="Submit">
</form>

</div>

</div>


</div>

</body>
</html>