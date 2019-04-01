<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>online_kusina</title>
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
			<div class="container">
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
   <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link fa fa-eye" href="orderviewcus.php"> View Reports<span class="sr-only">(current)</span></a>
				</li> 
			</ul>
	</div>
</nav>
<br><br>

	<center>
	
								<?php if(isset($_SESSION['id'])){
									
								
								}
								else{
								header("Location: index.php");
							}?>
	

		<h4><b> Add Customer Order</b></h4>
		
					<br>			
				<?php require_once 'OrderCuspro.php'; ?>	
					<form action="addorderpro.php" style="width:700px " method="POST">
					<input type="hidden" name="order_id" value="<?php echo $order_id; ?>
					<div class="row">
						<div class="col-md-3 mb-3">
							<label>Order ID:</label>
								<input type="text" class="form-control" name="order_id" placeholder="order_id" value="<?php echo $order_id; ?>" required>
						</div>
						<div class="col-md-3 mb-3">
						<label>Customer ID:</label>
							<select name="customer_id" class="form-control" required>
<?php
							include_once 'logindb.php';
							
							$id = $_SESSION['id'];
						
							$sql = "SELECT * 
									FROM customer AS p
									JOIN login_form AS r 
									WHERE p.id = '$id'  
									AND r.id = '$id'";
							$result = mysqli_query($conn, $sql);
							$resultCheck = mysqli_num_rows($result);
							
							if ($resultCheck > 0) {
								while ($row = mysqli_fetch_array($result)) {
						?>
							
							<option value="<?php echo $row['customer_id'];?>" ><?php echo $row["first_name"];?></option>
						<?php		}
			
						}
						?>
							</select>
								
						</div>
						<div class="col-md-3 mb-3">
						<label>Timestamp:</label>
							<input type="date" class="form-control" name="timestamp" placeholder="timestamp" value="<?php echo $timestamp; ?>" required >	
						</div>
					</div>
						
					</div>
						<br>
								<?php 
								   if ($update == true):
								?>
									<input class="btn btn-info" type="submit" name="update_order" value="update" >
								<?php else: ?>
									<input class="btn btn-info" type="submit" name="submit" value="save" >
								<?php endif ;?>
			
			</form>
			</center>
	</div>
</body>
</html>
