<?php
 include('../config/constants.php'); 
  if(isset($_GET['id']) && isset($_GET['image_name']))
   {
	// process to delete
	 //1.get Id and Image name 
   	$id = $_GET['id'];
   	$image_name = $_GET['image_name'];

   	// 2. Remove the image if available 
    // check whether the image is availabel or not and delete only if available 
     if($image_name!=""){
     	// it has iamge and need to remove from folder
     	//get the image path
     	$path = "../images/food/".$image_name;

     	//remove image file from folder 
     	$remove = unlink($path);

     	// check whether image is removed or not 

     	if($remove==false){
     		//failed to remove image 
     		$_SESSION['upload'] = "<div class='error'>Failed to remove Image File.</div>";
     		//redirect to manage food 
     		header('location:'.SITEURL.'admin/manage-food.php');
     		//stop the process of deleting food 
     		die();
     	}
     }
   	// 3. Delete food from database 

       $sql = "DELETE FROM lbl_food WHERE id=$id";
       //execute the query 
       $res = mysqli_query($conn,$sql);

        // Check whether tthe query executed or not and set the  session message respectively 
       	// 4. redirect to manage food with session message
       if($res==true){
       	 //food deleted
       	  $_SESSION['delete'] = "<div class='success'>Food Deleted SUccessfully.</div>";
       	  header('location:'.SITEURL.'admin/manage-food.php');
       }
       else{

       	 // failed to dleete the food
       	  $_SESSION['delete'] = "<div class='error'>Failed to delete Food.</div>";
       	  header('location:'.SITEURL.'admin/manage-food.php');
       }

   
	
   }
  else
  {
	// redirect to manage Food page 

	$_SESSION['unauthorized']= "<div class='error' > Unauthorized Access.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
  }

?>