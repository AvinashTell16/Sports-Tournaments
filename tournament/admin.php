<?php 
session_start();
$conn = new mysqli("localhost:3306", 'root','','tournament');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  if(isset($_SESSION['userid'])){
    header("Location: info.php", TRUE, 301);
    exit();
  }

?>


<!DOCTYPE html>
<html>
<head>
<title>Admin Login Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="regis.css">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">

</head>
<body>
<div>
  <?php
  //echo $_SESSION['userid'];
  if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $sql="SELECT * FROM admin WHERE email='".$email."' AND  password='".$pass."' limit 1";
    $data = mysqli_query($conn,$sql);
    if(mysqli_num_rows($data)==1){
      //echo "<script>alert('Logged in succesfully')</script>";
      $_SESSION['userid']=$email;
      //echo $_SESSION['userid'];
      ?>
      <script type="text/javascript">
      window.location = 'info.php';
      </script>      
        <?php
    }
    else{
      echo "<script>alert('Email or password is wrong')</script>";  
    }
    
}
  ?>
</div>
  <div class="main-w3layouts wrapper">
    <h1>Sports Tournament</h1>
    <h1>Admin Login Form</h1>
    <div class="main-agileinfo">
      <div class="agileits-top">
        <form action="#" method="post">
          <input class="text email" type="email" name="email" placeholder="Email" required="">
          <input class="text" type="password" name="password" placeholder="Password" required="">
          
          <input type="submit" value="SIGNIN" name="submit">
        </form>
        
        <p>New User? <a href="registration.php"> Signup Here!</a>
        <p>Already have an User account? <a href="login.php"> Login Here!</a>
        </p>
        </p>
      </div>
    </div>
    
</body>
</html>