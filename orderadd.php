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
<br>
			<div class="container">
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
   <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link fa fa-eye" href="orderviewcus.php"> Reports <span class="sr-only">(current)</span></a>
				</li> 
				<li id="profile">
					<b><i><?php if(isset($_SESSION['id'])){
	
								}
								else{
								header("Location: login.php");
							}?></i></b>
				</li>
			</ul>
	</div>
</nav>
<br><br>
	<div class="row">
	<div class="col-6">
		<form action = "viewOrdersalespro.php" method="GET">
					<div class="row">
						<?php
							$order_id = $_GET['order'];
						?>
						<div class="col-3">
							<label>order_id</label>
							<input type="text" class="form-control form-control-sm" name="order_id" value="<?php echo $order_id; ?>" readonly>
						</div>
						<div class="col-3">
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
							?>		<label>customer_name</label>
								<input type="text" class="form-control form-control-sm" name="customer_id" value="<?php echo $row["first_name"]; ?>" readonly>
										
							<?php		
									}
								}
							?>
						</div>	
						
						<div class="col-3">	
									<label>Select_menu</label>
									<select id="menus" class="form-control form-control-sm" name="menu_id" required>
										<option value=""></option>
									<?php
										include_once 'logindb.php';
										$id = $_SESSION['id'];
										$sql = "SELECT * 
												FROM menu AS p 
												JOIN login_form AS r 
												WHERE p.id = $id  
												AND r.id = $id;";
										$result = mysqli_query($conn, $sql);
										$resultCheck = mysqli_num_rows($result);
										
										if ($resultCheck > 0) {
											while ($row = mysqli_fetch_assoc($result)) {
									?>
										
										<option value="<?php echo $row["menu_id"];?>" data-price="<?php echo $row['price'];?>"><?php echo $row["menu_name"];?></option>
									<?php		}
						
									}
									?>
									</select>
						</div>
						<br><br>
							<div class="row">
								<div class="col-3">
							<label>price</label>
								<input id="prices" type="number" class="form-control form-control-sm" name="price" placeholder="price" value="<?php echo $price;?>" readonly>
							</div>
					
								<div class="col-3">	
								<label>quantity</label>
							<input type="number" class="form-control form-control-sm" name="quantity" placeholder="qty" style="width: 100px;" required>
						</div>
						</div>
					</div></br>			
					<div class="row">		
						<?php $customer_id = $_GET['no']; ?>
						<div class="col-2">
							  <button type="submit" name="submit" class="btn btn-primary btn-sm">Add Menu</button>
						</div>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<div class="col-2">
							  <button class="btn btn-success btn-sm"><a href="checkoutview.php?order=<?php echo $order_id; ?>&no=<?php echo $customer_id; ?>">Done</a></button>
						</div>
								<script>
									$(document).ready(function(){
										$( "#menus" ).change(function(){
											$('#prices').val($(this).find(':selected').data('price'))
										});
									});
								</script>
					</div>
				</form>
			</div>
		<div class="col-6">
			<div class="table-responsive">
				<table class="table table-dark">
					<thead>
						<tr>
						  <th scope="col">Menu ID</th>
						  <th scope="col">Menu Name</th>
						  <th scope="col">Price</th>
						  <th scope="col">Quantity</th>
						  <th scope="col">Subtotal</th>
						  <th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
							<?php
							include_once 'logindb.php';
							$id = $_SESSION['id'];
							$order_id = $_GET['order'];
							$sql = "SELECT * FROM order_item, menu, customer_order
									WHERE order_item.menu_id = menu.menu_id
									AND customer_order.order_id = order_item.order_id
									AND customer_order.order_id ='$order_id';";
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
							<td><?php echo $row["menu_name"];?></td>
							<td>&#8369;<?php echo $row["price"];?></td>
							<td><?php echo $row["quantity"];?></td>
							<td>&#8369; <?php echo $quantityprice;?>.00</td>
							<td><a href="viewOrdersalesDel.php?id=<?php echo $row["menu_id"];?>&order_id=<?php echo $row["order_id"];?>"> Delete </a></td>
						</tr>
					<?php		
							}
						}
					?>
					</tbody>
			</table>
			</div>
		<div align="right">
			<b><h3>TOTAL  </h3><h1>&#8369;<?php echo $total;?>.00</h1></b><center>
		</div>	
		</div>
	</div>
</body>
</html>

