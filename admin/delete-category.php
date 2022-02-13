<?php
include('../config/constants.php'); 

// check whether the id and image_name value is set or not
if(isset($_GET['id']) && isset($_GET['image_name']))
 {
	// get the value and delete
	$id=$_GET['id'];
	$image_name=$_GET['image_name'];

	// remove the phyhsical image file if available

	if($image_name !="")
	{
		// image is available
		$path ="../images/category/".$image_name;

		// remove the image

		$remove = unlink($path);

		// if failed to remove image then add an error message and stop the process
		if($remove==false)
		{
			// set the session message then redirect to manage-category page and then stop the process
			$_SESSION['remove'] = "<div class='error'>Failed To Remove Category Image.</div>";
			header('locattin:'.SITEURL.'admin/manage-category.php');
			die();
		}


	}
	// delete data from datbase redirect to manage category page with message

	// sql query delete data from database
	$sql="DELETE FROM tbl_category WHERE id=$id";

	// execute query

	$res=mysqli_query($conn,$sql);

	// check whether the data is deleted from database or not

	if ($res==true)
	 {
			// set success message and redirect 
	 	$_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
	 	header('location:'.SITEURL.'admin/manage-category.php');
	
	  }

	  else
	  {
	  	// set failed message and redirect
	  	$_SESSION['delete'] = "<div class='error'>Category Deleted Failed</div>";
	 	header('location:'.SITEURL.'admin/manage-category.php');
	  }

  }

else
{
	// redirect to manage-category page
	header('location:'.SITEURL.'admin/manage-category.php');

}

?>