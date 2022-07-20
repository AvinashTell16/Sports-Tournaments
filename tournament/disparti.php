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
  <title>Teams Info</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


<!--card style css-->
<style>
.card1 {
float: left;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 45%;
  padding: 0 40px;
  margin-top:100px;
  margin-right: 50px;
  margin-bottom: 50px;
  margin-left:20px;
  border:10px;
  min-height:250px;
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
/*header css start*/
.header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: dodgerblue;
  color: white;
}

.header button {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  line-height: 25px;
  border-radius: 4px;
  border:none;
}

.header button.logo {
  font-size: 25px;
  font-weight: bold;
}

.header button:hover {
  background-color: #ddd;
  color: black;
}

.header button.active {
  background-color: dodgerblue;
  color: white;
}
.header-right {
  float: right;
}

/* Add media queries for responsiveness - when the screen is 500px wide or less, stack the links on top of each other */
@media screen and (max-width: 500px) {
  .header h3 {
    float: none;
    display: block;
    text-align: left;
  }
  .header-right {
    float: none;
  }
}
/*header css end*/
/*table style start*/
table {
  width: 100%;
  border: 1px solid blue;
  }
th, td {
  text-align: left;
  padding: 8px;
  }
/*table style end*/
</style>
<!--card style css-->

</head>
<body>
<?php

$tid=$_GET['tid'];

$sql="SELECT * FROM tourevents where tid='".$tid."'";
$data = mysqli_query($conn,$sql);
$n=mysqli_num_rows($data);
$row=$data->fetch_assoc();
?>

  <div class="header">
  <a class="logo"><?php echo $row['tname'];?></a>
  <div class="header-right">
  <a class="active" href="info.php" >All tournaments</a>
    <a class="active" href="logout2.php"style="margin-left:60px;">Logout</a>

  </div>
</div>
<?php
  //disqualify of single participants
    $sql2="SELECT * FROM tourparti where tid='".$tid."' AND disqualify=1";
    $data2 = mysqli_query($conn,$sql2);
    $n=mysqli_num_rows($data2);
//echo $tid;
if($n>0){
  ?>
      
        <!--<h4 class="card-title">Name of the Tournament : <?php //echo $row['tname'];?></h4>-->
        <div style="overflow-x:auto;">
         <table>
            <tr style="border-bottom:1pt solid blue;">
               <th>Participant Name</th>
               <th>Age</th>
               <th>Email</th>
               <th>Address</th>
               <th>Blood Group</th>
               <th>Disqualify</th>
               
            </tr>
            
      <?php
    while($row2=$data2->fetch_assoc()){
      $sql3="SELECT * FROM participants where pid='".$row2['pid']."'";
      $data3 = mysqli_query($conn,$sql3);
      $row3=$data3->fetch_assoc();
      ?>
      <tr>
               <td><?php echo $row3['pname']?></td>
               <td><?php echo $row3['age']?></td>
               <td><?php echo $row3['email']?></td>
               <td><?php echo $row3['address']?></td>
               <td><?php echo $row3['bloodgroup']?></td>
               <form method="POST" action="#">
                <input type=hidden name="tid" value=<?php echo $tid;?>>
                <input type=hidden name="pid" value=<?php echo $row2['pid'];?>>
               <td><input type="submit" name="partiqualify" style="color:white;background-color:green;border-radius:10%;" value="Qualify"></td>
              </form>
               <td></td>
      </tr>
      <?php
      
    }
    if(isset($_POST['partiqualify'])){
      $sql5="UPDATE tourparti SET disqualify=0 WHERE tid='".$tid."' AND pid='".$_POST['pid']."'";
      $data5=mysqli_query($conn,$sql5);
      if($data5){
        echo "<script>alert('Participant is Qualified succesfully')</script>";
        echo '<script type="text/javascript">window.location = "info.php";</script> ';
      }
    }
    ?>
    </table>
    <?php
  }
?>

</body>
</html> 