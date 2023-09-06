

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
      $username=$_SESSION['user_name'];
      $get_user="Select * from `user_table` where user_name='$username'";
      $result=mysqli_query($con,$get_user);
      $row_fetch=mysqli_fetch_assoc($result);
      $user_id=$row_fetch['user_id'];
      //echo $user_id;
    ?>
<h3 class="text-success">All my Orders</h3>
<table class="table table-borderd mt-5">
    <thead>
    <tr>
        <th class="bg-info">Sr no</th>
        <th class="bg-info">Amount Due</th>
        <th class="bg-info">Total products</th>
        <th class="bg-info">Invoice number</th>
        <th class="bg-info">Date</th>
        <th class="bg-info">Comlete/Incomplete</th>
        <th class="bg-info">Status</th>
    </tr>
    </thead>
    <tbody class="bg-secondary text-light">
    <?php
$get_order_details = "SELECT * FROM `user_orders` WHERE user_id = $user_id";
$result_orders = mysqli_query($con, $get_order_details);
$number = 1;// Initialize the number outside the loop

while ($row_orders = mysqli_fetch_assoc($result_orders)) 
{
    $order_id = $row_orders['order_id'];
    $amount_due = $row_orders['amount_due'];
    $invoice_number = $row_orders['invoice_number'];
    $total_products = $row_orders['total_products'];
    $order_date = $row_orders['order_date'];
    $order_status = $row_orders['order_status'];
     


    if($order_status='pendiing')
    {
        $order_status='Incomplete';
    }
    else
    {
        $order_status='Complete';
    }
   

    echo "  <tr>
            <td>$number</td>
            <td>$amount_due</td>
            <td>$total_products</td>
            <td>$invoice_number</td>
            <td>$order_date</td>
            <td>$order_status</td>";

?>
            <?php
            if($order_status=='Complete')
            {
              echo "<td>Paid</td>";
            }
            else
            {
              echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-light'>Confirm</a></td></tr>";
            }         
        
    $number++; // Increment the number for the next iteration
 }
?>



       
    </tbody>
</table>
</body>
</html>