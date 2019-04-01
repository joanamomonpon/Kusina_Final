
<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Update Password</title>
</head>
<body>


<br><br>
<center>

			<div class="container" style="width: 450px ; drop shadow rectangle">
		<form action = "changepasspro.php" method="POST">
				<br><br>
				  <label for="inputName">Old Password</label>
				  <div class="row">
					<div class="col-6">					
					  <input type="password" class="form-control" name="oldpassword" placeholder="first name" style="width: 195px;" required>
					</div>
					
					<div class="col-6">					
					</div>
				  </div><br/>		
				   <label for="inputName">New Password</label>		
				  <div class="form-group">
					<input type="password"  class="form-control" name="newpassword" placeholder="first name" style="width: 195px;" pattern=".{8,}"   required title="8 characters minimum" required>
				  </div>
				   <label for="inputName">Confirm New Password</label>
				  <div class="form-group">
					<input type="password"  class="form-control" name="confirmnewpassword" placeholder="first name" style="width: 195px;" pattern=".{8,}"   required title="8 characters minimum" required>
				  </div>
				  <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-check    "></i> Submit</button>
				  <button class="btn btn-light"><a href="home.php"><i class="fas fa-arrow-circle-left    "></i> Cancel</a></button>
		
</center>
	
	</form>
	</div>
</body>  
</html>
	