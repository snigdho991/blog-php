<?php include 'inc/header.php'; ?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$fname = $fm->validation($_POST['firstname']);
		$lname = $fm->validation($_POST['lastname']);
		$email = $fm->validation($_POST['email']);
		$body  = $fm->validation($_POST['body']);
		
		$fname = mysqli_real_escape_string($db->link, $fname);
		$lname = mysqli_real_escape_string($db->link, $lname);
		$email = mysqli_real_escape_string($db->link, $email);
		$body  = mysqli_real_escape_string($db->link, $body);

		$error = "";

		if ($fname == "" && $lname == "" && $email == "" && $body == ""){
            $error = "Error ! All Fields Are Empty !";
        } elseif (empty($fname)) {
			$error = "Error ! Please Provide Your Firstname.";
		} elseif (empty($lname)) {
			$error = "Error ! Please Provide Your Lastname.";
		} elseif (empty($email)) {
			$error = "Error ! Please Provide Your Email Address.";
		} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error = "Provided Email Address Is Invalid !";
		} elseif (empty($body)) {
			$error = "Error ! Please Provide Your Message.";
		} else {

			$query = "INSERT INTO tbl_contact(firstname, lastname, email, body) VALUES('$fname', '$lname', '$email', '$body')";

            $inserted_rows = $db->insert($query);
            if ($inserted_rows) {
            	$msg = "Message Sent Successfully ! Thank You For Contacting With Us.";
            } else {
            	$error = "Message Not Sent ! Please Try Again Later.";
            }
		}
	}
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<?php
					if(isset($error)){
						echo "<span style='color:#ff0000; font-weight: bold;'>$error</span>";
					}

					if(isset($msg)){
						echo "<span style='color:#4CAF50; font-weight: bold;'>$msg</span>";
					}
				?>
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="firstname" placeholder="Enter first name"/>
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lastname" placeholder="Enter Last name"/>
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="email" name="email" placeholder="Enter Email Address"/>
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name="body"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Submit"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

</div>
		
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>