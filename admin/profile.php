<?php include 'inc/header.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>

<?php
    $userid   = Session::get('userId');
    $userrole = Session::get('userRole');
?>

<div class="grid_10">		
    <div class="box round first grid">
        <h2>Update Profile Info</h2>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name     = $fm->validation($_POST['name']);
        $username = $fm->validation($_POST['username']);
        $email    = $fm->validation($_POST['email']);
    
        $name     = mysqli_real_escape_string($db->link, $name);
        $username = mysqli_real_escape_string($db->link, $username);
        $email    = mysqli_real_escape_string($db->link, $email);
        $details  = mysqli_real_escape_string($db->link, $_POST['details']);

            $query = "UPDATE tbl_user
                      SET 
                      name     = '$name',
                      username = '$username',
                      email    = '$email',
                      details  = '$details'
                      WHERE id = '$userid'";

            $updated_row = $db->update($query);
            if ($updated_row) {
             echo "<span class='sucad'>Profile Updated Successfully ! </span>";
            } else {
             echo "<span class='errad'>Profile Isn't Updated. Try Again ! </span>";
            }
        }

?>
    <div class="block">

<?php
    $query = "SELECT * FROM tbl_user WHERE id = '$userid' AND role = '$userrole'";
    $getuser = $db->select($query);
    if($getuser){
        while ($result = $getuser->fetch_assoc()) {
?>               
         <form action="" method="POST">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Username</label>
                    </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $result['username']; ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" name="email" value="<?php echo $result['email']; ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Details</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="details">
                            <?php echo $result['details']; ?>
                        </textarea>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
<?php } } else {
    echo "<script>window.location = 'index.php';</script>";
} ?>
        </div>
    </div>
</div>

<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function () {
    setupTinyMCE();
    setDatePicker('date-picker');
    $('input[type="checkbox"]').fancybutton();
    $('input[type="radio"]').fancybutton();
});
</script>
<!-- Load TinyMCE -->

<?php include 'inc/footer.php'; ?>
