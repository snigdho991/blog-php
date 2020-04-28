<?php include 'inc/header.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>

<div class="grid_10">		
    <div class="box round first grid">
        <h2>Add New Category</h2>
       <div class="block copyblock"> 
<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'];
        $name = mysqli_real_escape_string($db->link, $name);
        if(empty($name)){
            echo "<span class='errad'>Category Name Must Not Be Empty !</span>";
        } else {
            $query = "INSERT INTO tbl_category(name) VALUES('$name')";
            $catinsert = $db->insert($query);
            if($catinsert){
               echo "<span class='sucad'>Category Inserted Successfully !</span>"; 
            } else {
                echo "<span class='errad'>Category Isn't Inserted. Try Again !</span>";
            }
        }
    }
?>
         <form action="addcat.php" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name="name" placeholder="Enter Category Name..." class="medium" />
                    </td>
                </tr>
				<tr> 
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>