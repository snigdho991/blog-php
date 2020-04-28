<?php include 'inc/header.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>

<?php
    if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
        echo "<script>window.location = 'catlist.php';</script>";
        //header("Location:catlist.php");<!--error-->
    } else {
        $id = $_GET['catid'];
    }
?>

<div class="grid_10">		
    <div class="box round first grid">
        <h2>Update Category</h2>
       <div class="block copyblock"> 
<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'];
        $name = mysqli_real_escape_string($db->link, $name);
        if(empty($name)){
            echo "<span class='errad'>Category Name Must Not Be Empty !</span>";
        } else {
            $query = "UPDATE tbl_category
                        SET name = '$name'
                        WHERE id = '$id'";
            $catupdate = $db->update($query);
            if($catupdate){
               echo "<span class='sucad'>Category Updated Successfully !</span>"; 
            } else {
                echo "<span class='errad'>Category Isn't Updated. Try Again !</span>";
            }
        }
    }
?>

<?php
    $query = "SELECT * FROM tbl_category WHERE id = '$id' ORDER BY id DESC";
    $category = $db->select($query);
    if($category){
        while ($result = $category->fetch_assoc()) {
?>
         <form action="" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                    </td>
                </tr>
				<tr> 
                    <td>
                        <input type="submit" name="submit" Value="Edit" />
                    </td>
                </tr>
            </table>
            </form>
<?php } } else {
    echo "<script>window.location = 'catlist.php';</script>";
} ?>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>