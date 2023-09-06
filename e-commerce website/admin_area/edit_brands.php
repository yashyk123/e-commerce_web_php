<?php 
if(isset($_GET['edit_brands']))
{
    $edit_brands=$_GET['edit_brands'];
    
    $get_brands="Select * from `brand` where brand_id=$edit_brands";
    $result=mysqli_query($con,$get_brands);
    $row=mysqli_fetch_assoc($result);
    $brand_title=$row['brand_title'];
    //echo $category_title;
}

if(isset($_POST['edit_brand']))
{
    $brand_title=$_POST['brand_title'];

    $update_query="update `brand` set brand_title='$brand_title' where brand_id=$edit_brands";
    $result_brand=mysqli_query($con,$update_query);
    if($result_brand)
    {
        echo "<script>alert('Category is been updated successfully')</script>";
        echo "<script>window.open('./index.php?view_categories.php','_self')</script>";
    }
}

?>

<div class="container mt-3">
    <h1 class="text-center">Edit Brand</h1>
    <form action="" method="post" class="text-center w-50 m-auto">
        <div class="form-outline mb-4">
            <label for="brand_title" class="form-label">Brand Title</label>
            <input type="text" name="brand_title" class="form-control" id="categoty_title" required="required" value="<?php echo $brand_title;?>">
        </div>

        <input type="submit" value="Update Brand" class="btn btn-info px-3 mb-3" name="edit_brand">
    </form>
</div>