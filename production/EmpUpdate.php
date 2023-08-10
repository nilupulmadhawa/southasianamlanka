<?php 
include 'connection.php';
$q = $_REQUEST["q"];
 $result = mysqli_query($conn,"SELECT * FROM user_profile WHERE Prof_ID = $q ");
 while($row = mysqli_fetch_array($result)){
	$id = $row[0];	
	$Name = $row[1];	
	$Address = $row[2];	
	$TPNo = $row[3];	
	$NIC = $row[4];	
	$Email = $row[5];	
	$priv = $row[7];	
	
 }
 mysqli_close($conn);
?>
<form class="form-horizontal" role="form" action="ConnectionEmpUpdate.php" method="post" enctype="multipart/form-data">
            <input type="hidden" class="form-control" placeholder="Full Name" <?php echo "value='".$id."'"; ?> name="empid">
                      
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Role:</label>
                      <div class="col-sm-10">                         
                          <select class="form-control" id="sel1" name="priv">
                            <option value="1" <?php if($priv == 1){echo "selected";} ?> >Administratior</option>
                            <option value="2" <?php if($priv == 2){echo "selected";} ?> >Maintainer</option>
                            <option value="3" <?php if($priv == 3){echo "selected";} ?> >Representative</option>
                          </select>                        
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2">Full Name:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Full Name" <?php echo "value='".$Name."'"; ?> name="fname">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-2">Address:</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" rows="5"  name="address"> <?php echo $Address; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2">Contact Number:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Contact Number" <?php echo "value='".$TPNo."'"; ?> name="contact">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2">NIC:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="NIC" <?php echo "value='".$NIC."'"; ?> name="nic">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2">Email:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Email" <?php echo "value='".$Email."'"; ?> name="email">
                      </div>
                    </div>
                                      
                    
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                      </div>
                    </div>
                  </form>
