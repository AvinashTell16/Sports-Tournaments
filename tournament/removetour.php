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

<?php
$tid=$_POST['tid'];
$type=$_POST['type'];
if($type=='single'){
    //$sql="DELETE FROM tourevents where tid='".$tid."'";
    //$data=mysqli_query($conn,$sql);
    //$sql2="DELETE FROM tourparti WHERE tid='".$tid."'";
    //$data2=mysqli_query($conn,$sql2);
}
?>