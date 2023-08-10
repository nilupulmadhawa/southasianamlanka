<?php
// require_once './../../util/initialize.php';

function find_all_table($table_name){
  $servername = DB_SERVER;
  $username = DB_USER;
  $password = DB_PASS;
  $dbname = DB_NAME;

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  $sql = "SELECT * FROM ".$table_name." WHERE 1 ";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    return $result;
  } else {
    return 0;
  }

  mysqli_close($conn);
}

// testcase start
// $table_name = "batch";
// $database_result = find_all_table($table_name);
// while($row = mysqli_fetch_assoc($database_result)) {
//     echo $row["id"]."<br>";
// }
// test case ends
