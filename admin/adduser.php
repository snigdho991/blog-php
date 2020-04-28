<?php include 'inc/header.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>
<?php
    if (!Session::get('userRole') == '0'){
        Session::destroy();
    }
?>

<div class="grid_10">		
    <div class="box round first grid">
        <h2>Add New User</h2>
       <div class="block copyblock"> 
<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $fm->validation($_POST['username']);
        $password = $fm->validation(md5($_POST['password']));
        $email    = $fm->validation($_POST['email']);
        $role     = $fm->validation($_POST['role']);

        $username = mysqli_real_escape_string($db->link, $username);
        $password = mysqli_real_escape_string($db->link, $password);
        $email    = mysqli_real_escape_string($db->link, $email);
        $role     = mysqli_real_escape_string($db->link, $role);

        if(empty($username) || empty($password) || empty($email) || empty($role)){
            echo "<span class='errad'>Fields Must Not Be Empty !</span>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<span class='errad'>Provided Email Address Is Invalid !</span>";
        } else {

        $mailquery = "SELECT * FROM tbl_user WHERE email = '$email' LIMIT 1";
        $checkmail  = $db->select($mailquery);
            if ($checkmail != false){
                echo "<span class='errad'>Email Already Exists !</span>";
            } else {
                $query = "INSERT INTO tbl_user(username, password, email, role) VALUES('$username', '$password', '$email', '$role')";
                $insert = $db->insert($query);
                if($insert){
                   echo "<span class='sucad'>User Created Successfully !</span>"; 
                } else {
                    echo "<span class='errad'>User Isn't Created. Try Again !</span>";
                }
            }
        }
    }
?>
         <form action="" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <label>Username</label>
                    </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Username..." class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Password</label>
                    </td>
                    <td>
                        <input type="text" name="password" placeholder="Enter Password..." class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" name="email" placeholder="Enter Valid Email..." class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Assign Role</label>
                    </td>
                    <td>
                        <select id="select" name="role">
                            <option>Select User Role</option>
                            <option value="0">Admin</option>
                            <option value="1">Moderator</option>
                            <option value="2">Editor</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Create" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>