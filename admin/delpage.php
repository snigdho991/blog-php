<?php
    include '../lib/Session.php';
    Session::checkSession();
?>

<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>

<?php
    $db = new Database();
?>

<?php
    if(!isset($_GET['delpage']) || $_GET['delpage'] == NULL){
        echo "<script>window.location = 'index.php';</script>";
        //header("Location:catlist.php");<!--error-->
    } else {
        $pageid = $_GET['delpage'];

        $delquery = "DELETE FROM tbl_page WHERE id = '$pageid'";
        $deldata = $db->delete($delquery);
        if ($deldata) {
        	echo "<script>alert('Page Deleted Successfully !');</script>";
        	echo "<script>window.location = 'index.php';</script>";
        } else {
        	echo "<script>alert('Page Isn't Deleted. Try Again !');</script>";
        	echo "<script>window.location = 'index.php';</script>";
        }
    }
?>