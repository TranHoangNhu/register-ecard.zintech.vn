<?php
	session_start();
	unset($_SESSION['MaNV']);
	unset($_SESSION['TenNV']);
	unset($_SESSION['TenSD']);
	unset($_SESSION['MaTrungTam']);
	unset($_SESSION['TenTrungTam']);
	unset($_SESSION['MaKhu']);
	unset($_SESSION['MaBan']);
	unset($_SESSION['MaLichSuPhieu']);
	unset($_SESSION['MaNhomNhanVien']);
	unset($_SESSION['MaNhomHangBan']);
	unset($_SESSION['MaHangBan']);

	header('location:login.php');
?>