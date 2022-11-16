<?php 
require('../../lib/db.php');
require('../../lib/clsKhachHang.php');
require('../../functions/lichsuphieu.php');
$sgDep = new clsKhachHang($conn);
@session_start();	

$client_code = $_POST['client_code'];

$data = []; 

$rs = $sgDep->getClientInfo( $client_code );
foreach($rs as $r)
{
	array_push( $data, $r['MaDoiTuong'], $r['TenDoiTuong'], $r['DienThoai'], $r['DiaChi'], $r['MaTheVip'], $r['LoaiTheVip'], $r['IsGhiNoDV'], $r['IsGhiNoTT'] ); 
}

echo json_encode($data);
