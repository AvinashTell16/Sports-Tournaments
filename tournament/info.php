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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Tournament Info</title>
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
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
    <img src="tour.png" width="150px" height="50px">
    </div>
    <ul class="nav navbar-nav">
    <li  class="active"><a href="info.php">All Tournaments</a></li>
      <li><a href="createtournament.php">Create Tournament</a></li>
      
      <li><a href="#">Reports</a></li>
	  <li><a href="#">Results</a></li>
    </ul>
    <input type="button" value="Logout" style="float:right;width: 100px;margin-top:10px;margin-bottom:10px;background-color:red;border-radius:5px;border:None;color:white;" onclick="window.location='logout2.php';"></h1>
  </div>
</nav>

<?php
$sql="SELECT * FROM tourevents";

$data = mysqli_query($conn,$sql);
$n=mysqli_num_rows($data);
if($n>0){
  while($row=$data->fetch_assoc()){
    ?>
    <div class="card1">
      <div class="container1">
    <div class="container">
  <div class="card" style="width:400px;" id="myButton<?php echo $row['tid'];?>">
  

    <div class="card-body" >
    <script type="text/javascript">
    document.getElementById("myButton<?php echo $row['tid'];?>").onclick = function () {
      var tid = <?php echo $row['tid']; ?>;
        location.href ="details.php?s="+tid;
    };
</script>
      <h4 class="card-title">Name of the Tournament : <?php echo $row['tname'];?></h4>
      <p class="card-text">Type : <?php echo $row['type'];?></p>
      <p class="card-text">Start date : <?php echo $row['start_date'];?></p>
      <p class="card-text">End date : <?php echo $row['end_date'];?></p>
      <p class="card-text">Status : <?php echo $row['status'];?></p>
      <p class="card-text">MinTeams : <?php echo $row['minteams'];?></p>
      <p class="card-text">Participants per team : <?php echo $row['pperteam'];?></p>
      <!--Display Team ids-->
      <!--<p class="card-text">Team IDs : <?//php echo $row['teamids'];?></p>-->
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
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal<?php echo $row['tid'];?>">Edit Details</button>
            </div>
            <!-- Modal -->
            <div id="myModal<?php echo $row['tid'];?>" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">
                                Edit Details
                            </h4>
                        </div>
                        <div class="modal-body">
                        <form action="edittour.php" method="post">
                                Tournament ID:
                                <input type="text" value="<?php echo $row['tid'];?>" name="tid" readonly><br><br>
                                Tournament name:
                                <input type="text" name="tname" required class="smalltext" value='<?php echo $row['tname'];?>'>
                                Type:
                                <select name="type" required class="smalltext">
                                <option selected><?php echo $row['type'];?></option>   
                                
                                </select><br><br>
                                Minteams                                                                      
                                <input type="text" name="minteams" required class="bigtext" value= '<?php echo $row['minteams'];?>'><br><br>
                                Participants per team                                                                      
                                <input type="text" name="pperteam" required class="bigtext" value='<?php echo $row['pperteam'];?>'><br><br>
                                Status
                                <select name="status" required class="smalltext">
                                <option selected><?php echo $row['status'];?></option> 
                                <?php
                                if($row['status']==''){
                                ?>
                                <option>Active</option>  
                                <option>InActive</option>  
                                <?php
                                } 
                                else if($row['status']=='Active'){
                                ?>
                                <option>InActive</option>  
                                <?php
                                } 
                                else{
                                ?>
                                <option>Active</option>
                                <?php
                                }
                                ?>
                                </select>
                                Start Date:  
                                <input type="date" name="startdate" required class="smalltext" value='<?php echo $row['start_date'];?>'>
                                End Date:  
                                <input type="date" name="enddate" required class="smalltext" value='<?php echo $row['end_date'];?>'><br><br>
                                Event Time:  
                                <input type="time" name="time" required class="smalltext" value='<?php echo $row['time'];?>'><br><br>
                                Team IDs
                                <input type="text" value="<?php echo $row['teamids'];?>" name="teamids"><br><br>

                                <input type="submit" value="Submit">
                              </form>
                            <div id="success_message" style="width:100%; height:100%; display:none; "> <h3>Sent your message successfully!</h3> </div>
                            <div id="error_message" style="width:100%; height:100%; display:none; "> <h3>Error</h3> Sorry there was an error sending your form. </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>




            <div class="container-box" style="vertical-align: middle;">
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal<?php echo $row['tid'];?>cancel">Cancel Tournament</button>
            </div>
            <!-- Modal -->
            <div id="myModal<?php echo $row['tid'];?>cancel" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">
                                Cancel the Tournament
                            </h4>
                        </div>
                        <div class="modal-body">
                          <h3>Are you sure to cancel the tournament??</h3>
                        <form method="POST" action="removetour.php">
                                  <input type='submit' value='cancel' name="cancel">
                                  <input type=hidden name="tid" value= "<?php echo $row['tid'];?>" readonly>
                                  <input type=hidden name="type" value= "<?php echo $row['type'];?>" readonly>
                                </form>
                                
                          
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

?>


</body>
</html>
