<?php
echo "<pre>";
print_r($_POST);

if(isset($_POST["btn"])) {
    function save_category($data) {
        $host_name="localhost";
        $user_name="root";
        $password="";
        $db_name="db_student";
        $connection=mysqli_connect($host_name, $user_name, $password);
        if($connection){
           $db_select=mysqli_select_db($connection,$db_name);
           if($db_select){
           }else {
               die("Database selection failed".mysqli_error($connection));
           }
        } else {
            die("Database Connection Failed".mysqli_error($connection));
        }
        
       $sql = "INSERT INTO tbl_catagory(category_name,category_description,publication_status) VALUES ('$data[category_name]', '$data[category_description]', '$data[publication_status]')";
       if (mysqli_query($connection, $sql)) {
         $message="category info save successfully";
         return $message;
       } else {
           die("Query Problem".mysqli_error($connection));
       }
    }
    $message=save_category($_POST);
}






?>

<hr/>
<a href="add_category.php">Add Category</a>
<a href="view_category.php">View Category</a>
<hr/>

<form action="" method="post">
    <h1><?php if(isset($message)) {echo $message;}?><h1/>
        
        
    <table>
        <tr>
            <td>Category Name</td>
            <td><input type="text" name="category_name"></td>
        </tr>
        <tr>
            <td>Category Description</td>
            <td><textarea name="category_description" rows="7" cols="0"></textarea></td>
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
            <td><input type="submit" name="btn" value="Save Category"></td>
        </tr>
    </table>
</form>

