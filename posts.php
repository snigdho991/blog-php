<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>
<?php
	$categoryid = mysqli_real_escape_string($db->link, $_GET['category']);
	if(!isset($categoryid) || $categoryid == NULL){
		header("location:404.php");
	} else {
		$cat_id = $categoryid;
	}
?>

<div class="contentsection contemplete clear">
<div class="maincontent clear">

<?php
	$query = "SELECT * FROM tbl_post WHERE cat=$cat_id";
	$post  = $db->select($query);
	if($post){
		while ($result = $post->fetch_assoc()) {					
?>
<div class="samepost clear">
	<h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
	<h4><?php echo $fm->formatDate($result['date']); ?> By <a href="#"><?php echo $result['author']; ?></a></h4>
	<a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>

	<?php echo $fm->textShorten($result['body']); ?>

	<div class="readmore clear">
		<a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
	</div>
</div>

<?php } } else {
	echo "<span class='err'>No Post Is Available For This Category !</span>";
} ?>
</div>
		
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>