<html>
<head>
	<style type="text/css">
		table {
			border-collapse: collapse;
		}        
		td {
			border: 1px solid green;
			padding: 0 0.5em;
		}        
	</style>
</head>
<body>
	<?php
	include 'reader.php';
	$excel = new Spreadsheet_Excel_Reader();
	?>
	Sheet 1:<br/><br/>


	<table>
		<?php
		
        //function start
        
        function insertdata($data){
            $tablename = 'brand';
            $servername = "localhost";
            $username = "l99thpjs_admin";
            $password = "chinthaka16992";
            $dbname = "l99thpjs_saaims";
            
            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            $sql = "INSERT INTO ".$tablename." (name)
            VALUES ('$data')";
            
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            
        }
        
        // function ends
		
		$excel->read('saa.xls');    
		$x=1;
		while($x<=$excel->sheets[0]['numRows']) {
			echo "\t<tr>\n";

			$y =1;
			$cell = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';
			 
			if($cell != ""){
				echo "\t\t<td>$cell</td>\n";
				insertdata($cell);
			}else{
				// echo "\t\t<td>CAT</td>\n";
							
			}

      // echo rows

      // while($y<=$excel->sheets[0]['numCols']) {
      //   $cell = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';
      //   echo "\t\t<td>$cell</td>\n";  
      //   $y++;
      // }  

      // end of row echo

			echo "\t</tr>\n";
			$x++;
		}
		?>    
	</table><br/>  
	
	
</body>
</html>
