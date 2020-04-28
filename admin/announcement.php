<?php include 'inc/header.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>

<style type="text/css">
    input[type="text"] {
    height: 50px;
    padding: 5px;
    width: 500px;
    border: 1px solid #B3CBD6;
}
</style>

<div class="grid_10">		
    <div class="box round first grid">
        <h2>Add Announcement</h2>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $announce  = $fm->validation($_POST['announce']);       
        $announce  = mysqli_real_escape_string($db->link,$announce);
        
        if ($announce == ""){
            echo "<span class='errad'>Fields Must Not Be Empty !</span>";
        }

        if(!empty($announce)){

                $query = "UPDATE announcement
                          SET 
                          announce  = '$announce'
                          WHERE id = '1'";

                $updated_row = $db->update($query);
                if ($updated_row) {
                 echo "<span class='sucad'> Announcement Updated Successfully ! </span>";
                } else {
                 echo "<span class='errad'> Announcement Isn't Updated. Try Again ! </span>";
                }
            }
    }
?>

<?php
    $query = "SELECT * FROM announcement WHERE id = '1'";
    $notice = $db->select($query);
    if($notice){
        while ($result = $notice->fetch_assoc()) {
?>

        <div class="block copyblock">            
         <form action="" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" value="<?php echo $result['announce']; ?>" name="announce" class="large" />
                    </td>
                </tr>
				 
				
				 <tr>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            </div>
<?php } } ?>
    </div>
</div>

<?php include 'inc/footer.php'; ?>