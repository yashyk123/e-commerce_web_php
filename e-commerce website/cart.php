<!-- connect file -->
<?php
include('include/connect.php');
include('function/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Website-cart details</title>
    <!--bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
    <!--font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="style.css">

    <style>
        .cart_img{
    width: 80px;
    height: 80px;
    object-fit:contain;
}
    </style>
</head>
<body>
   <!-- nav bar bg-body-tertiary -->
   <div class="container-fluid p-0"> 
   <nav class="navbar navbar-expand-lg bg-info">
  <div class="container-fluid">
    <img src="img/logo.jpg" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./user_area/user_registration.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php cart_item(); ?></sup></i></a>
        </li>   
        
      </ul>
    </div>
  </div>
</nav>


<!-- calling cart function -->
  <?php
  cart();
  ?>
<!-- Second child -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <ul class="navbar-nav me-auto">
      

        <?php
         if(!isset($_SESSION['user_name']))
         {
           echo "  <li class='nav-item'>
           <a class='nav-link' href='#'>Welcom Guest</a>
         </li>";
         }
         else
         {
           echo " <li class='nav-item'>
           <a class='nav-link' href='#'>Welcom ".$_SESSION['user_name']."</a>
         </li>";
         }
         
        if(!isset($_SESSION['user_name']))
        {
          echo " <li class='nav-item'>
          <a class='nav-link' href='./user_login.php'>Login</a>
        </li>";
        }
        else
        {
          echo " <li class='nav-item'>
          <a class='nav-link' href='logout.php'>Logout</a>
        </li>";
        }
        ?>
  </ul>
</nav>

<!-- Third child -->

<div class="bg-light">
  <h3 class="text-center">
    Welcome to Online Shopping Website!
    <p class="text-center">Communication is at the heart of e-commerse and community</p>
  </h3>
</div>

<!-- fourth child-table -->
<div class="container">
    <div class="row">
      <form action="" method="post">
        <table class="table table-bordered text-center">
         
            <tbody>
                <!-- php code to display dynamic data-->
                <?php
                    //global $con;
                    $get_ip_add = getIPAddress(); 
                    $total_price=0;
                    $cart_query="Select * from `cart_details` where ip_address='$get_ip_add'";
                    $result=mysqli_query($con,$cart_query);
                    $result_count=mysqli_num_rows( $result);
                    if($result_count>0)
                    {
                      echo "   <thead>
                      <tr>
                          <th>Product Title</th>
                          <th>Product Image</th>
                          <th>Quantity</th>
                          <th>Total Price</th>
                          <th>Remove</th>
                          <th colspan='2'>Operations</th>
                      </tr>
                  </thead>";

                   
                    while($row=mysqli_fetch_array($result))
                    {
                      $product_id=$row['product_id'];
                      $select_products="Select * from `products` where product_id='$product_id'";
                      $result_products=mysqli_query($con,$select_products);
                      while($row_product_price=mysqli_fetch_array($result_products))
                    {
                  
                      $product_price=array($row_product_price['product_price']);
                      $price_table=$row_product_price['product_price'];
                      $product_title=$row_product_price['product_title'];
                      $product_image1=$row_product_price['product_image1'];
                      $product_values=array_sum($product_price);
                      $total_price+=$product_values;
        
                ?>
                <tr>
                    <td><?php echo $product_title ?></td>
                    <td><img src="./admin_area/product_images/<?php echo  $product_image1 ?>" alt="" class="cart_img"></td>
                    <td><input type="text" name="qty" class="form-input w-50"></td>
                    <?php
                     $get_ip_add = getIPAddress();
                     if(isset($_POST['update_cart']))
                     {
                   
                    $quantities=$_POST['qty'];
                    $update_cart="update `cart_details` set quantity=$quantities where ip_address='$get_ip_add'";
                    $result_products_quantity=mysqli_query($con,$update_cart);
                    $total_price=$total_price*$quantities;
                     }
                    ?>
                    <td><?php echo $price_table ?>/-</td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>" id=""></td>
                    <td>
                        <!-- <button class="bg-info px-3 py-2 border-0 mx-3">Update</button>-->
                        <input type="submit" value="Update Cart" class="bg-info px-3 py-2 border-0 mx-3" name="update_cart">
                        <!--<button class="bg-info px-3 py-2 border-0 mx-3">Remove</button>-->
                        <input type="submit" value="Remove Cart" class="bg-info px-3 py-2 border-0 mx-3" name="remove_cart">
                    </td>
                </tr>
                
                <?php
                    }
                }
              }

              else
              {
                echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
              }
                ?>
            </tbody>
        </table>

        <!-- subtotal  -->
        <div class="d-flex mb-5">
          <?php
            $get_ip_add = getIPAddress(); 
            $cart_query="Select * from `cart_details` where ip_address='$get_ip_add'";
            $result=mysqli_query($con,$cart_query);
            $result_count=mysqli_num_rows( $result);
            if($result_count>0)
            {
              echo "<h4 class='px-3'>Subtotal:<strong class='text-info'> $total_price/-</strong></h4>
              <input type='submit' value='Continue Shoping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shoping'>
              <button class='bg-secondary px-3 py-2 border-0'><a href='./user_area/checkout.php' class='text-light text-decoration-none'>Checkout</a></button>";
            }
            else{
              echo "<input type='submit' value='Continue Shoping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shoping'>";
            }

            if(isset($_POST['continue_shoping']))
            {
              echo "<script>window.open('index.php','_self')</script>";
            }
          ?>

      

        </div>
    </div>
</div>
</form>


<!-- fuction to remove items -->
<?php
function remove_cart_item()
{
  global $con;
  if(isset($_POST['remove_cart']))
  {
    foreach($_POST['removeitem'] as $remove_id)
    {
      echo $remove_id;
      $delete_query="DELETE FROM `cart_details` WHERE product_id=$remove_id";
      $run_delete=mysqli_query($con,$delete_query);
      if($run_delete)
      {
        echo "<script>window.open('cart.php','_self')</script>";
      }
    }
  }
}

echo $remove_item=remove_cart_item(); // Call the function directly, no need for assignment or echoing
?>


<!-- last child -->



<!-- include footer -->
<?php
include("./include/footer.php");
?>

   </div> 

    <!--bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>