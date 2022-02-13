<?php include('partials-front/menu.php')?>

<!--Food Search Starts -->
	<section class="food-search text-center">
		<div class="container">
			
			<form action="<?php echo SITEURL; ?>food-search.php" method="POST">
				<input type="search" name="search" placeholder="Search for desired Food !!!" required>
				<input type="submit" name="submit" value="Search" class="btn btn-primary">
			</form>


		</div>
	</section>
<!--Food Search Ends-->

<section class="food-menu">
		<div class="container">
			<h2 class="text-center">Food Menu</h2>
			
			<?php
				// display featured food
				$sql="SELECT * FROM lbl_food WHERE featured='Yes'";
 
				// Execute Query
				$res = mysqli_query($conn,$sql);

				// Count Rows
				$count = mysqli_num_rows($res);

				// check weather the foods are available or not
				if($count>0)
				{	
					// foods available
					while($row=mysqli_fetch_assoc($res))
					{
						// get values
						$id=$row['id'];
                        $title=$row['title'];
                        $description=$row['description'];
						$price=$row['price'];
                        $image_name=$row ['image_name'];
						?>

							<div class="food-menu-box">
								<div class="food-menu-img">
									<?php
										// Check if the image is available of not
										if($image_name=="")
										{
											// Image is not available
											echo"<div class='error'>Image not Available at the Moment</div>";
										}
										else
										{	
											// Image Available
											?>
											<img src="<?php echo SITEURL; ?>images/food<?php echo $image_name; ?>" class="img-responsive img-curve">
											<?php
										}
										?>
								</div>
								<div class="food-menu-desc">
									<h4><?php echo $title; ?></h4>
									<p class="food-price"><?php echo $price; ?></p>
									<p class="food-detail"><?php echo $description; ?></p>
									<br>
									<a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order now</a>
								</div>
							</div>
						<?php
					}
				}
				else{
					//  Food not available
					echo"<div class='error'>Food not Available at the Moment</div>";
				}
			?> 
			
			<div class="clearfix"></div>
		</div>
	</section>
	<?php include('partials-front/footer.php')?>