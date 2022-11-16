<?php
require('lib/db.php');
session_start();
	$user=$_POST['username'];
	$pass=$_POST['password'];
	
	echo $sql="select PWDCOMPARE('$pass',MatKhau) as IsDungMatKhau, TenSD, b.MaNV, b.TenNV, b.MaTrungTam, c.TenTrungTam from tblDSNguoiSD a, tblDMNhanVien b, tblDMTrungTam c where a.MaNhanVien = b.MaNV and b.MaTrungTam = c.MaTrungTam and a.TenSD like '$user'";
	
	$rs= $conn->query($sql);
	if($rs===false)
	{
?>
		<script>
			window.onload=function(){
		alert("Đăng nhập không thành công. Sai email hoặc mật khẩu");
			setTimeout('window.location="login.php"',0);
		}
		</script>
<?php
	}
	else
	{
	 	$r = $rs->fetch( PDO::FETCH_ASSOC );

	 	$r['TenSD'];		
		$r['MaNV'];				
		$r['TenNV'];
		$r['IsDungMatKhau'];
		$r['MaTrungTam'];
		$r['TenTrungTam']; 
 
		if($r['IsDungMatKhau'])
		{
			$_SESSION['MaNV']=$r['MaNV'];
			$_SESSION['TenNV']=$r['TenNV'];
			$_SESSION['TenSD']=$r['TenSD'];
			$_SESSION['MaTrungTam']=$r['MaTrungTam'];
			$_SESSION['TenTrungTam']=$r['TenTrungTam'];
			$_SESSION['MaKhu'] = "";

			header('location:home.php');
		}
		else
		{
?>
			<script>
				window.onload=function(){
				alert("Đăng nhập không thành công. Sai mật khẩu");
				setTimeout('window.location="login.php"',0);
				}
			</script>
<?php
		}
	}
?>
	
		
	