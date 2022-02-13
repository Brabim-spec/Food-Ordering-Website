<?php
  include('partials/menu.php');
?>
   <div class="main-content">
      <div class="wrapper">
        <h1>Add Food</h1>
         <br><br>
          <?php
              if(isset($_SESSION['upload'])){
              	echo $_SESSION['upload'];
              	unset($_SESSION['upload']);
              }
          ?>

         <form action="" method="POST" enctype="multipart/form-data">
         	<table class="tbl-30">
         		
               <tr>
               	 <td>Title:</td>
                 <td>
                 	<input type="text" name="title" placeholder="Title of the Food.">
                 </td>
               </tr>
               <tr>
               	<td>Description:</td>
               	<td>
               		<textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
               	</td>
               </tr>
               <tr>
               	<td>Price:</td>
               	 <td>
                 	<input type="number" name="price">
                 </td>
               </tr>
               <tr>
               	<td>Select Image:</td>
               	<td>
               		<input type="file" name="image">
               	</td>
               </tr>
               <tr>
               	<td>Category:</td>
               	<td>
               		<select name="category">
                        <?php 
                        //create PHP code to display categories from database
                        //1. create sql to get all active categories from database
                          $sql = "SELECT * FROM tbl_category WHERE active='yes'";
                          // Exceuting the query 
                          $res = mysqli_query($conn,$sql);

                          // count rows to check whether we have categories or not
                          $count= mysqli_num_rows($res);
                          //if count is greater than 0, we have categories else we donot have categories 
                          if($count>0){

                          	//we have categories
                            while ($row=mysqli_fetch_assoc($res)) {
                                //get the details of the categories 
                                $id = $row['id'];
                                $title = $row['title'];                          

                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php 
                            }
                          }
                          else{
                          	//dont have categories
                          	?>
                          	<option value="0">No Category Found</option>
                          	<?php
                          }
                        //2. Display on Dropdown
                        ?>
               			
               		</select>
               	</td>
               </tr>
                <tr>
               	<td>Featured:</td>
               	<td>
               		<input type="radio" name="featured" value="Yes">Yes
               		<input type="radio" name="featured" value="No">No
               	</td>
               </tr>
               <tr>
               	<td>Active:</td>
               	<td>
               		<input type="radio" name="Active" value="Yes">Yes
               		<input type="radio" name="Active" value="No">No
               	</td>
               </tr>
               <tr>
               	<td colspan="2">
               		<input type="submit" name="submit" value="Add Food" class="btn-secondary">
               	</td>
               	
               </tr>
         	</table>
         </form>

         <?php
            //check wheteher the button is clicked or not 
            if(isset($_POST['submit']))
            {
            	// add food to database
            	//1. get the data from form and than 
                 $title = $_POST['title'];
                 $description = $_POST['description'];
                 $price = $_POST['price'];
                 $category = $_POST['category'];

                 // check whether radio button for featured and active are checked or not
                 if(isset($_POST['featured']))
                 {
                   $featured = $_POST['featured'];
                 }
                 else{
                 	$featured = "no"; //Setting the Default Value
                 }

                 if(isset($_POST['active']))
                 {
                   $active = $_POST['active'];
                 }
                 else{
                 	$active = "no"; //Setting the Default Value
                 }
            	//2. upload the image if selected
                //check whteher the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                 {
                 	//get the details of the selected image 
                   $image_name = $_FILES['image']['name'];

                   //check whthere the image is sleected or not and upload image only if selected
                   if($image_name!=""){
                   	//image is selected
                   	//a.rename the image 
                   	//get the extension of selected image which is like jpg, png , gif etc
                   	 $ext = end(explode('.', $image_name));
                   	 // create new name for image 
                   	 $image_name = "Food-name-".rand(0000,9999).".".$ext;//create new image name 
                   	//b.upload  the image
                   	 //get the source path and destination path 
                   	 //source path is the current location of the image 
                   	 $src = $_FILES['image']['tmp_name'];

                   	 //destination path for the image to be uploaded

                   	 $dst = "../images/food/".$image_name;

                   	 // finally upload food image 

                   	 $upload = move_uploaded_file($src,$dst);

                   	 //check whether inage uploaded or not

                   	  if($upload==false){
                   	  	 //failed to upload the image b
                   	  	// redirect to add food page with error message 
                   	  	$_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                   	  	header('loaction:'.SITEURL.'admin/add-food.php');
                   	  	//Stop th process
                   	  	die();
                   	  }
                   }
                 }
                 else{
                 	$image_name = ""; //Setting the Default Value as blank 
                 }
            	//3. insert into database

                 //create sql queery to save or add food 
                 //for numerical value do not need to pass value inside quotes='' but for string value add quotes=''
                 $sql2 = "INSERT INTO lbl_food SET 
                  title = '$title',
                  description = '$description',
                  price = $price,
                  image_name = '$image_name',
                  category_id = $category,
                  featured = '$featured',
                  active = '$active'
                 ";

                 //exceute the query 
                 $res2 =mysqli_query($conn, $sql2);

                 // check whethere the data inserted or not 
                 //4. redirect with message to manage food page
                 if($res2 == true){
                 	// data inserted successfully 

                 	$_SESSION['add']="<div class='success'>Food Added Successfully.</div>";
                 	header('location:'.SITEURL.'admin/manage-food.php');
                 }
                 else{

                 	//failed to insert the data
                 	$_SESSION['add']="<div class='error'>Failed to add Food.</div>";
                 	header('location:'.SITEURL.'admin/manage-food.php');
                 }
            }    
         ?>
      </div>

   </div>
<?php
  include('partials/footer.php');
?>
