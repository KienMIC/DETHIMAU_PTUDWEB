<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header('location:signin.php');
	}
	include('connect.php');
	$sql = "SELECT NhanVien.ID AS idnv,hoten FROM NhanVien";
	$sql2 = "SELECT HangHoa.ID AS idhh,ten FROM HangHoa";

	$stmt = $conn->prepare($sql);
	$query = $stmt->execute();

	$stmt1 = $conn->prepare($sql2);
	$query1 = $stmt1->execute();

	$result = array();
	$result1 = array();

	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		$result[] = $row;
	}
	
	while($row1=$stmt1->fetch(PDO::FETCH_ASSOC)){
		$result1[] = $row1;
	}

	if(!empty($_POST['submit'])){
		if(isset($_POST['idvandon'])&&isset($_POST['idchitietvandon'])&&isset($_POST['nhanvien'])&&isset($_POST['nguoinhan'])&&isset($_POST['hanghoa'])&&isset($_POST['soluong'])){
			$idvd = $_POST['idvandon'];
			$idctvd = $_POST['idchitietvandon'];
			$nhanvien = $_POST['nhanvien'];
			$nguoinhan = $_POST['nguoinhan'];
			$hanghoa = $_POST['hanghoa'];
			$soluong = $_POST['soluong'];
			$sql = "INSERT INTO VanDon(ID,nhanvien_ID,nguoinhan) VALUES('$idvd','$nhanvien','$nguoinhan');INSERT INTO ChiTietVanDon(ID,vandon,hanghoa_ID,soluong) VALUES('$idctvd','$idvd','$hanghoa','$soluong')";
			var_dump($sql);
			$stmt = $conn->prepare($sql);
			$query = $stmt->execute();
			if($query){
				header('location:list.php');
			}
			else{
				echo "Thêm dữ liệu thất bại";
			}
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

					<form method="post">
						<fieldset class="form-group">
							<label for="formGroupExampleInput">ID Vận đơn</label>
							<input type="text" class="form-control" name="idvandon" placeholder="Nhập ID Vận đơn">
						</fieldset>
						<fieldset class="form-group">
							<label for="formGroupExampleInput2">ID Chi tiết vận đơn</label>
							<input type="text" class="form-control" name="idchitietvandon" placeholder="Nhập ID Chi tiết vận đơn">
						</fieldset>
						<fieldset class="form-group">
							<label for="formGroupExampleInput2">Nhân viên</label>
							<select class="form-control" name="nhanvien" placeholder="Chọn Nhân viên">
								<<?php foreach ($result as $items): ?>
									<option value="<?php echo $items['idnv']; ?>"><?php echo $items['hoten']; ?></option>
								<?php endforeach ?>
							</select>
						</fieldset>
						<fieldset class="form-group">
							<label for="formGroupExampleInput2">Người nhận</label>
							<input type="text" class="form-control" name="nguoinhan" placeholder="Nhập người nhận">
						</fieldset>
						<fieldset class="form-group">
							<label for="formGroupExampleInput2">Hàng hóa</label>
							<select class="form-control" name="hanghoa" placeholder="Chọn hàng hóa">
								<<?php foreach ($result1 as $items): ?>
									<option value="<?php echo $items['idhh']; ?>"><?php echo $items['ten']; ?></option>
								<?php endforeach ?>
							</select>
						</fieldset>
						<fieldset class="form-group">
							<label for="formGroupExampleInput2">Số lượng</label>
							<input type="text" class="form-control" name="soluong" placeholder="Nhập số lượng hàng hóa">
						</fieldset>
						<fieldset class="form-group">
							<input type="submit" class="form-control" name="submit" value="LƯU">
						</fieldset>
					</form>
		</div>
		
	</content>
	<footer>Ngô Trung Kiên - 74458 - CNT58DH</footer>
</body>
</html>