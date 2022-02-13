	<?php include('partials-front/menu.php') ?>

<!--Food Search Starts -->
	<section class="food-search text-center">
		<div class="container">
			<?php 
				// Getting the Search Keyword here
				$search = mysqli_real_escape_string($conn, $_POST['search']);
			?>

			<h2>Results on<a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>
		</div>
	</section>
<!--Food Search Ends-->

<!-- Start of Food Menu Section -->
<section class="food-menu">
		<div class="container">
			<h2 class="text-center">Food Menu</h2>

			<?php
				// SQL query to get foods based on search keyword
				$sql = "SELECT * FROM lbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";

				// Execute the Queries
				$res = mysqli_query($conn,$sql);

				// Count the Numebr of Rows
				$count=mysqli_num_rows($res);

				// Check weather the Food is available or not
				if($count>0)
				{
					// Food is Available
					while($row=mysqli_fetch_assoc($res))
					{
						// Getting the Details
						$id=$row['id'];
						$title=$row['title'];	
						$price=$row['price'];
						$description=$row['description'];
						$image_name=$row['image_name'];
						?>
							<div class="food-menu-box">
								<div class="food-menu-img">
								<?php 
									// Check weather the image is availabe or not
									if($image_name=="")
									{
										// Image is not available
										echo "<div class='error'> Image is not Available at the Moment</div>";
									}
									else{
										// image available
										?>
										<img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
										<?php	
									}
									?>
								</div>
								<div class="food-menu-desc">
									<h4><?php echo $title; ?></h4>
									<p class="food-price">Rs. <?php echo $price; ?></p>
									<p class="food-detail"><?php echo $description; ?></p>
									<br>
									<a href="" class="btn btn-primary">Order now</a>
								</div>
							</div>
						<?php
					}
				}
				else{
						echo"<div class ='error'>Food not Found</div>";
				}
			?>
		<div class="clearfix"></div>
		</div>
	</section>
		<?php include('partials-front/footer.php') ?>