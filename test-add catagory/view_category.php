<?php

function select_all_category_info() {
    $host_name = "localhost";
    $user_name = "root";
    $password = "";
    $db_name = "db_student";
    $connection = mysqli_connect($host_name, $user_name, $password);
    if ($connection) {
        $db_select = mysqli_select_db($connection, $db_name);
        if ($db_select) {
            
        } else {
            die("Database Selection Failed" . mysqli_error($connection, $db_name));
        }
    } else {
        die("Database Conncetion Failed" . mysqli_error($connection));
    }

    $sql = "SELECT * FROM tbl_catagory";
    if (mysqli_query($connection, $sql)) {
        $resource_id = mysqli_query($connection, $sql);
        return $resource_id;
    } else {
        die("Query problem" . mysqli_error($connection));
    }
}

$result = select_all_category_info();
?>

<hr/>
<a href="add_category.php">Add Category</a>
<a href="view_category.php">View Category</a>
<hr/>


<table border="1" width="90%" height="350px" align="center">
    <tr style="background-color: green; color:white;">
        <th>Category Name</th>
        <th>Category Description</th>
        <th>Publication Status</th>
        <th>Action</th>
    </tr>
<?php while($category_info = mysqli_fetch_assoc($result)) { ?>
    <tr style="background-color: honeydew">
        <td><?php echo $category_info["category_name"];?></td>
        <td><?php echo $category_info["category_description"];?></td>
        <td>
            <?php
            if ($category_info["publication_status"]==1){
                echo "Published";
            } else {
                echo "Unpublished";
            }
            ?>
        </td>
        <td>
            <a href="edit_category.php?category_id=<?php echo $category_info['category_id'];?>">Edit</a>
            <a href="#">Delete</a>
        </td>
    </tr>
<?php } ?>
</table>
