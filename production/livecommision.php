<?php 
include 'connection.php'; 
$month  = $_GET['q'];
$usercount = 0;
$result = mysqli_query($conn,"SELECT * FROM user_profile WHERE Privilages_Priv_ID = 3 ");
while($row = mysqli_fetch_array($result)){
	GLOBAL $usercount;
	$usercount = $usercount + 1;
	}
$steps = 1;
while($steps <= $usercount){
	$result = mysqli_query($conn,"SELECT * FROM user_profile WHERE Privilages_Priv_ID = 3 LIMIT $steps ");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $username,$empID;
		$empID = $row[8];
		$username = $row[1];
		}
	echo "<div class='row'><b>Rep Name: </b>".$username."<br/>";
	echo "<div class='col-sm-7'><table class='table'>
    <thead>
      <tr>
        <th>Commision Type</th>
        <th>Ammount</th>
      </tr>
    </thead>
    <tbody>";
	$total = 0;
	$result = mysqli_query($conn,"SELECT * FROM commision WHERE Emp_id = $empID ");
	while($row = mysqli_fetch_array($result)){
		echo "<tr>";
		echo "<td>".$row[3]."</td>";
		echo "<td>".number_format($row[2],2)."</td>";
		echo "</tr>";
		$total = $total + $row[2];
		}
		
	echo "</tbody>
  </table></div>
  <div class='col-sm-5'><b>Total Commision:  </b> Rs.".number_format($total,2)."</div>
  </div><hr/>";
	$steps = $steps +1;
	}
	
?>