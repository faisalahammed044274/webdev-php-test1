<?php
$category_id = $_GET["category_id"];
echo $category_id;

function select_category_info_by_category_id($category_id) {

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
    $sql = "SELECT * FROM tbl_catagory WHERE category_id='$category_id'";
    if (mysqli_query($connection, $sql)) {
        $resourse_id = mysqli_query($connection, $sql);
        return $resourse_id;
    } else {
        die("Query Problem" . mysqli_error($connection));
    }
}

$resource_id = select_category_info_by_category_id($category_id);
$category_info = mysqli_fetch_assoc($resource_id);

if (isset($_POST["btn"])) {

    function update_catagory_info($data) {
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
        
        $sql="UPDATE tbl_catagory SET category_name='$data[category_name]',category_desccription='$data[category_description]',category_status='$data[publication_status]'";
        if(mysqli_query($connection, $sql)) {
            
        header_query("Location:view_category.php");
        
    } else {
        die('Query Problem'.mysqli_error($connection));
    }

    update_catagory_info($_POST);
}
}
?>

<hr/>
<a href="add_category.php">Add Category</a>
<a href="view_category.php">View Category</a>
<hr/>

<form action="" method="post">
    <h1><?php
if (isset($message)) {
    echo $message;
}
?><h1/>


        <table>
            <tr>
                <td>Category Name</td>
                <td>
                    <input type="text" name="category_name" value="<?php echo $category_info["category_name"]; ?>">
                    <input type="hidden" name="category_id" value="<?php echo $category_info["category_id"]; ?>">
                </td>
            </tr>
            <tr>
                <td>Category Description</td>
                <td><textarea name="category_description" rows="7" cols="0"><?php echo $category_info["category_description"]; ?></textarea></td>
            </tr>
            <tr>
                <td>Publication Status</td>
                <td>
                    <select name="publication_status">
                        <option>----Select Publication Status---</option>
                        <option value="1">Published</option>
                        <option value="0">Unpublished</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="btn" value="Update Category"></td>
            </tr>
        </table>
</form>

