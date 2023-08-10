 <?php 
 include 'connection.php';
	$q = $_REQUEST["q"];
	$result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $q");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $name;
		$name = $row[2];
		
	}
	
 ?>
 <form role="form" method="post" action="ConnectionChangeProductName.php">
         <input type="hidden" class="form-control" name="product" value=<?php echo $q; ?> >
          <div class="form-group">
            <label class="control-label col-sm-2" for="pwd" >New Name:</label>
            <div class="col-sm-10">          
              <input type="text" class="form-control" value="<?php echo $name; ?>" name="name">
            </div>
          </div>
		  
		  <div id="txtHint" style="background-color:#eee;"><b></b></div>
          
          <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Update</button>
            </div>
          </div>
        </form>