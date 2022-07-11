<?php
session_start();
$conn = new mysqli("localhost:3307", 'root','','tournament');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>


<!DOCTYPE html>
<html>
<head>
	<title>Modify Tournament</title>
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


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="form.css" >
        <script src="form.js"></script>


</head>
<body>

<header>
<img src="tour.png" width="100px" height="80px">

<a href ="index.html"> <input type="button" value="Logout" style="float:right;width: 200px;" onclick="window.location='logout1.php';"></a></h1>
</header>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Admin Access</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="adminhome.php">Admin Home Page</a></li>
	  <li><a href="createtournament.php">Create Tournament</a></li>
      <li><a href="info.php">Info</a></li>
      <li class="active"><a href="modifytour.php">Modify</a></li>
      <li><a href="reporttour.php">Reports</a></li>
	  <li><a href="resulttour.php">Results</a></li>
    </ul>
  </div>
</nav>


<?php
$sql="SELECT * FROM tourevents";

$data = mysqli_query($conn,$sql);
$n=mysqli_num_rows($data);
if($n>0){
  while($row=$data->fetch_assoc()){
    ?>
    <div class="container">
  <div class="card" style="width:400px;">
  <form action="edittour.php?id='.$_GET['tid'].'" method="POST">
    <div class="card-body">
      <h4 class="card-title">Tournament ID:</h4>
      
      <input type="text" value="<?php echo $row['tid'];?>" name="tid" readonly><br>
      <h4 class="card-title">Name of the Tournament :</h4>
      
      <input type="text" value="<?php echo $row['tname'];?>" name="tname"><br>
      <p class="card-text">Type :</p>
      <select name="type" required class="smalltext" name="type">
      <option selected><?php echo $row['type'];?></option>   
      <?php
      if($row['type']=='single'){
        ?>
        <option>team</option>    
        <?php
      } 
      else{
        ?>
        <option>single</option>
        <?php
      }
      ?>
      </select>
    <br>
    
    
      <p class="card-text">Start date : </p>
      <input type="date" name="start_date" value="<?php echo $row['start_date'];?>">
      <br>
      <p class="card-text">End date : </p>
      <input type="date" name="end_date" value="<?php echo $row['end_date'];?>">
      <br>

      <p class="card-text">Status : </p>
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
      <?php echo $row['status'];?>
      <br>
      <p class="card-text">MaxTeams : </p>
      <input type="text" value="<?php echo $row['maxteams'];?>" name="maxteams"><br>

      <p class="card-text">Participants per team : </p>
      <input type="text" value="<?php echo $row['pperteam'];?>" name="pperteam"><br>
      
      <p class="card-text">Team IDs : </p>
      <input type="text" value="<?php echo $row['teamids'];?>" name="teamids"><br><br>


      <p class="card-text">Event Time :</p>
      <input type="time" name="time" required class="smalltext" value="<?php echo $row['time'];?>"><br><br>
<!-------------------------------------------------------------------------------------------------------------->

      <div class="container">
            <div class="container-box">
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Contact Us</button>
            </div>
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
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
                            <form role="form" method="post" id="reused_form">
                                <p> Send your message in the form below and we will get back to you as early as possible. </p>
                                <div class="form-group">
                                    <label for="name"> Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required maxlength="50" value='<?php echo $row['tname'];?>'>
                                </div>
                                <div class="form-group">
                                    <label for="email"> Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required maxlength="50">
                                </div>
                                <div class="form-group">
                                    <label for="name"> Message:</label>
                                    <textarea class="form-control" type="textarea" name="message" id="message" placeholder="Your Message Here" maxlength="6000" rows="7"></textarea>
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block" id="btnContactUs">Post It! &rarr;</button>
                            </form>
                            <div id="success_message" style="width:100%; height:100%; display:none; "> <h3>Sent your message successfully!</h3> </div>
                            <div id="error_message" style="width:100%; height:100%; display:none; "> <h3>Error</h3> Sorry there was an error sending your form. </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <!------------------------------------------------------------------------------------------------------------------>

      <!--
        <input type= "submit" name='edit' value='Edit Details'></a>

    -->
        <input type="button" name='drop' value='Drop Teams'></a>
        
    </div>
  </form>
  <?php 
  echo "--------------------------------------------------------------------------------";
  ?>
  </div>
    </div>
    <br>
    <?php
  }
}

?>

</body>
</html>