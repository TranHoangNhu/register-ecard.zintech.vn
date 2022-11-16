<?php
if(isset($_GET['malichsuphieu']))		//---trường hợp xử lý theo link phân trang hoặc từ home
{
	$malichsuphieu= $_GET['malichsuphieu']; 
}

if(isset($_POST['malichsuphieu']) && $malichsuphieu == "") //trường hợp xử lý theo submit form chọn món
{
	$malichsuphieu= $_POST['malichsuphieu'];
}

if(isset($_SESSION['MaLichSuPhieu']) && $malichsuphieu == "") //lấy session mã lịch sử phiếu
{
	unset($_SESSION['SoLuong']);
	unset($_SESSION['TenHangBan']);
	unset($_SESSION['MaDVT']);
	unset($_SESSION['Gia']);
  unset($_SESSION['YeuCauThem']);

	$malichsuphieu = $_SESSION['MaLichSuPhieu'];
}

if($malichsuphieu != "")
{
  //-----luu lai session mới nhất MaLichSuPhieu
  //
	$_SESSION['MaLichSuPhieu']= $malichsuphieu;
  $_SESSION['MaKhachHang'] = "";
  $_SESSION['TenKhachHang'] = "";
  $_SESSION['MaTheVip'] = "";
  $_SESSION['LoaiTheVip'] = "";
  $_SESSION['LaTheDV'] = 0;
  $_SESSION['LaTheGT'] = 0;
  $_SESSION['NgayHetHan'] = "";
  $_SESSION['SoDuTheVip'] = 0;
  $_SESSION['DienThoai'] = "";
  $_SESSION['DiaChi'] = "";

  $rskh = $client->getClientInfo_LSPhieu($malichsuphieu);
  if($rskh != false)
  {
    foreach($rskh as $rkh)
    {
      $makhachhang = $rkh['MaKhachHang'];
      $tenkhachhang = $rkh['TenKhachHang'];
      $mathevip = $rkh['MaTheVip'];
      $loaithevip = $rkh['LoaiTheVip'];
      $sodienthoai = $rkh['DienThoai'];
      $diachi = $rkh['DiaChi'];
      $thedv = $rkh['IsGhiNoDV'];
      $thett = $rkh['IsGhiNoTT'];
      $ngayhethan = $rkh['NgayKetThuc'];
      $soduthevip = $rkh['ConLai'];

      $_SESSION['MaKhachHang'] = $makhachhang;
      $_SESSION['TenKhachHang'] = $tenkhachhang;
      $_SESSION['MaTheVip'] = $mathevip;
      $_SESSION['LoaiTheVip'] = $loaithevip;
      $_SESSION['LaTheDV'] = $thedv;
      $_SESSION['LaTheGT'] = $thett;
      $_SESSION['NgayHetHan'] = $ngayhethan;
      $_SESSION['SoDuTheVip'] = $soduthevip;
      $_SESSION['DienThoai'] = $sodienthoai;
      $_SESSION['DiaChi'] = $diachi;
    }
  }
}//end if($malichsuphieu != "")
else
{
    //echo "chua co ma phieu";
    if(isset($_SESSION['MaKhachHang']))
       $makhachhang = $_SESSION['MaKhachHang'];

    if(isset($_SESSION['TenKhachHang']))
        $tenkhachhang = $_SESSION['TenKhachHang'];

    if(isset($_SESSION['MaTheVip']))
        $mathevip = $_SESSION['MaTheVip'];

    if(isset($_SESSION['LoaiTheVip']))
        $loaithevip = $_SESSION['LoaiTheVip'];

    if(isset($_SESSION['LaTheDV']))
        $thedv = $_SESSION['LaTheDV'];

    if(isset($_SESSION['LaTheGT']))
        $thett = $_SESSION['LaTheGT'];

    if(isset($_SESSION['NgayHetHan']))
        $ngayhethan = $_SESSION['NgayHetHan'];

    if(isset($_SESSION['SoDuTheVip']))
        $soduthevip = $_SESSION['SoDuTheVip'];

    if(isset($_SESSION['DienThoai']))
        $sodienthoai = $_SESSION['DienThoai'];

    if(isset($_SESSION['DiaChi']))
        $diachi = $_SESSION['DiaChi'];
}
?>