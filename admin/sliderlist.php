<?php include 'inc/header.php'; ?>
<?php include 'inc/adminsidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider Images List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
		<?php
			$query = "SELECT * FROM tbl_slider";
			$slider = $db->select($query);

			if($slider){
				$i = 0;
				while ($result = $slider->fetch_assoc()) {
					$i++;
		?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['title']; ?></td>
					<td><img src="<?php echo $result['image']; ?>" style="padding-top:5px" height="55" width="70"/></td>
				<td>
		<?php
			if (Session::get('userRole') == '0' || Session::get('userRole') == '1' || Session::get('userRole') == '2'){
		?>
					 <a href="editslider.php?sliderid=<?php echo $result['id']; ?>">Edit</a> 
		<?php } ?>
		<?php
			if (Session::get('userRole') == '0'){
		?>
					 || <a onclick="return confirm('Are You Sure To Delete ?'); " href="delslider.php?sliderid=<?php echo $result['id']; ?>">Delete</a>
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