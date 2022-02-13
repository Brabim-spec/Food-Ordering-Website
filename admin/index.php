<?php
include('partials/menu.php');
?>

<!--Main Content Selection Starts-->
	<div class="main-content">
		<div class="wrapper">
			<h1>DASHBOARD</h1>
			<br><br>
			<?php 
		if (isset($_SESSION['login']))
		 {
			echo $_SESSION['login'];
			unset($_SESSION['login']);
		}
		 ?>

		 <br><br>
			<div class="col-4 text-center">
				<?php
					// Sql Query
					$sql="SELECT * from tbl_category";
					// Execute Query
					$res=mysqli_query($conn,$sql);
					// Count Number of Rows
					$count=mysqli_num_rows($res);
				?>
				<h1><?php echo $count; ?></h1>
				<br>
				Categories
			</div>

			<div class="col-4 text-center">
				<?php
					// Sql Query
					$sql2="SELECT * from lbl_food";
					// Execute Query
					$res2=mysqli_query($conn,$sql2);
					// Count Number of Rows
					$count2=mysqli_num_rows($res2);
				?>
				<h1><?php echo $count2; ?></h1>
				<br>
				Foods
			</div>
			<div class="col-4 text-center">
				<?php
					// Sql Query
					$sql3="SELECT * from tbl_order";
					// Execute Query
					$res3=mysqli_query($conn,$sql3);
					// Count Number of Rows
					$count3=mysqli_num_rows($res3);
				?>
				<h1><?php echo $count3; ?></h1>
				<br>
				Total Orders
			</div>
			<div class="col-4 text-center">
				<?php
					// Sql Query to get total revenue that is generated
					// Aggregate function in SQL
					$sql4="SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
					// Execute Query
					$res4=mysqli_query($conn,$sql4);
					// Get the Value
					$row4 = mysqli_fetch_assoc($res4);
					// Get the Total Revenue
					$total_revenue = $row4['Total'];
				?>
				<h1>Rs.<?php echo $total_revenue; ?></h1>
				<br>
				Revenue Generated
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<!--Main Content Selection Ends-->
	
<?php
include('partials/footer.php');
?>
	