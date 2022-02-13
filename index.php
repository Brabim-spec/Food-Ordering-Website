<?php include('partials-front/menu.php') ?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->

    <?php
        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
        ?>
          
    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                // Create SQL query to display Categories from the Database Directly 
                $sql="SELECT * FROM tbl_category WHERE active='yes' AND featured='yes' LIMIT 3";
                 // Execute the Query
                $res = mysqli_query($conn, $sql);
                // count rows to check wheather the category is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                    {
                        // Categories Available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            // Get Values like Id, Title, Image-Name
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                        
            ?>                
                <a href="<?php echo SITEURL; ?>categories-food.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                                // check if the image is available of not  ezpz
                                if($image_name=="")
                                {
                                    // Display Error Message
                                    echo"<div class='error'> Image is not Available </div>";
                                }
                                else{
                                    // Image available
                                    ?>               
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                        ?>
                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>
                <?php                
            }
        }
                    else
                    {
                        //Categories not Available
                        echo"<div class='error'> Category not added</div>";
                    }
            ?>

            <div class="clearfix"></div>
        </div>
     </section>
    <!-- Categories Section Ends Here -->


    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                    // Getting Food from the Database
                    // SQL Query
                $sql2 = "SELECT * FROM lbl_food WHERE  featured='Yes' LIMIT 6";

                // Execute Query
                $res2=mysqli_query($conn, $sql2);

                // Count Rows
                $count2=mysqli_num_rows($res2);

                // Check weather the Food is available or not
                if($count2>0)
                {
                    //food available
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        // Get all the Values
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $description=$row['description'];
                        $image_name=$row ['image_name'];
                        ?>
                        
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                        // Check weather Image is availabe or not
                                        if($image_name=="")
                                        {
                                            // Image not Available
                                            echo"<div class='error'> Image not Available</div>";
                                        }
                                        else
                                        {
                                            // Image  available
                                            ?>

                                            <img src="<?php echo SITEURL; ?>images/food<?php echo $image_name; ?>" class="img-responsive img-curve">    

                                            <?php
                                        }
                                ?>

                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">Rs. <?php echo $price; ?></p>
                             <p class="food-detail"><?php echo $description; ?></p> -
                    <br>
                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>

                        <?php
                    }
                }
                else{
                    // food not available
                    echo"<div class='error'>Food not Available at the Moment</div>";
                }
            ?>
             <div class="clearfix"></div>
        </div>

        
    </section>
    <!-- Food Menu Section Ends Here -->

    <?php include('partials-front/footer.php') ?>