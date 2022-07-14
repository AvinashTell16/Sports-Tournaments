
<?php
session_start();
$conn = new mysqli("localhost:3306", 'root','','tournament');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
?>



<!DOCTYPE html>
<html>
<head>
<title>Participants SignUp Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="regis.css">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<script type=text/javascript>
  function validate(){
  var username=document.getElementById("name").value;
  var password=document.getElementById("password").value;
  var cpassword=document.getElementById("cpassword").value;
  var email=document.getElementById('email').value;
  var age=document.getElementById('age').value;
  var age1 = parseInt(age);
  var bloodgroup=document.getElementById('bloodgroup').value;
  if(username.length<6){
    alert("Invalid Username");
    
  }
  if(password.length<6){
    alert("password is weak! Choose another password");
  }
  if(password!=cpassword){
    alert("password does not match");
  }
  if(age1>60 && age1<10){
    alert("Invalid age");
    return false;
  }
  if(bloodgroup!="O+" && bloodgroup!="O-" && bloodgroup!="A+" && bloodgroup!="A-" && bloodgroup!="B+" && bloodgroup!="B-" && bloodgroup!="AB+" && bloodgroup!="AB-"){
    alert("Invalid blood group");
    return false;
  }
}
</script>
</head>
<body>
<div>
<?php
if(isset($_POST['submit'])){
  $pname=$_POST['name'];
  $pass=$_POST['password'];
  $wins="0";
  $age=$_POST['age'];
  $email=$_POST['email'];
  $address=$_POST['address'];
  $bgrp=$_POST['bloodgroup'];
  $f1=0;
  $f2=0;
  //password hashing
 // $pass1=password_hash($pass,PASSWORD_DEFAULT);
 $sql1="SELECT email FROM participants WHERE email='".$email."'";
 $data1=mysqli_query($conn,$sql1);
 if(mysqli_num_rows($data1)==1){
  $f1=1;
  echo "<script>alert('User with same mail already exists')</script>";
 }
 $sql2="SELECT pname FROM participants WHERE pname='".$pname."'";
 $data2=mysqli_query($conn,$sql2);
 if(mysqli_num_rows($data2)==1){
  $f2=1;
  echo "<script>alert('User with same name already exists')</script>";
 }
 if($f1==0 && $f2==0){
 
  $sql="INSERT INTO participants (pname,wins,age,email,password,address,bloodgroup) values('$pname','$wins','$age','$email','$pass','$address','$bgrp')";
  $data = mysqli_query($conn,$sql);
  if($data){
      echo "<script>alert('User registered succesfully')</script>";
    ?>
	<script type="text/javascript">
	window.location = 'login.php';
	</script>      
    <?php
}
else{
    
    echo "<script>alert('record insertion failed')</script>";
}
}
}
?>
</div>
  <div class="main-w3layouts wrapper">
    <h1>Sports Tournament</h1>
    <h1>Participants SignUp Form</h1>
    <div class="main-agileinfo">
      <div class="agileits-top">
      <form method="post">
          <input class="text" type="text" name="name" placeholder="Username" required="" id="name">
          <input class="text email" type="email" name="email" placeholder="Email" required="" id="email">
          <input class="text" type="password" name="password" placeholder="Password" required="" id="password">
          <input class="text w3lpass" type="password" name="password" placeholder="Confirm Password" required="" id="cpassword">
          <input class="text" type="text" name="age" placeholder="Age" required="" id="age"><br>
          <input class="text" type="text" name="bloodgroup" placeholder="bloodgroup" required="" id="bloodgroup"><br>
          <input class="text" type="text" name="address" placeholder="address" required="" id="address">
          <!--
          <select name="bloodgroup" class="text" required="">
            <option value="O+">O+</option>
            <option value="O+">O-</option>
            <option value="O+">A+</option>
            <option value="O+">A-</option>
            <option value="O+">B+</option>
            <option value="O+">B-</option>
            <option value="O+">AB+</option>
            <option value="O+">AB-</option>
          </select>
        -->
          <div class="wthree-text">
            <label class="anim">
              <input type="checkbox" required="">
              <span>I Agree To The Terms & Conditions</span>
            </label>
            <div class="clear"> </div>
          </div>
          <input type="submit" value="SIGNUP" name="submit" onClick="return validate()"> 
        </form>
        <p>Already have an account? <a href="login.php"> Login Here!</a>
        </p>
        <p>Admin? <a href="login.php"> Signin Here!</a>
        </p>
      </div>
    </div>
    
</body>
</html>
