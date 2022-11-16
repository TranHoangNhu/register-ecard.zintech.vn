<?php 
$inphieu = 0;
if(isset($_GET['inphieu']))
{
  $inphieu=$_GET['inphieu']; $idorder = "";
  if($inphieu == 1)
  {
    if($malichsuphieu != "")
    {
      $coorder = 0;
      $inbep_mahangban = ""; $inbep_mabep = ""; $inbep_orderid = ""; $inbep_soluong = 1;
      $inbep_tenhangban = ""; $inbep_madvt = ""; $inbep_sophut = 0; $inbep_dongia = 0;
      $inbep_ktv = "";
      //
      //----lay thong tin order có mã bếp
      $sql = "Select a.*, b.MaBep, b.ThoiGianLam, c.NVPhucVu from tblOrderChiTiet a Inner join (select MaBep, f.MaHangBan, ISNULL(f.ThoiGianLam,0) as ThoiGianLam from tblDMKhu_Kho e, tblDMHangBan f Where e.NhomHang = f.MaNhomHangBan and e.NhomHang in ('NN001','NN001B') Group by MaBep,f.MaHangBan,f.ThoiGianLam) b On a.MaHangBan = b.MaHangBan Inner join (Select g.OrderID, h.NVPhucVu from tblLSPhieu_HangBan g, tblLichSuPhieu h where g.MaLichSuPhieu = h.MaLichSuPhieu and g.MaLichSuPhieu like '$malichsuphieu') c On a.OrderID = c.OrderID Order by a.OrderID desc"; 
      try
      {
          $rs=$conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
          if($rs != false)
          {
              foreach($rs as $r)
              {
                $coorder = 1;

                  $r['MaHangBan'];
                  $r['MaBep'];
                  $r['OrderID'];
                  $r['SoLuong'];
                  $r['TenHangBan'];
                  $r['MaDVT'];
                  $r['ThoiGianLam'];
                  $r['DonGia'];
                  $r['NVPhucVu'];

                  $idorder = $malichsuphieu."-".$r['OrderID']."-".$r['MaHangBan']."-".$r['MaBep'];
                  $inbep_mahangban = $r['MaHangBan'];
                  $inbep_mabep = $r['MaBep'];
                  $inbep_orderid = $r['OrderID'];
                  $inbep_soluong = $r['SoLuong'];
                  $inbep_tenhangban = $r['TenHangBan'];
                  $inbep_madvt = $r['MaDVT'];
                  $inbep_sophut = $r['ThoiGianLam'];
                  $inbep_dongia = $r['DonGia'];
                  $inbep_ktv = $r['NVPhucVu'];

                  $timestamptemp = date('Y-m-d H:i');
                 $timestemptemp1 = $timestamptemp." + ".$inbep_sophut." minute"; 
                 $inbep_thoigianketthuc = strtotime($timestemptemp1);

                  $sql1 = "Insert into tblYeuCauBep(ID,MaBep,MaLichSuPhieu,MaHangBan,SoLuong,NgayGio,TinhTrang,TenHangBan,MaDVT,OrderID,DaIn,SoLanIn,ThoiGianLamXong) values('$idorder','$inbep_mabep','$malichsuphieu','$inbep_mahangban','$inbep_soluong','".date('Y-m-d H:i:s')."','1',N'$inbep_tenhangban','$inbep_madvt','$inbep_orderid','0','0','".date('Y-m-d H:i:s',$inbep_thoigianketthuc)."')";
                  // echo "sql1:".$sql1; -> insert ok
                  $rs1 = $conn->query($sql1);

                  $sql2 = "Insert into tblYeuCauBepIn_Pocket(ID,MaLichSuPhieu,MaBan,MaHangBan,TenHangBan,SoLuong,MaDVT,MaBep,YeuCauThem,NgayGio,OrderID,DonGia) values('$idorder','$malichsuphieu','$maban','$inbep_mahangban',N'$inbep_tenhangban','$inbep_soluong','$inbep_madvt','$inbep_mabep','$inbep_ktv','".date('Y-d-m H:i:s')."','$inbep_orderid','$inbep_dongia')";
                  //echo "sql2:".$sql2; -> insert ok
                  $rs2 = $conn->query($sql2);
              }//end foreach
          }//end if($rs != false)
      }
      catch (Exception $e) {
          echo $e->getMessage();
      }
      //
      //----xu ly update gio lam
      //
      if($inbep_sophut > 0 && $inbep_mahangban != "")
      {
        $sql = "Update tblLichSuPhieu set MaDichVuDieuTour = '$inbep_mahangban',DichVuDieuTour=N'$inbep_tenhangban',ThoiGianLam = '$inbep_sophut',GioVao = '".date('Y-m-d H:i:s')."',GioTra='".date('Y-m-d H:i:s',$inbep_thoigianketthuc)."' Where MaLichSuPhieu = '$malichsuphieu'";
        $rs=$conn->query($sql);
      }
    }//end if co ma lich su phieu
  }//end if($inphieu == 1)
}//end if(isset($_GET['inphieu'])) 
?>