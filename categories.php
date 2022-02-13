<?php include('partials-front/menu.php') ?>

	<!-- Categories Section Starts Here -->

	<section class="categories">
		<div class="container">
			<h2 class="text-center">Explore Foods</h2>

			<?php
				// Display all categories that are actice
				// SQL Query
				$sql="SELECT * FROM tbl_category WHERE active='yes'";

				// Execute Query
				$res=mysqli_query($conn,$sql);
				
				// Count Rows
				$count=mysqli_num_rows($res);

				// Check weather categories available or not
				if($count>0)
				{
					// categories Available
					while($row=mysqli_fetch_assoc($res))
					{
						// Get the Values
						$id=$row['id'];
						$title=$row['title'];
						$image_name=$row['image_name'];
						?>

						<a href="<?php echo SITEURL; ?>categories-food.php?category_id=<?php echo $id; ?>">
							<div class="box-3 float-container">

								<?php 
									if($image_name == "")
									{
										// Image Not Available
										echo"<div class='error'>Image not Found </div>";
									}
									else{
										// Image Available
										?>
										<img src="<?php echo SITEURL;  ?>images/category/<?php echo $image_name ; ?>" class="img-responsive img-curve">
										<?php
									}
								?>
								<h3 class="float-text text-white"><?php echo $title; ?></h3>
							</div>
						</a>		
						<?php
					}
				}
				else{
					// categories unavailable
					echo"<div class='error'>Category not Found </div>";
				}
			?>
			<div class="clearfix"></div>
		</div>
	</section>

	<?php include('partials-front/footer.php') ?>