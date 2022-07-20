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

<?php
$tid=$_POST['tid'];
$teamid=$_POST['teamid'];
$sql="INSERT INTO tourteams (tid,teamid,disqualifyteam) VALUES('".$tid."','".$teamid."',0)";
$data=mysqli_query($conn,$sql);
if($data){
    echo "<script>alert('Team is registered for the tournament succesfully')</script>";
    echo "<script type='text/javascript'>window.location = 'upcomingtour.php';</script> ";
}

?>