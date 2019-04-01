<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link href="css/style.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="style1.css">
		<script type="text/javascript" src="bootstrap/js/jquery-slim.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>  
	</head>
<body>
		<form action="logout.php" method="POST">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
  <img style="width: 9%;height: 80px;"  src="images/logo.jpg" />
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
   <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link fa fa-home" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link fa fa-eye" href="customerview.php">Customer <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link fa fa-eye" href="menuview.php">Menu <span class="sr-only">(current)</span></a>
      </li> 
	  <li class="nav-item active">
        <a class="nav-link fa fa-eye" href="orderviewcus.php">Order <span class="sr-only">(current)</span></a>
      </li> 
	  <li class="nav-item active">
        <a class="nav-link fa fa-eye" href="view.php">Reports<span class="sr-only">(current)</span></a>
      </li> 
	  <li class="nav-item active">
        <a class="nav-link fa fa-plus" href="changepassword.php">Change Password <span class="sr-only">(current)</span></a>
      </li>

	  
    </ul>
				
		<form class="form-inline">
			&nbsp;&nbsp;&nbsp;&nbsp;
			<div class="desc"><b id="logout"><a href="logout.php">Log Out</a></b></div>
		</form>
		</form>
	</div>
</nav>
			<form class="form-inline my-2 my-lg-0">
				<div id="profile">
					<b><i><?php if(isset($_SESSION['id'])){
									echo ($_SESSION['username']);
								}
								else{
								header("Location: login.php");
							}?></i></b>
				</div>
				
			</form>
		</nav>
		<div class="row" style="background-color:#2F4F4F">
			<div class="col-8" style="borderl-style: solid;color: #00FF00;text-align: center">
			
				<h1 style=" font-family: AR DELANEY, serif;" class="display-1 font-weight-bold">REPORTS</h1>
			</div>
			<div class="col-4" style="background-image: url('images/t1.jpeg');background-size: contain; height: 200px;background-repeat: no-repeat;">
			
			</div>
		</div>
		<div class="row">
			<div class="col-8">
			<form action = "search.php" method="GET" >
				<div class="row">
					<div class="col-1">
						<p>FROM: </p>
					</div>
					<div class="col-3">
						<input type="datetime-local" class="form-control" name="startdate" style="width: 195px;" required>
					</div>
					<div class="col-1">
						<p>TO: </p>
					</div>
					<div class="col-3">
						<input type="datetime-local" class="form-control" name="enddate" style="width: 192px;" required>
					</div>
					<button type="submit" class="btn btn-primary"> Submit</button>
					<button class="btn btn-light"><a href="order_reports.php"> Reset</a></button>
				</div>
			</form>
			<form><br>
				<button type="submit" name="cancel" class="btn btn-light"><a href="addorder.php"><i class="fas fa-plus-circle    "></i>Add Menu Orders</a></button>
					<br/><br/>
		
			<div class="table-responsive">
				<table class="table">
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
										$timestamp = $row["timestamp"];
										$customer_id = $row["customer_id"];
								?>



					<tr>
						  <td><?php echo $order_id?></td>
						  <td><?php echo $customer_id;?></td>
					  <td><?php echo $timestamp;?></td>

					  <td>&#8369; <?php echo $sum;?></td>
					  <td> <button class="btn btn-light btn-sm"><a href="viewcheckoutsummary.php?order=<?php echo $order_id; ?>&no=<?php echo $customer_id; ?>">View</a></button></td>
					  
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
							<th>STATUS<th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<?php
										$con = new mysqli('localhost', 'root', '', 'kusina1') or die(mysqli($mysqli));
										$sql = "SELECT SUM(price * quantity) AS `total` FROM order_items";
										$query_sum = mysqli_query($con,$sql);
									?>
									<?php while($row = mysqli_fetch_array($query_sum)):?>
									<div class="dropdown">
										<?php echo "&#8369; " .$row['total']. " Total Sales";?>
										<div class="dropdown-content">	
											<a href="order.php?order=''&hide=''">View Sales</a>
										</div>
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
										<?php echo $row['count']. " Menus";?>
										<div class="dropdown-content">	
											<a href="menuview.php">View Menu</a>
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
										<?php echo $row['count']. " Customers";?>
										<div class="dropdown-content">	
											<a href="customerview.php">View Customers</a>
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
										$query_items = mysqli_query($con,$sql);
									?>
									<?php while($row = mysqli_fetch_array($query_item)):?>
									<div class="dropdown">
										<?php echo $row['count']. " Orders";?>
										<div class="dropdown-content">	
											<a href="customerview.php">View Orders</a>
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
	<br/><br/>
	<br/><br/><br/><br/><br/><br/>
</body>  
</html>	