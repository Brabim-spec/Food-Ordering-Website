<?php include('partials-front/menu.php')?>

<?php 
    // Check weather the food id is set or not
    if(isset($_GET['food_id'])){
        // Get the food id and it's details of the selected food
        $food_id = $_GET['food_id'];

        //  Get the food  details of the selected food
        $sql = "SELECT * FROM lbl_food WHERE id = $food_id";

        // Execute the QUery
        $res = mysqli_query($conn, $sql);

        // Count the Rows
        $count = mysqli_num_rows($res); 
        
        // Check weather the data is available or not
        if($count == 1){

            // We have the Data
            // Get the Data From the Database
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];


        }
        else{
            // Food is not Available
            // Redirect to Home
            header('location:'.SITEURL);
        }
    }
    else{
        // Redirect Message
        echo('location:'.SITEURL);
    }
?> 
<!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                            // Check weather the Food is available or not
                            if($image_name==""){
                                // Image is Not available
                                echo"<div class='error'>Image not Available.</div>";
                            }
                            else{
                                // Image is Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                    ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <!-- Passing Value in Hidden Form of Title and Food -->
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">Rs.<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder=" E.g. Brabim Maharjan" class="input-responsive" required>
                            
                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder=" E.g. 9841xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder=" E.g. Someone@gmail.com"  class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder=" E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php
            // Check weather the Submit button is clicked or not
            if(isset($_POST['submit'])){

                // Get the Details from the Form
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty']; 
                $total = $price  * $qty; // total = price * qty
                $order_date = date("Y-m-d h:i:sa"); // Order Date
                $status = "Ordered"; // Ordered on Delivery, Delivered, Canceled
                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email']; 
                $customer_address = $_POST['address'];

                // Save the order in the Database
                // Create SQL to save the Data

                $sql2 = "INSERT INTO tbl_order SET
                    food = '$food',
                    price = '$price',
                    qty = '$qty',
                    total = '$total',
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'    
                    ";
             
                // Executing the Query
                $res2 = mysqli_query($conn,$sql2);

                // Check weather the Query is executed or not
                if($res2==true){
                    // Query Executed and order is saved
                    $_SESSION['order'] = "<div class='success text-center'>Food is Orderes Sucessfully.</div>";
                    header('location:'.SITEURL);
                }
                else{
                    // Failed to save the order
                    $_SESSION['order'] = "<div class='error text-center'>Failed to save Order.</div>";
                    header('location:'.SITEURL);
                }

            }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


<?php include('partials-front/footer.php')?>