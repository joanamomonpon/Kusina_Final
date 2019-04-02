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
		<form action="checkout.php" method="POST">
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
<br><br>
		<div class="container">
		<div class="row">
		<div class="col-8">
			<u><center><h1><b>Orders</b></h1></center></u>
			<br><br>
				<?php
					$order_id = $_GET['order'];
					$customer_id = $_GET['no'];			
				?>							
					<center>Order ID : <b><?php echo $order_id; ?></b></center>
					
				<?php
						include_once 'logindb.php';
							$id = $_SESSION['id'];
											
							$no = $_GET['no'];
							$sql = "SELECT * 
							FROM customer AS p 
							JOIN login_form AS r 
							WHERE p.id = $id  
							AND r.id = $id AND customer_id=$no;";
						$result = mysqli_query($conn, $sql);
						$resultCheck = mysqli_num_rows($result);				
					if ($resultCheck > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
				?>	
					<center>	Customer Name : <b><?php echo $row["first_name"]; ?></b></center>
										
				<?php		}
							
						}
						?>
					<br><br>
						<button class="btn btn-info" style="float: left"><a href="orderviewcus.php"> Finish </a></button>
						<button class="btn btn-success" style="float:right;margin-right: 10px"><a href="orderadd.php?order=<?php echo $order_id; ?>&no=<?php echo $customer_id; ?>">Edit Orders</a></button><br><br>
										
			<div class="table-responsive">		
			<table class="table table-dark">
			  <thead>
				<tr>
				  <th scope="col">Menu ID</th>
				  <th scope="col">Description</th>
				  <th scope="col">Price</th>
				   <th scope="col">Quantity</th>
				  <th scope="col">Subtotal</th>
				  
				</tr>
			  </thead>
			  <tbody>
							<?php
							include_once 'logindb.php';
							$id = $_SESSION['id'];
							$order_id = $_GET["order"];
							$sql = "SELECT * FROM order_item, menu, customer_order 
									WHERE order_item.menu_id = menu.menu_id 
									AND customer_order.order_id = order_item.order_id 
									AND customer_order.order_id = '$order_id';";
							$result = mysqli_query($conn, $sql);
							$resultCheck = mysqli_num_rows($result);
							$total=0;
							if ($resultCheck > 0) {
								while ($row = mysqli_fetch_assoc($result)) {
								$savequantity = $row["quantity"];
								$saveprice = $row["price"];	
								$quantityprice = $savequantity*$saveprice;
								$order_id = $row["order_id"];
								$total += $quantityprice;


								
							?>



				<tr>
					  <td><?php echo $row["menu_id"];?></td>
					  <td><?php echo $row["description"];?></td>
					  <td>&#8369; <?php echo $row["price"];?></td>
				  <td><center><?php echo $row["quantity"];?></center></td>
				  <td>&#8369; <?php echo $quantityprice;?>.00</td>
				  
				</tr>
				<?php		}
							
							}
							?>
			  </tbody>
			</table>
			</div>
			</div>
			<div class="col-4"></br></br></br></br></br></br>
				<div class="container">
					<div align="right">
					<u><b><h1>Total Sales</h1><h1></u>&#8369;<?php echo $total;?>.00</h1></b>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
</body>
</html>