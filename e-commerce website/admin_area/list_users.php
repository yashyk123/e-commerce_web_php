<h3 class="text-center text-success">All Users</h3>
<table class='table table-bordered mt-5'>
    <thead>

    <?php
    $get_user="Select * from `user_table`";
    $result=mysqli_query($con,$get_user);
    $row_count=mysqli_num_rows($result);


    if($row_count==0)
    {
        echo "<h2 class='text-danger text-center mt-5'>No users yet</h2>";
    }
    else
    {
        echo " <tr>
        <th class='bg-info'>Sr.no</th>
        <th class='bg-info'>Username</th>
        <th class='bg-info'>User email</th>
        <th class='bg-info'>User Image</th>
        <th class='bg-info'>User address</th>
        <th class='bg-info'>User mobile</th>
        <th class='bg-info'>Delete</th>
        </tr>
        </thead>
        <tbody>";


        $number=0;
        while($row_data=mysqli_fetch_assoc($result))
        {
            $user_id=$row_data['user_id'];
            $user_name=$row_data['user_name'];
            $user_email=$row_data['user_email'];
            $user_image=$row_data['user_image'];
            $user_address=$row_data['user_address'];
            $user_mobile=$row_data['user_mobile'];
            $number++;
            echo "<tr>
            <td class='bg-secondary text-light'>$number</td>
            <td class='bg-secondary text-light'>$user_name</td>
            <td class='bg-secondary text-light'>$user_email</td>
            <td class='bg-secondary text-light'><img src='../user_area/user_images/$user_image' alt='$user_name' class='product_img'</td>
            <td class='bg-secondary text-light'>$user_address</td>
            <td class='bg-secondary text-light'>$user_mobile</td>
            <td class='bg-secondary text-light'><a href='' class='text-light'><i class='fa-solid fa-trash'></i></a></td>";

        }
    }


?>
       
    
    </tbody>
</table>