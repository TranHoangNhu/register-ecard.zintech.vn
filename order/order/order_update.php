<?php 
require('../lib/db.php');
require('../functions/lichsuphieu.php');
@session_start();

$mahangban = ""; $soluong = 0; $clear_khachhang = 0; $malichsuphieu = "";
if(isset($_POST['mahangban']))
{
  	$mahangban = $_POST['mahangban'];
  	$soluong = $_POST['soluong'];

  	if(isset($_SESSION['TenHangBan']))
  	{
  		reset($_SESSION['TenHangBan']);
		  reset($_SESSION['MaDVT']);
		  reset($_SESSION['Gia']);
		  reset($_SESSION['SoLuong']);  

  		($_SESSION['SoLuong'][$mahangban]=$soluong);  //ok
	}
}

if(isset($_POST['clear_khachhang']))
{
	$clear_khachhang = $_POST['clear_khachhang'];
	if($clear_khachhang == 1)
	{
		$malichsuphieu = $_POST['malichsuphieu'];
		//truyen tu tab_client_card.php qua
		func_LSPhieu_UpdateKH($conn,$malichsuphieu,"","","");
	}
}
?>