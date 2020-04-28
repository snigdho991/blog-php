<?php include 'inc/header.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>

<div class="grid_10">		
    <div class="box round first grid">
        <h2>Change Theme</h2>
       <div class="block copyblock"> 
<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $theme = $_POST['theme'];
        $theme = mysqli_real_escape_string($db->link, $theme);       
        $query = "UPDATE tbl_theme
                SET theme = '$theme'
                WHERE id = '1'";
        $update = $db->update($query);
        if($update){
           echo "<span class='sucad'>Theme Updated Successfully !</span>"; 
        } else {
            echo "<span class='errad'>Theme Isn't Updated. Try Again !</span>";
        }
    }
?>

<?php

    $query = "SELECT * FROM tbl_theme WHERE id = '1'";
    $themes = $db->select($query);
        while ($result = $themes->fetch_assoc()) {
?>
         <form action="" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <input <?php if ($result['theme'] == 'default') {echo "checked";}?> type="radio" name="theme" value="default"/> Default
                    </td>
                </tr>

                <tr>
                    <td>
                        <input <?php if ($result['theme'] == 'green') {echo "checked";}?> type="radio" name="theme" value="green"/> Green
                    </td>
                </tr>

                <tr>
                    <td>
                        <input <?php if ($result['theme'] == 'blue') {echo "checked";}?> type="radio" name="theme" value="blue"/> Blue
                    </td>
                </tr>

				<tr> 
                    <td>
                        <input type="submit" name="submit" Value="Change" />
                    </td>
                </tr>
            </table>
            </form>
<?php } ?>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>