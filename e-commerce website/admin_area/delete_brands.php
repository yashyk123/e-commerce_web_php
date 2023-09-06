<?php
  
  if(isset($_GET['delete_brands']))
  {
    $delete_brand=$_GET['delete_brands'];
    //echo $delete_category;

    $delete_query="Delete from `brand` where brand_id=$delete_brand";
    $result=mysqli_query($con,$delete_query);
    if($result)
    {
        echo "<script>alert('Brand is been deleted successfully')</script>";
        echo "<script>window.open('./index.php?view_brands','_self')</script>";
    }
  }

?>