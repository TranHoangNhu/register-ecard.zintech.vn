<?php 
require('lib/db.php');

@session_start();

$tenkh = ""; $mobile = ""; $phone = ""; $email = ""; $address = ""; $company = ""; $department = ""; $position ="";
$templateid = ""; $website1 = ""; $website2 = ""; $diachi_nhanthe = ""; $taothe = 0;
//
//-------debug 1: check khai bao nhan vien , hang ban: ok
//
if(isset($_POST['tenkh']))
{
    $tenkh = $_POST['tenkh'];
}
if(isset($_POST['email']))
{
    $email = $_POST['email'];
}
if(isset($_POST['mobile']))
{
    $mobile = $_POST['mobile'];
}
if(isset($_POST['phone']))
{
    $phone = $_POST['phone'];
}
if(isset($_POST['address']))
{
    $address = $_POST['address'];
}
if(isset($_POST['company']))
{
    $company = $_POST['company'];
}
if(isset($_POST['department']))
{
    $department = $_POST['department'];
}
if(isset($_POST['position']))
{
    $position = $_POST['position'];
}
if(isset($_POST['website1']))
{
    $website1 = $_POST['website1'];
}
if(isset($_POST['website2']))
{
    $website2 = $_POST['website2'];
}
if(isset($_POST['taothe']))
{
    $taothe = $_POST['taothe'];
}
//
if(isset($_POST['templateid']))
{
    $templateid = $_POST['templateid'];
}
if(isset($_POST['diachi_nhanthe']))
{
    $diachi_nhanthe = $_POST['diachi_nhanthe'];
}
//
if($tenkh != "")
{
    
    //
    $matrungtam = "01";
    //
    $hientai = date('Y-m-d H:i:s');
    //
    $year = substr($hientai,0,4); //str, start, len
    $month = substr($hientai,5,2); if(strlen($month) == 1) $month = "0".$month;
    $day = substr($hientai,8,2);
    $hour = substr($hientai,11,2);
    $minute = substr($hientai,14,2);
    $second = substr($hientai,17,2);
    //
    $maregister = $matrungtam."-".$year.$month.$day.$hour.$minute.$second;
    //
    $sql = "insert into tblKhachHangDangKyECard(MaDangKy,TenKH,DiDong,DienThoai,Email,DiaChi,CongTy,BoPhan,ChucVu,Website1, Website2, ThoiGianTao,IsDangKyThe,TinhTrangID, TemplateID,DiaChiNhanThe,HinhLogo,ThoiGianCapNhat, MaNVXuLy) values('$maregister',N'$tenkh','$mobile','$phone',N'$email',N'$address',N'$company',N'$department',N'$position',N'$website1',N'$website2','$hientai','$taothe','1','$templateid',N'$diachi_nhanthe',getdate(),'')";
    $conn->query($sql);
}
?>