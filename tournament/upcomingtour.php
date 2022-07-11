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
  <title>Upcoming Tournaments</title>
  ​<img src="tour.png" width="100px" height="80px">
<h3 class="liketext">Push Yourselves to compete with others</h3>
<input type="button" value="Logout" onclick="window.location='logout.php';" >
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">-->
<!--Popup form-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="form.css" >
        <script src="form.js"></script>
<!--Popup Form-->

<!--card style css-->
<style>
.card1 {
float: left;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  /*background: linear-gradient(45deg, red, orange, yellow, green, blue, indigo, violet, red);*/
  transition: 0.3s;
  width: 35%;
  padding: 0 10px;
  margin-right: 200px;
  margin-bottom: 50px;
}

.card1:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container1 {
  padding: 2px 16px;
}
.modal-body{
  background: linear-gradient(45deg, red, orange, yellow, green, blue, indigo, violet, red);
}
</style>
<!--card style css-->



<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="partihome.php">Participant Access</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="upcomingtour.php">Upcoming Tournaments</a></li>
      <li><a href="profile.php">Profile</a></li>
      <li><a href="yourtour.php">Modify</a></li>
    </ul>
  </div>
</nav>
</head>


<body>

<?php
$sql="SELECT * FROM tourevents";

$data = mysqli_query($conn,$sql);
$n=mysqli_num_rows($data);
$k=$_SESSION['user'];
if($n>0){
  while($row=$data->fetch_assoc()){
    $sql3="SELECT tid from tourparti WHERE tid='".$row['tid']."' AND pid='".$k."'";
    $data3 = mysqli_query($conn,$sql3);
    $row3=$data3->fetch_assoc();
    if(mysqli_num_rows($data3)==1){
      continue;
    }
    else{
    ?>
    <div class="card1">
      <div class="container1">
    <div class="container">
  <div class="card" style="width:400px;">

    <div class="card-body">
      <h4 class="card-title">Name of the Tournament : <?php echo $row['tname'];?></h4>
      <p class="card-text">Type : <?php echo $row['type'];?></p>
      <p class="card-text">Start date : <?php echo $row['start_date'];?></p>
      <p class="card-text">End date : <?php echo $row['end_date'];?></p>
      <p class="card-text">Status : <?php echo $row['status'];?></p>
      <p class="card-text">MinTeams : <?php echo $row['minteams'];?></p>
      <p class="card-text">Participants per team : <?php echo $row['pperteam'];?></p>
      <p class="card-text">Team IDs : <?php echo $row['teamids'];?></p>
      <p class="card-text">Time : <?php echo $row['time'];?></p>


      <!--
        <a href="#" class="btn btn-primary">All Details</a>
      -->
    </div>
  </div>
  
    </div>
    <!--Popup form-->
    <div class="container">
            <div class="container-box">
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal<?php echo $row['tid'];?>">Register</button>
            </div>
            <!-- Modal -->
            <div id="myModal<?php echo $row['tid'];?>" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                          <!--<form method="POST" action="upcomingtour.php">-->
                            <button type="button" class="close" data-dismiss="modal" name="register">&times;</button>
                            <h4 class="modal-title">
                                Register
                            </h4>
                          <!--</form>-->
                        </div>
                        <div class="modal-body">
                        <?php 
                        if($row['type']=='single'){
                          //echo "Success";
                          //echo $k;
                          $p=0;
                          echo "Finally Confirm to register for the tournament";
                          ?>
                          <form method="POST" action="registertour.php">
                          <input type=hidden name="tid" value= "<?php echo $row['tid'];?>" readonly>
                          <input type=hidden name="pid" value= "<?php echo $k;?>" readonly>
                          <input type='submit' name='register' action="registertour.php">
                        </form>
                          <?php
                                                      
                        }
                        
                        ?>
                        












                        
                            <div id="success_message" style="width:100%; height:100%; display:none; "> <h3>Sent your message successfully!</h3> </div>
                            <div id="error_message" style="width:100%; height:100%; display:none; "> <h3>Error</h3> Sorry there was an error sending your form. </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                              </div>
                              </div>
<!--Popup form-->
    <?php
    }
  }
}

?>


</body>
</html>