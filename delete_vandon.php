<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header('location:signin.php');
	}
	include('connect.php');

	$ID = $_GET['idvd'];
	$IDCT = $_GET['idvdct'];

	$sql = "DELETE FROM chitietvandon WHERE ID='$IDCT';DELETE FROM vandon WHERE ID='$ID'";

	$stmt = $conn->prepare($sql);
	$query = $stmt->execute();

	header("location:list.php")
?>
