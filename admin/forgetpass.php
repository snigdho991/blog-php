<?php
	include '../lib/Session.php';
	Session::checkLogin();
?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>

<?php
	$db = new Database();
	$fm = new Format();
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$email = $fm->validation($_POST['email']);				
				$email = mysqli_real_escape_string($db->link, $email);

				if (empty($email)){
					echo "<span class='err'>Enter Email Address !</span>";
				} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		            echo "<span class='err'>Provided Email Address Is Invalid !</span>";
		        } else {
				
					$mailquery = "SELECT * FROM tbl_user WHERE email = '$email' LIMIT 1";
			        $checkmail  = $db->select($mailquery);
			        if ($checkmail != false){
			        	while ($value = $checkmail->fetch_assoc()) {
			        		$userid = $value['id'];
			        		$username = $value['username'];
			        	}

			        	$text = substr($email, 0, 3);
			        	$rand = rand(11010, 98857);
			        	$newpass = "$text$rand";
			        	$password = md5($newpass);

			        	$query = "UPDATE tbl_user
		                          SET password = '$password'
		                          WHERE id = '$userid'";
            			$updated_row = $db->update($query);

            			$to = "$email";
            			$from = "Snigdho2011@gmail.com";
            			$headers = "From: $from\n";
            			$headers .= 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$subject = "New Password";
						$message = "Your Username is ".$username." And Recovered Password is ".$newpass." Please Visit Our Admin Login Page to get Logged In with these !";

						$sendmail = mail($to, $subject, $message, $headers);
						if($sendmail){
							echo "<span class='succ'> Successful ! Please Check Your Mail Inbox For New Password.</span>";
						} else {
							echo "<span class='err'>Something Went Wrong !</span>";
						}
						
					} else {
						echo "<span class='err'>Email Doesn't Exist !</span>";
					}
				} 
			}
		?>
		<form action="" method="post">
			<h1>Pass Recovery</h1>
			<div>
				<input type="text" placeholder="Enter Valid Email" name="email"/>
			</div>
			
			<div>
				<input type="submit" value="Send Mail" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login Form</a>
		</div><!-- button -->

		<div class="button">
			<a href="mailto:Snigdho2011@gmail.com">Snigdho2011@gmail.com</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>