<?php include 'inc/header.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Inbox</h2>
<?php
	if(isset($_GET['unseenid'])){
		$unseenid = $_GET['unseenid'];
		$query = "UPDATE tbl_contact
                  SET status = '0'
                  WHERE id = '$unseenid'";
        $update = $db->update($query);
        if($update){
           echo "<span class='sucad'>Message Sent To Inbox !</span>"; 
        } else {
            echo "<span class='errad'>Something Went Wrong. Try Again !</span>";
        }
	}
?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$query = "SELECT * FROM tbl_contact WHERE status='0' ORDER BY id DESC";
				$msg = $db->select($query);
				if($msg){
					$i = 0;
					while ($result = $msg->fetch_assoc()) {
						$i++;					
			?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
					<td><?php echo $result['email']; ?></td>
					<td><?php echo $fm->textShorten($result['body'], 30); ?></td>
					<td><?php echo $fm->formatDate($result['date']); ?></td>
					<td>
						<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> ||
					 	<a href="replymsg.php?msgid=<?php echo $result['id']; ?>">Reply</a> ||
					 	<a onclick="return confirm('Are You Sure To Move This Message ?'); " href="?seenid=<?php echo $result['id']; ?>">Seen</a>
					</td>
				</tr>
			<?php } } ?>				
			</tbody>
		</table>
       </div>
    </div>

    <div class="box round first grid">
        <h2>Seen Folder</h2>
<?php
	if(isset($_GET['seenid'])){
		$seenid = $_GET['seenid'];
		$query = "UPDATE tbl_contact
                  SET status = '1'
                  WHERE id = '$seenid'";
        $update = $db->update($query);
        if($update){
           echo "<span class='sucad'>Message Sent To Seen Folder !</span>"; 
        } else {
            echo "<span class='errad'>Something Went Wrong. Try Again !</span>";
        }
	}
?>

        <?php
        	if(isset($_GET['delid'])){
        		$delid    = $_GET['delid'];
        		$delquery = "DELETE FROM tbl_contact WHERE id = '$delid'";
        		$deldata  = $db->delete($delquery);
        		if($deldata){
	               echo "<span class='errad'>Message Deleted Successfully !</span>"; 
	            } else {
	               echo "<span class='errad'>Message Isn't Deleted. Try Again !</span>";
	            }
        	}
        ?>
        <div class="block">        
        <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$query = "SELECT * FROM tbl_contact WHERE status='1' ORDER BY id DESC";
				$msg = $db->select($query);
				if($msg){
					$i = 0;
					while ($result = $msg->fetch_assoc()) {
						$i++;					
			?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
					<td><?php echo $result['email']; ?></td>
					<td><?php echo $fm->textShorten($result['body'], 30); ?></td>
					<td><?php echo $fm->formatDate($result['date']); ?></td>
					<td>
						<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> ||
						<a onclick="return confirm('Are You Sure To Move This Message ?'); " href="?unseenid=<?php echo $result['id']; ?>">Unseen</a> ||
						<a onclick="return confirm('Are You Sure To Delete This Message ?'); " href="?delid=<?php echo $result['id']; ?>">Delete</a> 
					</td>
				</tr>
			<?php } } ?>				
			</tbody>
		</table>
       </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();

    });
</script>

<?php include 'inc/footer.php'; ?>