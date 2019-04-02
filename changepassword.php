
<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
		<title>Update Password</title>
		
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="main.css">
		<script type="text/javascript" src="bootstrap/js/jquery-slim.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
		<link rel ="stylesheet" href = "font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
		<form action="logout.php" method="POST">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
   <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link fa fa-home" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
	  
	  </nav>
     </form>


<br><br>
<center>
			
			<u><h1>Change Password</h1></u>
			
			<form action = "changepasspro.php" method="POST">
				<br><br>
				<div class="container">
				
				  <label for="inputName">Old Password</label>
					<div class="col-6">					
					  <input type="password" class="form-control" name="oldpassword" placeholder="old password" style="width: 195px;" pattern=".{8,}" required>
					</div>
				
				 <br>
				
				   <label for="inputName">New Password</label>		
					<div class="col-6">
						<input type="password"  class="form-control" name="newpassword" placeholder="new password" style="width: 195px;" pattern=".{8,}"   required title="8 characters minimum" required>
				  </div>
			
				 <br>
				   <label for="inputName">Confirm New Password</label>
				  <div class="form-group">
					<input type="password"  class="form-control" name="confirmnewpassword" placeholder=" confirm new password" style="width: 195px;" pattern=".{8,}"   required title="8 characters minimum" required>
				  </div>
				 <br>
				  <button type="submit" name="submit" class="btn btn-primary"> Submit</button>
				  <button class="btn btn-success"><a href="changepassword.php"> Cancel</a></button>
		  </div>
		 
		  </form>
</center>
	

</body>  
</html>
	