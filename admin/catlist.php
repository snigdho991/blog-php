<?php include 'inc/header.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>

        <?php
        	if(isset($_GET['delcat'])){
        		$delid    = $_GET['delcat'];
        		$delquery = "DELETE FROM tbl_category WHERE id = '$delid'";
        		$deldata  = $db->delete($delquery);
        		if($deldata == true){
	               echo "<span class='errad'>Category Deleted Successfully !</span>"; 
	            } else {
	               echo "<span class='errad'>Category Isn't Deleted. Try Again !</span>";
	            }
        	}
        ?>

        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Category Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$query = "SELECT * FROM tbl_category ORDER BY id DESC";
				$category  = $db->select($query);
				if($category){
					$i = 0;
					while ($result = $category->fetch_assoc()) {
						$i++;					
			?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['name']; ?></td>
					<td>
			<?php
                if (Session::get('userRole') == '0' || Session::get('userRole') == '1'){
            ?>
						<a href="editcat.php?catid=<?php echo $result['id']; ?>">Edit</a> 
					 || <a onclick="return confirm('Are You Sure To Delete ?'); " href="?delcat=<?php echo $result['id']; ?>">Delete</a>
			<?php } ?>
			<?php
                if (Session::get('userRole') == '2'){ ?>
                	<a href="editcat.php?catid=<?php echo $result['id']; ?>">Edit</a> 
            <?php } ?>
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