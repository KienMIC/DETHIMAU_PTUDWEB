<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header('location:signin.php');
	}
	include('connect.php');
	if(empty($_POST['submit'])){
		$sql = "SELECT * FROM hienthi";
		$stmt = $conn->prepare($sql);
		$query = $stmt->execute();
		$result = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$result[] = $row;
		}
	}
	else{
		$timkiem = $_POST['timkiem'];
		$sql = "SELECT * FROM hienthi WHERE hoten LIKE '%$timkiem%'";
		$stmt = $conn->prepare($sql);
		$query = $stmt->execute();
		$result = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$result[] = $row;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>QUẢN LÝ VẬN ĐƠN - NGÔ TRUNG KIÊN - 74458</title>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-3.5.1.slim.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header>QUẢN LÝ VẬN ĐƠN</header>
	<content>
		<div class="container"> 
					<ul class="nav">
						<li class="nav-item">
							<a class="nav-link" href="index.php">Trang chủ</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="list.php">Danh sách vận đơn</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="cau1.PNG">Ảnh câu 1</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="signout.php">Đăng xuất</a>
						</li>
					</ul>
					<br>
					<form method="post">
						<label>TÌM KIẾM</label>
						<input type="text" name="timkiem" placeholder="Nhập họ tên nhân viên">
						<input type="submit" name="submit" value="TÌM KIẾM">
					</form>
					<br>
					<table class="table table-inverse">
						<thead>
							<tr>
								<th>Mã vận đơn</th>
								<th>Nhân viên phụ trách</th>
								<th>Người nhận</th>
								<th>Hàng hóa</th>
								<th>Số lượng</th>
								<th>Hành động</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($result as $items):?>
							<tr>
								<td><?php echo $items['ID'];?></td>
								<td><?php echo $items['hoten'];?></td>
								<td><?php echo $items['nguoinhan'];?></td>
								<td><?php echo $items['ten'];?></td>
								<td><?php echo $items['soluong'];?></td>
								<th><a href="add_vandon.php">Thêm</a></th>
							<th><a href="edit_vandon.php?idvd=<?php echo $items['ID'];?>&idvdct=<?php echo $items['IDCT'];?>">Sửa</a></th>
							<th><a href="delete_vandon.php?idvd=<?php echo $items['ID'];?>&idvdct=<?php echo $items['IDCT'];?>">Xóa</a></th>
							</tr>
						<?php endforeach?>
						</tbody>
					</table>
		</div>
		
	</content>
	<footer>Ngô Trung Kiên - 74458 - CNT58DH</footer>
</body>
</html>