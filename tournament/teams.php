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

  //echo $_POST['tid'];
  //echo $_POST['pid'];
 // if($_POST['type']=='create'){
   // ?>
   <!-- <form action="#" method="post">
          <input class="text email" type="email" name="email" placeholder="Email" required="">
          <input class="text" type="password" name="password" placeholder="Password" required="">
          
          <input type="submit" value="SIGNIN" name="submit">
        </form>
 -->
 <?php
//  }
 // else{
 //   echo "Join Team";
 // }
  
//?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    if($_POST['teamid']==NULL){
            
        ?>
    <div class="main">
        <div class="container a-container" id="a-container">
            <form class="form" id="a-form" method="POST" action="registerteam.php">
                <h2 class="form_title title">Create Team</h2>
                <input class="form__input" type="text" placeholder="Team Name" name="teamname" required>
                <input class="form__input" type=hidden placeholder="count" name="count" required>
                <input type=hidden name="tid" value= "<?php echo $_POST['tid'];?>" readonly>
                <input type=hidden name="pid" value= "<?php echo $_POST['pid'];?>" readonly>
                <input type="submit" class="switch__button button " value="Create Team">
            </form>
        </div>



        <div class="container b-container" id="b-container">
            <form class="form" id="b-form" method="POST" action="jointeam.php">
                <h3 class="form_title title">Join in a existing team</h3>

                <!--
                <input class="form__input" type="text" placeholder="Email">
                <input class="form__input" type="password" placeholder="Password">
                -->
                <?php
                $sql2="SELECT teamid from tourteams WHERE tid='".$_POST['tid']."'";
                $data2=mysqli_query($conn,$sql2);
                $n2=mysqli_num_rows($data2);
                if($n2>0){
                    ?>
                    <h3>Select the team</h3> 
                    <select class="form__input" name="team" required class="smalltext">
                    <option value="">None</option>
                    <?php
                    while($row2=$data2->fetch_assoc()){
                        $sql3="SELECT teamname from team WHERE teamid='".$row2['teamid']."'";
                        $data3=mysqli_query($conn,$sql3);
                        $row3=$data3->fetch_assoc();
                        ?>
                        <option value="<?php echo $row3['teamname'];?>"><?php echo $row3['teamname'];?></option>
                        <!--<input type=hidden name="teamid" value= "<?php //echo $row2['teamid'];?>" readonly>-->
                        <?php
                    }
                    ?>
                    </select>

                    <input type="submit" class="switch__button button " value="Join T">
                    <?php
                }
                else{
                    echo "No Team is Presently registered to this tounament\n";
                    echo "Please Create a new team";
                }
                ?>
                
            </form>
        </div>



        <div class="switch" id="switch-cnt">
            <div class="switch__circle"></div>
            <div class="switch__circle switch__circle--t"></div>
            <div class="switch__container" id="switch-c1">
                <h2 class="switch__title title">Join Team</h2>
                <button class="switch__button button switch-btn">Join</button>
            </div>



            <div class="switch__container is-hidden" id="switch-c2">
                <h2 class="switch__title title">Create Team</h2>
                <button class="switch__button button switch-btn">Create</button>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
    <?php
    }
    else{
        $tid=$_POST['tid'];
        $pid=$_POST['pid'];
        $teamid=$_POST['teamid'];
        $sql4="SELECT captain FROM team WHERE teamid='".$teamid."'";
        $data4=mysqli_query($conn,$sql4);
        $row4=$data4->fetch_assoc();
        
        ?>

        <form method="POST" action="addall.php">
        <input type=hidden name="tid" value= "<?php echo $tid;?>" readonly><br>
        <input type=hidden name="pid" value= "<?php echo $pid;?>" readonly><br>
        <input type=hidden name="teamid" value= "<?php echo $teamid;?>" readonly><br>
        <input type=hidden name="captainpid" value= "<?php echo $row4['captain'];?>" readonly><br>
        <?php
        if($pid!=$row4['captain']){
            echo "<script>alert('You are not the captain of the team!! Cannot Register for the tournament')</script>";
            ?>
            
            <script type="text/javascript">
            window.location = 'upcomingtour.php';
            </script>      
      <?php
        }
        else{
        ?>
        <div class="addall">
        <h3>Review all the team members and Register for the tournament</h3>
        <?php
            $sql5="SELECT DISTINCT participants.pid,participants.pname FROM teamparti INNER JOIN participants ON teamparti.teamid=participants.teamid WHERE teamparti.teamid='".$teamid."'";
            $data5=mysqli_query($conn,$sql5);
            $n=mysqli_num_rows($data5);
            ?>
            <table border="1px">
                        <tr>
                            <th>Name of the candidate</th>
                        </tr>
            <?php
            if($n>0){
                while($row5=$data5->fetch_assoc()){

                    ?>
                    <tr>
                        <td><?php echo $row5['pname'];?></td>
                    </tr>
                    <?php
                    
                }
            }
            
        ?>
        <?php
        }
        ?>
        </table>
        <br><br>
        <input type="submit" value="Register" name="register">
        </form>
    </div>
      <?php     
    }
    ?>


</body>

</html>