<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
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
				<button class="navbar-toggler" type="butt7on" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
							<a class="nav-link fa fa-home" href="index.php">Home <span class="sr-only">(current)</span></a>
						</li>
			</div>
		</nav>
		<br>
			<form class="form-inline my-2 my-lg-0">
				<div id="profile">
					<b><i><?php if(isset($_SESSION['id'])){
							}
								else{
								header("Location: login.php");
							}?></i></b>
				</div>				
			</form>
</form>
<br>
	<div class="container">
		<div class="row" style="background-color-white">
			<div class="col-8" style="borderl-style: solid;color: black;text-align: center">
				<u><h1 style=" font-family: AR DELANEY, serif;" class="display-1 font-weight-bold">REPORTS</h1></u>
			</div>
			<div class="col-4" style="background-image: url('images/t1.jpeg');background-size: contain; height: 200px;background-repeat: no-repeat;">
			
			</div>
		</div>
	<br>
		<div class="row">
			<div class="col-8">
			<form action = "search.php" method="GET" >
				
			</form>
			<form><br>
				<button type="submit" name="cancel" class="btn btn-info"><a href="CustomerOrder.php">Add Orders</a></button>
					<br/><br/>
		
			<div class="table-responsive ">
				<table class="table table-dark">
				  <thead>
					<tr>
					  <th scope="col">Order ID</th>
					  <th scope="col">Customer ID</th>
					  <th scope="col">Date</th>
					  <th scope="col">Amount</th>
					  <th scope="col">Action</th>
					</tr>
				  </thead>
				  <tbody>
								<?php
								include_once 'logindb.php';
								$id = $_SESSION['id'];
									$from = "2019-03-19";
									$to = "2019-03-19";

									

									$sql = "SELECT order_id, customer_id, timestamp, SUM(price*quantity) FROM customer_order full inner join order_item
									USING(order_id)  GROUP by order_id desc ;";
									$result = mysqli_query($conn, $sql);
									$resultCheck = mysqli_num_rows($result);
									if ($resultCheck > 0) {
										while ($row = mysqli_fetch_assoc($result)) {
										$order_id = $row["order_id"];
										$sum = $row["SUM(price*quantity)"];
										$timestamp_dt = $row["timestamp"];
										$customer_id = $row["customer_id"];
								?>



					<tr>
						  <td><?php echo $order_id?></td>
						  <td><?php echo $customer_id;?></td>
					  <td><?php echo $timestamp_dt;?></td>

					  <td>&#8369; <?php echo $sum;?></td>
					  <td> <button type ="submit" class="btn btn-primary btn-sm"><a href="checkout.php?order=<?php echo $order_id; ?>&no=<?php echo $customer_id; ?>">View</a></button></td>
					  
					</tr>
					<?php		
							}
								}
								?>
				  </tbody>
				</table>
			</div>
			</form>
			</div>
			<div class="col-4">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
							<th><h2>STATUS:</h2><th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<?php
										$con = new mysqli('localhost', 'root', '', 'onlinekusina') or die(mysqli($mysqli));
										$sql = "SELECT SUM(price * quantity) AS `total` FROM order_item";
										$query_sum = mysqli_query($con,$sql);
									?>
									<?php while($row = mysqli_fetch_array($query_sum)):?>
									<div class="dropdown">
										<label><u><b>Total Sales</b></u></label><br>
										<?php echo "&#8369; " .$row['total']. " ";?>
											
											
									</div>
									<?php endwhile;?>
								</td>
							</tr>
							<tr>
								<td>
									<?php
										$con = new mysqli('localhost', 'root', '', 'onlinekusina') or die(mysqli($mysqli));
										$sql = "SELECT COUNT(*) AS `count` FROM menu";
										$query_menu = mysqli_query($con,$sql);
									?>
									<?php while($row = mysqli_fetch_array($query_menu)):?>
									<div class="dropdown">
											<label><u><b>Number of Menus<b></u></label><br>
										<?php echo $row['count']. " Menus";?>	
											
										</div>
									</div>
										
									<?php endwhile;?>
								</td>
							</tr>
							<tr>
								<td>
									<?php
										$con = new mysqli('localhost', 'root', '', 'onlinekusina') or die(mysqli($mysqli));
										$sql = "SELECT COUNT(*) AS `count` FROM customer";
										$query_cus = mysqli_query($con,$sql);
									?>
									<?php while($row = mysqli_fetch_array($query_cus)):?>
									<div class="dropdown">				
										<label><u><b>Number of Customers</b></u></label><br>
										<?php echo $row['count']. " Customers";?>	
										</div>
									</div>
										
									<?php endwhile;?>
								</td>
							</tr>
							<tr>
								<td>
									<?php
										$con = new mysqli('localhost', 'root', '', 'onlinekusina') or die(mysqli($mysqli));
										$sql = "SELECT COUNT(*) AS `count` FROM order_item";
										$query_item = mysqli_query($con,$sql);
									?>
									<?php while($row = mysqli_fetch_array($query_item)):?>
									<div class="dropdown">
											<label><u><b>Number of Orders<b></u></label><br>
											<?php echo $row['count']. " Orders";?>
										</div>
									</div>
										
									<?php endwhile;?>
								</td>
							</tr>	
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<br/><br/>
	<br/><br/><br/><br/><br/><br/>
</body>  
</html>	