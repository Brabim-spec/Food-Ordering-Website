<?php 
include('../config/constants.php');
 session_destroy(); //unsets $_session['user']

header('location:3307'.SITEURL.'admin/login.php');



 ?>