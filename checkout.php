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
		<div class="row">
			<div class="col-8">
			<h1><b>View Orders</b></h1><br>
			<?php
				$order_id = $_GET['order'];
				$customer_id = $_GET['no'];
			?>
				
				Order ID : <b><?php echo $order_id; ?></b><br>
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
				
				Customer Name : <b><?php echo $row["first_name"]; ?></b>
							
							
							
							
							<?php		}
				
							}
							?>
							<button style="float:right" class="btn btn-light"><a href="orderviewcus.php"> Back </a></button>
							<br><br>
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
						<b><h1>TOTAL  </h1><h1>&#8369; <?php echo $total;?>.00</h1></b><center>
					</div>
				</div>
			</div>
		</div>
		


	
</body>
</html>