<?php
session_start();
$conn = new mysqli("localhost:3306", 'root','','tournament');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  if (!isset($_SESSION["userid"])) {
    header("Location: login.php", TRUE, 301);
    exit();
  }
  
$tour_name=$_POST['tname'];
$type=$_POST['type'];
$minteams=$_POST['minteams'];
$start_date=$_POST['startdate'];
$end_date=$_POST['enddate'];
$pperteam=$_POST['pperteam'];
$time=$_POST['time'];

//$sql1="SELECT tid FROM tourevents ORDER BY tid DESC LIMIT 1"; 
//$data1 = mysqli_query($conn,$sql1);
//  if(mysqli_num_rows($data1)==1){
//      $res=$data1 -> fetch_row();
//      $n=$res[0];
//      $tid=$n+1;
//}
//else{
//    $tid=1;
//}

$sql2="SELECT tname FROM tourevents WHERE tname='".$tour_name."' ";
$data2=  mysqli_query($conn,$sql2);
if(mysqli_num_rows($data2)==1){
    echo '<script type="text/javascript">'; 
    echo 'alert("Event already exits");'; 
    echo 'window.location.href = "createtournament.php";';
    echo '</script>'; 
}

//$sql3="SELECT start_date,end_date FROM tourevents WHERE start_date<='".$start_date."' AND end_date>='".$end_date."' ";
//$data3 = mysqli_query($conn,$sql3);
//if(mysqli_num_rows($data3)>=1){
//    echo '<script type="text/javascript">'; 
//    echo 'alert("Another Event exits in the same time");'; 
//    echo 'window.location.href = "createtournament.php";';
//    echo '</script>'; 
//}
else{
$sql = "INSERT INTO tourevents(tname,type,start_date,end_date,minteams,pperteam,time)
VALUES ('$tour_name','$type','$start_date','$end_date','$minteams','$pperteam','$time')";
$data = mysqli_query($conn,$sql);
if ($data) {	
echo '<script type="text/javascript">'; 
echo 'alert("Event Added Sucessfully");'; 
echo 'window.location.href = "info.php";';
echo '</script>';  
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}

$conn->close();
?>