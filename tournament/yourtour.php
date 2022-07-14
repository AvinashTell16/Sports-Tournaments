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
  <title>Modify Your Tounaments</title>
  <h3 class="liketext">Push Yourselves to compete with others</h3>
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

</head>
<body>
<header>


</header>
<div style="padding-top:20px;">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
    <img src="tour.png" width="150px" height="50px">
    </div>
    <ul class="nav navbar-nav">
      <li class="active" style="padding-left:20px;"><a href="yourtour.php">Home Page</a></li>
      <li><a href="upcomingtour.php">Upcoming Tournaments</a></li>
      <li><a href="profile.php">Profile</a></li>
    </ul>
    <input type="button" value="Logout" style="float:right;width: 100px;margin-top:10px;margin-bottom:10px;background-color:red;border-radius:5px;border:None;color:white;" onclick="window.location='logout3.php';"></h1>

  </div>
</nav>
</div>

<?php

$sql1="SELECT * FROM tourparti WHERE pid='".$_SESSION['user']."'";

$data1 = mysqli_query($conn,$sql1);
$n=mysqli_num_rows($data1);
if($n>0){
  while($row1=$data1->fetch_assoc()){
    ?>
    <div class="card1">
      <div class="container1">
    <div class="container">
  <div class="card" style="width:400px;">

    <div class="card-body">
    
        <?php
        $sql="SELECT * FROM tourevents WHERE tid='".$row1['tid']."'";
        $data = mysqli_query($conn,$sql);
        $row=$data->fetch_assoc()
        ?>
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
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal<?php echo $row['tid'];?>">Deregister</button>
            </div>
            <!-- Modal -->
            <div id="myModal<?php echo $row['tid'];?>" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">
                                Deregister
                            </h4>
                        </div>
                        <div class="modal-body">
                            <?php
                            if($row['type']=='single'){
                                ?>
                                <form method="POST" action="deregistersingle.php"> 
                                    <h3>Are you sure want to deregister?</h3>
                                    <h3>This tournament is of single type. Deregistering will remove your chance to participate</h3>
                                    <input type="hidden" name="tid" value="<?php echo $row['tid']?>">
                                    <input type="hidden" name="pid" value="<?php echo $_SESSION['user']?>">
                                    <input type="submit" name="submit" value="Withdraw">
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
//Display Team Tournaments to which the participant is registered to
$k=$_SESSION['user'];
$sql2="SELECT teamid FROM participants WHERE pid='".$k."'";
$data2=mysqli_query($conn,$sql2);
$row2=$data2->fetch_assoc();
$k2=$row2['teamid'];
$sql1="SELECT * FROM tourteams WHERE teamid='".$k2."'";
$data1 = mysqli_query($conn,$sql1);
$n=mysqli_num_rows($data1);
if($n>0){
  while($row1=$data1->fetch_assoc()){
    ?>
    <div class="card1">
      <div class="container1">
    <div class="container">
  <div class="card" style="width:400px;">

    <div class="card-body">
    
        <?php
        $sql="SELECT * FROM tourevents WHERE tid='".$row1['tid']."'";
        $data = mysqli_query($conn,$sql);
        $row=$data->fetch_assoc()
        ?>
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
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal<?php echo $row['tid'];?>">Deregister</button>
            </div>
            <!-- Modal -->
            <div id="myModal<?php echo $row['tid'];?>" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">
                                Deregister
                            </h4>
                        </div>
                        <div class="modal-body">
                            <?php
                            if($row['type']=='single'){
                                ?>
                                <form method="POST" action="deregistersingle.php"> 
                                    <h3>Are you sure want to deregister?</h3>
                                    <h3>This tournament is of single type. Deregistering will remove your chance to participate</h3>
                                    <input type="hidden" name="tid" value="<?php echo $row['tid']?>">
                                    <input type="hidden" name="pid" value="<?php echo $_SESSION['user']?>">
                                    <input type="submit" name="submit" value="Withdraw">
                                </form>
                                <?php
                            }
                            else{
                              $sql3="SELECT participants.teamid,team.captain FROM participants INNER JOIN team ON participants.teamid=team.teamid WHERE pid='".$_SESSION['user']."'";
                              $data3=mysqli_query($conn,$sql3);
                              $row3=$data3->fetch_assoc();
                              //echo $row3['teamid'];
                              //echo $row3['captain'];
                              if($_SESSION['user']==$row3['captain']){
                                echo "You are the captain of the team !! You can deregister the team from the tournament";
                                ?>
                                <form method="POST">
                                  <input type='submit' value='deregister' name="deregister">
                          
                                </form>
                                <?php
                                  if (isset($_POST["deregister"])){
                                    //echo $row['tid'];
                                    //echo $row3['teamid'];
                                    $sql4="DELETE FROM tourteams WHERE tid='".$row['tid']."' AND teamid='".$row3['teamid']."' ";
                                    $data4=mysqli_query($conn,$sql4);
                                    if($data4){
                                      echo "<script>alert('Deregistered');</script>";
                                      echo "<script type='text/javascript'>window.location = 'yourtour.php';</script> ";
                                    }
                                    
                                  }
                              }
                              else{
                                echo "You are not the captain of the team !! Cannot degister from the tournament";
                                
                              }

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
<!-- Display of the tournaments registered as a team-->
    <?php
  }
}


?>


</body>
</html>
