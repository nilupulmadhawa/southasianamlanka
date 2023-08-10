

<div style="margin-bottom:20px;"><a href="Maintain.php"><button type="button" class="btn btn-warning" style="width:200px;">Home</button></a></div>




<div class="well">
        <?php
        include 'connection.php';
        $image ="NULL";
        $result = mysqli_query($conn,"SELECT * FROM user_profile WHERE User_User_ID = $id1 ");
        while($row = mysqli_fetch_array($result)){
          GLOBAL $image,$name,$pid;
          $image = $row[6];
          $name = $row[1];
          $pid = $row[7];
        }

         echo "<img src='images/".$image."' class='img-circle' alt='Cinque Terre' width='105' height='100'>";
         mysqli_close($conn);

        echo "<div style='margin-top:5px;'>
        <p><b>User ID:</b> ".$id1."</p>
        <p><b>Name:</b> ".$name."</p> <p><b>Position:</b>";
        if($pid==1){
        echo "Administrator";}
        else if($pid==2){
          echo "Maintainer";
        }
        else if($pid == 3){
          echo "Representative";
        }
//        echo "</p><p><b>Login Time:</b> 10.22pm</p> ";
    ?>
    </div>

    <div class="dropdown" >
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="width:150px;" ><span class="glyphicon glyphicon-cog"></span> Settings
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><a href="">Change Password</a></li>
    <li><a href="">View Account Details</a></li>
  </ul>
</div>

<?php include 'includes/slider.php'; ?>

</div>
