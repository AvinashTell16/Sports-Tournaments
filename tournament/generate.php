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
//echo $tid;

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
    /*
    $a=[];
    $sql2="SELECT teamid FROM tourteams WHERE tid='".$tid."'";
    $data2=mysqli_query($conn,$sql2);
    $n=mysqli_num_rows($data2);
    if($n>0){
        while($row2=$data2->fetch_assoc()){
            array_push($a,$row2['teamid']);
        }
    }
    shuffle($a);
    for($i=0;$i<$n;$i++){
        echo $a[$i];
    }
    */
$teams = array(
    'Team 1',
    'Team 2',
    'Team 3',
    'Team 4',
    'Team 5',
    'Team 6',
    'Team 7',
    'Team 8'
);

function getMatches($teams) {
    shuffle($teams);
    return call_user_func_array('array_combine', array_chunk($teams, sizeof($teams) / 2));
}

for ($i = 0; $i < 1; $i += 1) {
    //print_r(getMatches($teams));
    $k=getMatches($teams);
    print_r($k);
}
echo '<br>';
$keys=array_keys($k);
print_r($keys);
echo '<br>';
$values=array_values($k);
print_r($values);
echo '<br>';
echo $keys[0];
echo $values[0];
?>
</body>
</html>