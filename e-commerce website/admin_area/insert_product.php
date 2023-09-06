<?php
include('../include/connect.php');
if(isset($_POST['insert_product'])){

    $product_title = $_POST['product_title'];
    $discription = $_POST['discription']; // Changed 'discription' to 'description'
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';

    // accessing images

    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    // accessing image tmp name
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    // checking empty condition
    if($product_title == '' || $discription == '' || $product_keywords == '' || $product_category == '' || 
       $product_brands == '' || $product_price == '' || $product_image1 == '' || 
       $product_image2 == '' || $product_image3 == ''){
        echo "<script>alert('Please fill all the available fields')</script>";
        exit();
    } else {
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");

        //insert query

        $insert_products = "INSERT INTO `products` (product_title, product_discription, 
        product_keywords, category_id, brand_id, product_image1, product_image2, product_image3, 
        product_price, Date, status) VALUES ('$product_title', '$discription', '$product_keywords', '$product_category',
        '$product_brands', '$product_image1', '$product_image2', '$product_image3', '$product_price', NOW(), '$product_status')";
        
        $result_query = mysqli_query($con, $insert_products);
        if($result_query){
            echo "<script>alert('Successfully inserted')</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product-Admin Dashboard</title>

<!-- Bootstrap css link -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

<!--font awesome link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- css file -->
<link rel="stylesheet" href="../style.css">
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Product</h1>

        <!--form -->
        <form action="" method="post" enctype="multipart/form-data">

        <!--Title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required="required">
            </div>

        <!-- discription -->

        <div class="form-outline mb-4 w-50 m-auto">
                <label for="discription " class="form-label">Product discription </label>
                <input type="text" name="discription" id="discription" class="form-control" placeholder="Enter product discription " autocomplete="off" required="required">
            </div>

        <!-- Keywords -->
        <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords " class="form-label">Product keywords </label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords" autocomplete="off" required="required">
        </div>

        <!-- Categories -->
        <div class="form-outline mb-4 w-50 m-auto">
            <select name="product_category" id="" class="form-select">
                <option value="">Select a category</option>

                <?php
                $select_query="Select * from `categories`";
                $reult_query=mysqli_query($con,$select_query);
                while ($row = mysqli_fetch_assoc( $reult_query)) {
                    $category_title=$row['category_title'];
                    $category_id=$row['category_id'];
                    echo "<option value='$category_id'>$category_title</option>";
                }
                ?>
        
            </select>
        </div>

        <!-- Brands -->
        <div class="form-outline mb-4 w-50 m-auto">
            <select name="product_brands" id="" class="form-select">
                <option value="">Select a Brands</option>

                <?php
                $select_query="Select * from `brand`";
                $reult_query=mysqli_query($con,$select_query);
                while ($row = mysqli_fetch_assoc( $reult_query)) {
                    $brand_title=$row['brand_title'];
                    $brand_id=$row['brand_id'];
                    echo "<option value='$brand_id'>$brand_title</option>";
                }
                ?>
            
            </select>
        </div>

         <!-- Image1 -->
         <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1 " class="form-label">Product Image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" placeholder="Enter product image" autocomplete="off" required="required">
            </div>

          <!-- Image2 -->
          <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Product Image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control" placeholder="Enter product image" autocomplete="off" required="required">
            </div>

          <!-- Image3 -->
          <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3 " class="form-label">Product Image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control" placeholder="Enter product image" autocomplete="off" required="required">
            </div>

             <!-- price -->
        <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price " class="form-label">Product price </label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product keywords" autocomplete="off" required="required">
            </div>

             <!-- Submit button -->
             <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert Products">
             </div>
        </form>
    </div>
</body>
</html>