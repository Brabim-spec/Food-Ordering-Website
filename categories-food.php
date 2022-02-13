<?php include('partials-front/menu.php') ?>

<?php
	// Checking if the Id is passed or not
	if(isset($_GET['category_id']))
	{
		// Category Id is set and get the id
		$category_id=$_GET['category_id'];

		// Get the category title based on the Category ID
		$sql = "SELECT title FROM tbl_category WHERE id=$category_id";

		// Executing the Query
		$res=mysqli_query($conn,$sql);

		// Getting the Value from the database
		$row=mysqli_fetch_assoc($res);

		// Getting the Title
		$category_title = $row['title'];
	}
	else
	{
		// Category is not Passed
		// Redirected to the Homepage
		header('location:'.SITEURL);
	}
?>

<!--Food Search Starts -->
	<section class="food-search text-center">
		<div class="container">
			<h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>
		</div>
	</section>
<!--Food Search Ends-->

<section class="food-menu">
		<div class="container">
			<h2 class="text-center">Food Menu</h2>

			<?php
				// Creating SQL to get food from the Database based on Category
				$sql2 = "SELECT * FROM lbl_food WHERE category_id=$category_id";

				// Execute the Query
				$res2 = mysqli_query($conn,$sql2);

				// Count the Rows
				$count2 = mysqli_fetch_assoc($res2);

				// Check weather the food is available or not
				if($count2>0)
				{
					// Food is Available
					while($row2=mysqli_fetch_assoc($res2))
					{
						$id = $row2['id'];
						$title = $row2['title'];
						$price = $row2['price'];
						$description = $row2['description'];
						$image_name = $row2['image_name'];
						?>

						<div class="food-menu-box">
							<div class="food-menu-img">
								<?php 
									if($image_name==""){
										// Image is not available
										echo"<div class='error'> Image is Not Available </div>";
									}
									else{
										// Image is Available
										?>
										<img src="<?php echo SITEURL; ?>images/food/<?php $image_name; ?>" class="img-responsive img-curve">
										<?php
									}
								?>
							</div>

							<div class="food-menu-desc">
								<h4><?php echo $title; ?></h4>
								<p class="food-price">Rs. <?php echo $price; ?></p>
								<p class="food-detail"><?php $description; ?></p>
								<br>
								<a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order now</a>
							</div>
						</div>

						<?php
					}
				}
			?>

			<div class="clearfix"></div>
		</div>
	</section>
<?php include('partials-front/footer.php') ?>