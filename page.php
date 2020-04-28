<?php include 'inc/header.php'; ?>

<?php
    $pid = mysqli_real_escape_string($db->link, $_GET['pageid']);
    if(!isset($pid) || $pid == NULL){
        echo "<script>window.location = '404.php';</script>";
    } else {
        $pageid = $pid;
    }
?>

<?php
    $pagequery = "SELECT * FROM tbl_page WHERE id = '$pageid'";
    $pagedetails = $db->select($pagequery);
    if($pagedetails){
        while ($result = $pagedetails->fetch_assoc()) {                  
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2><?php echo $result['name']; ?></h2>	
				<?php echo $result['body']; ?>
	</div>
</div>
<?php } } else {
	echo "<script>window.location = 'index.php';</script>";
} ?>
		
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>