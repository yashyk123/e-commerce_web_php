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
    <title>E-commerce Website </title>
    <!--bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
    <!--font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="style.css">

    <style>
        body{
            overflow-x: hidden;
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

        <?php
          if(isset($_SESSION['user_name']))
          {
            echo "  <li class='nav-item'>
            <a class='nav-link' href='./user_area/profile.php'>My Account</a>
          </li>";
          }
          else
          {
            echo "<li class='nav-item'>
          <a class='nav-link' href=''./user_area/user_registration.php'>Register</a>
        </li>";
          }

        ?>
        <li class="nav-item">
          <a class="nav-link" href="./user_area/user_registration.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php cart_item(); ?></sup></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price: <?php total_cart_price();?>/- </a>
        </li>
        
        
      </ul>
      <form class="d-flex" action="search_product.php" method="get" >
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
        <!--<button class="btn btn-outline-light" type="submit">Search</button>-->
        <input type="submit" value="search" class="btn btn-outline-light" name="search_data_product">
      </form>
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
          <a class='nav-link' href='./user_area/user_login.php'>Login</a>
        </li>";
        }
        else
        {
          echo " <li class='nav-item'>
          <a class='nav-link' href='./user_area/logout.php'>Logout</a>
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

<!-- fourth child -->
<div class="row px-1">
  <div class="col-md-10">
    <!-- Products-->
     <div class="row">

     <!--fetching  Products-->
    
     <?php
     /* calling function*/
     getproduct();
     get_unique_catagories();
     get_unique_brands();
     //$ip = getIPAddress();  
     //echo 'User Real IP Address - '.$ip; 
    ?>
    
    </div>

<!-- row end-->
</div>
<!-- col end-->

  <div class="col-md-2 bg-secondary p-0">
    <!-- Brands to be displayed-->
    <ul class="navbar-nav me-auto text-center">
      <li class="nav-item bg-info">
        <a href="#" class="nav-link text-light"><h4>Delivery Brands</h4></a>
      </li>

      <?php
       getbrands();
       
      ?>



    </ul>
   
    <!-- Categories to be displayed-->
    <ul class="navbar-nav me-auto text-center">
      <li class="nav-item bg-info">
        <a href="#" class="nav-link text-light"><h4>Categories</h4></a>
      </li>

      <?php
      getcategories();
      ?>


    </ul>
  </div>
</div>


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