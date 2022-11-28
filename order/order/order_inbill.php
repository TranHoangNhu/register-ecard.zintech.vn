<?php 
$inbill = 0;
if(isset($_GET['inbill']))
{
  $inbill=$_GET['inbill']; 
  if($inbill == 1)
  {
    if($malichsuphieu != "")
    {
      $sql = "Insert into tblOrder_InPhieuTinhTien(MaNV, ThoiGianIn, MaLichSuPhieu, TinhTrangIn) values('$manv','".date('Y-m-d H:i:s')."','$malichsuphieu','0')";
      $rs=$conn->query($sql);
    }
  }
}//end if(isset($_GET['inbill']))
?>