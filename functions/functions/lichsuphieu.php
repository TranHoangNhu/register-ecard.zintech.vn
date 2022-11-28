<?php

function func_TaoLichSuPhieuID($conn,$matrungtam)
{
	// format: mã trung tâm - loại hình kd - ymd - id
	$malichsuphieu = $matrungtam."-1-".date("yymd")."-";
	$l_sql = "Select MAX(Right(MaLichSuPhieu,4)) as iMaLSP from [tblLichSuPhieu] WHERE MaLichSuPhieu like '".$matrungtam."-1-".date("yymd")."%'";
	$l_index = 0;	
	try
	{
		$result_malsp = $conn->query($l_sql)->fetchAll(PDO::FETCH_ASSOC);
		if($result_malsp)
		{
			foreach($result_malsp as $rbk)
			{
				$l_index = intval($rbk['iMaLSP']);
			}
		}
	}
	catch(Exception $e) 
	{ 
		$l_index = 0; 
	}
	
	$l_index = $l_index + 1;
	$malichsuphieu = $malichsuphieu.substr("0000", 0, 4-strlen(strval($l_index))).$l_index;
	return $malichsuphieu;
}

function func_InsertLichSuPhieu($conn,$malichsuphieu,$makhu,$maban,$manv)
{
	$l_sResult = "";
	try 
	{
		$sql = "INSERT INTO  tblLichSuPhieu (MaLichSuPhieu, MaBan, GioVao, DangNgoi, DaTinhTien, DaTraDu,MaKhachHang, SoLuongKhach,TongTien,TienGiamGia,TienThucTra,TienDichVu,NVTaoMaNV,NVTinhTienMaNV,ThoiGianTaoPhieu,MaTienTe,MaKhu,TyGia,KeyString) VALUES ('$malichsuphieu','$maban','".date('Y-m-d H:i:s')."',1,0,0,'','1','0','0','0','0','$manv','$manv','".date('Y-m-d H:i:s')."','VND','$makhu',1,'$maban')";
		$conn->query($sql);
	}
	catch (Exception $e) 
	{
    	$l_sResult = $e->getMessage();
	}
	return $l_sResult;
}

function func_LSPhieu_UpdateKH($conn,$malichsuphieu,$makh,$tenkh,$mathevip)
{
	$l_sResult = ""; $l_iSDTheVip = 0;
	if($mathevip != "")
		$l_iSDTheVip = 1;
	try 
	{
		$sql = "UPDATE tblLichSuPhieu SET MaKhachHang = '$makh', TenKhachHang = N'$tenkh', MaTheVip = '$mathevip', IsSDTheVip = '$l_iSDTheVip' WHERE MaLichSuPhieu = '$malichsuphieu'";
		$conn->query($sql);
	}
	catch (Exception $e) 
	{
    	$l_sResult = $e->getMessage();
	}
	return $l_sResult;
}

function func_TaoOrderID($conn,$matrungtam)
{
	//
	/*[tblOrder] OrderID: 03-150819-0001*/
	$orderID = $matrungtam."-".date("ymd")."-";
	$l_sql_order = "Select MAX(Right(OrderID,4)) as iMaOrder from [tblOrder] WHERE OrderID like '".$matrungtam."-".date("ymd")."%'";
	$l_index = 0;	
	try
	{
		$result_maorder = $conn->query($l_sql_order)->fetchAll(PDO::FETCH_ASSOC);
		if($result_maorder)
		{
			foreach($result_maorder as $rbk)
			{
				$l_index = intval($rbk['iMaOrder']);
			}
		}
	}
	catch(Exception $e) 
	{ 
		$l_index = 0; 
	}
			 
	$l_index = $l_index + 1;
	$orderID = $orderID.substr("0000", 0,4-strlen(strval($l_index))).$l_index;
	return $orderID;
}

function func_InsertOrder($conn,$orderid,$malichsuphieu,$manv,$tennv)
{
	$l_sResult = "";
	try 
	{
		//----set trang thai = 0 de in order bep tu dong
		$sql = "Insert into tblOrder(OrderID,MaNV,MaLichSuPhieu,ThoiGian,TrangThai,TenNV) values('$orderid','$manv','$malichsuphieu',GETDATE(),'0',N'$tennv')";
		$conn->query($sql);
	} 
	catch (Exception $e)
	{
    	$l_sResult = $e->getMessage();
	}
	return $l_sResult;
}

function func_InsertOrderChiTiet($conn,$orderid,$manv,$malichsuphieu,$mahangban,$madvt,$soluong,$dongia,$thanhtien,$tenhangban,$lydo)
{
	$l_sResult = "";
	try 
	{
		$sql = "Insert into tblOrderChiTiet(OrderID,MaHangBan,MaDVT,SoLuong,DonGia,YeuCauThem,ThoiGian,MaSuCo,TenHangBan,LyDo,MaNVLienQuan,GhiChuKMHB,KeyString) values('$orderid','$mahangban','$madvt','$soluong','$dongia','',GETDATE(),'',N'$tenhangban',N'$lydo','$manv','','')";
		$conn->query($sql);
		//
		//----test ok
		//
		$id_hangban = $malichsuphieu."-".$mahangban."-".(string)date('His');
		$sql = "Insert into tblLSPhieu_HangBan(ID,MaLichSuPhieu,MaHangBan,TenHangBan,SoLuong,MaDVT,DonGia,ThanhTien,MaNhanVien,ThoiGianBan,MaSuCo,LyDo,
		DaXuLy,OrderID,DonGiaTT,MaTienTe,ThanhTienTT,GhiChuKMHB) values('$id_hangban','$malichsuphieu','$mahangban',N'$tenhangban','$soluong','$madvt','$dongia','$thanhtien','$manv',GETDATE(),'',N'$lydo','1','$orderid','$dongia','VND','$thanhtien','')";
		$conn->query($sql);
		//
		//-----update lai tien thuc tra cho lich su phieu: ok
		//
		$sql = "Select Sum(ThanhTien) as TienHangBan From tblLSPhieu_HangBan Where MaLichSuPhieu like '$malichsuphieu'";
		$rs=$conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		if($rs)
		{
			$tiendichvu = 0;
			foreach ($rs as $r1)
			{
				$r1['TienHangBan'];
				$tiendichvu = $r1['TienHangBan'];
			}
			$sql = "Update tblLichSuPhieu Set TienDichVu = '$tiendichvu', TongTien = '$tiendichvu' where MaLichSuPhieu like '$malichsuphieu'";
			$conn->query($sql);

			$sql = "Update tblLichSuPhieu Set TienThucTra = TongTien - TienCoc - TienGiamGia where MaLichSuPhieu like '$malichsuphieu'";
			$conn->query($sql);
		}
	} 
	catch (Exception $e) 
	{
    	$l_sResult = $e->getMessage();
	}
	return $l_sResult;
}

function func_TinhTienThucTra($conn,$malichsuphieu)
{
	$l_sResult = "";
	try 
	{
		$sql = "Select Sum(ThanhTien) as TienHangBan From tblLSPhieu_HangBan Where MaLichSuPhieu like '$malichsuphieu' Group by MaLichSuPhieu";
		$rs=$conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);

			$tiendichvu = 0;
			foreach ($rs as $r1)
			{
				$r1['TienHangBan'];
				$tiendichvu = $tiendichvu + $r1['TienHangBan'];
			}
			$sql = "Update tblLichSuPhieu Set TienDichVu = '$tiendichvu', TongTien = '$tiendichvu' where MaLichSuPhieu like '$malichsuphieu'";
			$conn->query($sql);

			$sql = "Update tblLichSuPhieu Set TienThucTra = TongTien - TienCoc - TienGiamGia where MaLichSuPhieu like '$malichsuphieu'";
			$conn->query($sql);
	} 
	catch (Exception $e) 
	{
    	$l_sResult = $e->getMessage();
	}
	return $l_sResult;
}

function func_InXuongBep($conn,$malichsuphieu, $orderid)
{
	if($malichsuphieu != "")
	{
		$coorder = 0;
		$inbep_mahangban = ""; $inbep_mabep = ""; $inbep_orderid = ""; $inbep_soluong = 1;
		$inbep_tenhangban = ""; $inbep_madvt = ""; $inbep_sophut = 0; $inbep_dongia = 0;
		$inbep_maban = ""; $inbep_ktv = ""; $inbep_ghichumon = "";
		//
		//----lay thong tin order có mã bếp
		//
		$sql = "Select a.*, b.MaBep, b.ThoiGianLam, c.MaBan, c.NVPhucVu from tblOrderChiTiet a Inner join (select MaBep, f.MaHangBan, ISNULL(f.ThoiGianLam,0) as ThoiGianLam from (Select kh.*, PrinterName from tblDMKhu_Kho kh, tblDMBep bep Where kh.MaBep = bep.MaBep) e, tblDMHangBan f Where e.NhomHang = f.MaNhomHangBan Group by MaBep,f.MaHangBan,f.ThoiGianLam) b On a.MaHangBan = b.MaHangBan Inner join (Select g.OrderID, h.MaBan, h.NVPhucVu from tblLSPhieu_HangBan g, tblLichSuPhieu h where g.MaLichSuPhieu = h.MaLichSuPhieu and g.MaLichSuPhieu like '$malichsuphieu') c On a.OrderID = c.OrderID and a.OrderID like '$orderid' Order by a.OrderID desc";
		//echo "sql:".$sql;
		try
    	{
      		$rs=$conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      		if($rs !== false)
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
            		$r['MaBan'];
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
            		$inbep_maban = $r['MaBan'];
            		$inbep_ktv = $r['NVPhucVu'];
            		$inbep_ghichumon = $r['YeuCauThem'];

            		$timestamptemp = date('Y-m-d H:i');
    				$timestemptemp1 = $timestamptemp." + ".$inbep_sophut." minute"; 
					$inbep_thoigianketthuc = strtotime($timestemptemp1);

            		$sql1 = "Insert into tblYeuCauBep(ID,MaBep,MaLichSuPhieu,MaHangBan,SoLuong,YeuCauThem,NgayGio,TinhTrang,TenHangBan,MaDVT,OrderID,DaIn,SoLanIn,ThoiGianLamXong) values('$idorder','$inbep_mabep','$malichsuphieu','$inbep_mahangban','$inbep_soluong',N'$inbep_ghichumon','".date('Y-m-d H:i:s')."','1',N'$inbep_tenhangban','$inbep_madvt','$inbep_orderid','0','0','".date('Y-m-d H:i:s',$inbep_thoigianketthuc)."')";
            			//echo "sql1:".$sql1; //-> insert ok
            		$rs1 = $conn->query($sql1);

            		$sql2 = "Insert into tblYeuCauBepIn_Pocket(ID,MaLichSuPhieu,MaBan,MaHangBan,TenHangBan,SoLuong,MaDVT,MaBep,YeuCauThem,NgayGio,OrderID,DonGia) values('$idorder','$malichsuphieu','$inbep_maban','$inbep_mahangban',N'$inbep_tenhangban','$inbep_soluong','$inbep_madvt','$inbep_mabep',N'$inbep_ghichumon','".date('Y-m-d H:i:s')."','$inbep_orderid','$inbep_dongia')";
            			//echo "sql2:".$sql2; //-> insert ok
            		$rs2 = $conn->query($sql2);
        		}
      		}
    	}
    	catch (Exception $e) {
        		echo $e->getMessage();
    	}
		//
		//----xu ly update gio lam
		//
		//if($inbep_sophut > 0 && $inbep_mahangban != "")
		//{
		//	$sql = "Update tblLichSuPhieu set MaDichVuDieuTour = '$inbep_mahangban',DichVuDieuTour=N'$inbep_tenhangban',ThoiGianLam = '$inbep_sophut',GioVao = '".date('Y-m-d H:i:s')."',GioTra='".date('Y-m-d H:i:s',$inbep_thoigianketthuc)."' Where MaLichSuPhieu = '$malichsuphieu'";
		//	$rs=sqlsrv_query($conn,$sql);
		//}
	}
}

function func_KetThucPhieu($conn,$malichsuphieu,$httt)
{
	$l_sResult = "";
	try 
	{
		$sql = "Select Sum(ThanhTien) as TienHangBan From tblLSPhieu_HangBan Where MaLichSuPhieu like '$malichsuphieu' Group by MaLichSuPhieu";
		$rs=$conn->query($sql);

			$tiendichvu = 0;
			foreach ($rs as $r1)
			{
				$r1['TienHangBan'];
				$tiendichvu = $tiendichvu + $r1['TienHangBan'];
			}
			$sql = "Update tblLichSuPhieu Set TienDichVu = '$tiendichvu', TongTien = '$tiendichvu' where MaLichSuPhieu like '$malichsuphieu'";
			$rs=$conn->query($sql);

			$sql = "Update tblLichSuPhieu Set TienThucTra = TongTien - TienCoc - TienGiamGia where MaLichSuPhieu like '$malichsuphieu'";
			$rs=$conn->query($sql);

		//
		//----lay tien thuc tra
		//
		$tienthuctra = 0; $mathevip = ""; $ghinodv = 0; $ghinott = 0; $ngungthe = 0; $ngaykethuc = "";
		$sql = "Select a.TienThucTra, a.MaTheVip, b.IsGhiNoDV, b.IsGhiNoTT, b.NgungThe, b.NgayKetThuc From tblLichSuPhieu a Left join tblKhachHang_TheVip b On a.MaTheVip = b.MaTheVip Where a.MaLichSuPhieu like '$malichsuphieu'";
		$rs=$conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		if($rs !== false)
		{
			$tienthuctra = 0;
			foreach ($rs as $r1)
			{
				$r1['TienThucTra'];
				$r1['MaTheVip'];
				$r1['IsGhiNoDV'];
				$r1['IsGhiNoTT'];
				$r1['NgungThe'];

				$tienthuctra = $r1['TienThucTra'];
				$mathevip = $r1['MaTheVip'];
				if($mathevip != "")
				{
					$ghinott = $r1['IsGhiNoTT'];
					$ghinodv = $r1['IsGhiNoDV'];
					$ngungthe = $r1['NgungThe'];
				}
			}
		}
		//
		//----xử lý hình thức thanh toán
		//
		if($tienthuctra > 0)
		{
			// httt: tienmat, credit, theghino
			if($httt == "theghino")
			{
				//$l_sResult = "Hình thức thanh toán này chưa được hỗ trợ";
				if($mathevip == "")
				{
					$l_sResult = "Chưa có thông tin thẻ vip";
				}
				else if($ngungthe == 1)
				{
					$l_sResult = "Thẻ khách hàng đã bị tạm ngưng";
				}
				else if($ghinodv == 0 && $ghinott == 0)
				{
					$l_sResult = "Thẻ khách hàng không phải là thẻ ghi nợ";
				}
				else if($ghinodv == 1)
				{
					//----------xử lý trừ thẻ dịch vụ --------//
					$mahangban = ""; $l_iSoLuongHB = 0;
					$sql1 = "Select MaHangBan, Sum(SoLuong) as SoLuong from tblLSPhieu_HangBan Where MaLichSuPhieu like '$malichsuphieu' Group by MaHangBan having sum(SoLuong) > 0";
					$rs1 = $conn->query($sql1)->fetchAll(PDO::FETCH_ASSOC);
					if($rs1 !== false)
					{
						foreach($rs1 as $r1)
						{
							$r1['MaHangBan'];
							$r1['SoLuong'];
							$mahangban = $r1['MaHangBan'];
							$l_iSoLuongHB = $r1['SoLuong'];

							$sql1 = "Select * from tblTheVip_GhiNoDV Where MaTheVip like '$mathevip' and MaHangBan like '$mahangban' and ConLai >= '$l_iSoLuongHB'";
							$rs11 = $conn->query($sql1)->fetchAll(PDO::FETCH_ASSOC);
							if($rs11 !== false)
							{
								foreach($rs11 as $r11)
								{
									$sql11 = "Update tblTheVip_GhiNoDV Set DaSuDung = DaSuDung + ".$l_iSoLuongHB.", ConLai = ConLai - ".$l_iSoLuongHB." Where MaTheVip like '$mathevip' and MaHangBan like '$mahangban'";
									$rs111 = $conn->query($sql11);
								}
							}
							else
							{
								$l_sResult = "Số dư trong thẻ không đủ để sử dụng";
							}
						}

						if($l_sResult == "")
						{
							$sql = "Insert into tblLSPhieu_CTThanhToan(MaLichSuPhieu,MaTienTe, SoThe,TyGia,SoTien, SoTienNT, TraLai) values('$malichsuphieu','VND','','1','$tienthuctra','$tienthuctra','0')";
							$rs=$conn->query($sql);

							$sql = "Update tblLichSuPhieu Set IsSDTheVip = 1, IsSDTheGhiNoDV = 1 Where MaLichSuPhieu like '$malichsuphieu'";
							$rs=$conn->query($sql);
						}
					}//end if($rs1 !== false) lich su phieu hang ban
				}//end if($ghinodv == 1)
				else if($ghinott == 1)
				{
					//-----------xử lý trừ thẻ tiền ----------//
					$sql2 = "Select * from tblTheVip_GhiNoTT Where MaTheVip like '$mathevip' and ConLai >= '$tienthuctra'";
					$rs2 = $conn->query($sql2)->fetchAll(PDO::FETCH_ASSOC);
					if($rs2 !== false)
					{
						foreach($rs2 as $r2)
						{
							$sql22 = "Update tblTheVip_GhiNoTT Set DaSuDung = DaSuDung + ".$tienthuctra.", ConLai = ConLai - ".$tienthuctra." Where MaTheVip like '$mathevip'";
							$rs22 = $conn->query($sql22);
						}
					}
					else
					{
						$l_sResult = "Số dư trong thẻ không đủ để sử dụng";
					}

					if($l_sResult == "")
					{
						$sql = "Insert into tblLSPhieu_CTThanhToan(MaLichSuPhieu,MaTienTe, SoThe,TyGia,SoTien, SoTienNT, TraLai) values('$malichsuphieu','VND','','1','$tienthuctra','$tienthuctra','0')";
						$rs=$conn->query($sql);

						$sql = "Update tblLichSuPhieu Set IsSDTheVip = 1, IsSDTheGhiNoTT = 1 Where MaLichSuPhieu like '$malichsuphieu'";
						$rs=$conn->query($sql);
					}
				}//end if($ghinott == 1)
			}
			else if($httt == "tienmat")
			{
				$sql = "Insert into tblLSPhieu_CTThanhToan(MaLichSuPhieu,MaTienTe, SoThe,TyGia,SoTien, SoTienNT, TraLai) values('$malichsuphieu','VND','','1','$tienthuctra','$tienthuctra','0')";
				$rs=$conn->query($sql);
			}
			else if($httt == "credit")
			{
				$sql = "Insert into tblLSPhieu_CTThanhToan(MaLichSuPhieu,MaTienTe, SoThe,TyGia,SoTien, MaLoaiThe, SoTienNT, TraLai) values('$malichsuphieu','VND','','1','$tienthuctra','CREDIT','$tienthuctra','0')";
				$rs=$conn->query($sql);
			}
			//
			//--------xử lý kết thúc phiếu nếu không có lỗi xảy ra
			//
			if($l_sResult == "")
			{
				$sql = "Update tblLichSuPhieu set ThoiGianDongPhieu = getdate(), DangNgoi = 0, DaTraDu = 1, DaTinhTien = 1 Where MaLichSuPhieu like '$malichsuphieu'";
				$rs=$conn->query($sql);
			}
		}//if($tienthuctra > 0)
	} 
	catch (Exception $e) 
	{
    	$l_sResult = $e->getMessage();
	}

	return $l_sResult;
}
?>
	
		
	