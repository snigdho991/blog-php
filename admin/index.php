<?php include 'inc/header.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#toggle").mouseover(function(){
			$(".para").show('3000');
		});

		$("#toggle").click(function(){
			$(".para").fadeOut('2000');
		});
	});
</script>

<div class="grid_10">
    <div class="box round first grid">
        <h2> Dashbord</h2>
        <div class="block">               
          <h4>Warm Welcome to our Admin Panel !</h4>        
        </div>
        <button id="toggle">Site Announcement</button>
        <div class="para">
<?php
    $query = "SELECT * FROM announcement WHERE id = '1'";
    $notice = $db->select($query);
    if($notice){
        while ($result = $notice->fetch_assoc()) {
?>
        	<h4 align="center">Administrator Announcement :</h4>
            <p align="center"><?php echo $result['announce']; ?></p>
<?php } } ?>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>