<?php
ini_set('mssql.charset', 'UTF-8');

class KhachHang {
	public $MaKH = "";
	public $TenKH = "";
	public $MaNhomKH = "";
	public $DienThoai = "";
	public $DienThoaiDD = "";
	public $Email = "";
	public $DiaChi = "";
	public $GhiChu = "";
	public $MaTheVip = "";
	public $LoaiTheVip = "";
	public $NguoiGioiThieu = "";
	public $MaTrungTam = "01";
	public $GioiTinhNam = 1;
	public $MaNhanVien = "";
	public $SoDiem = 0;
	public $TongTien = 0;
}

class HangBan {
	public $MaHangBan = "";
	public $TenHangBan = "";
	public $MaDVT = "";
	public $MaNhomHB = "";
	public $ThuTuHienThi = 0;
	public $ChoPhepSuaGia = 0;
	public $IdGiaBan = "";
	public $GiaBan = 0;
	public $MaKhuApDung = "";
	public $ThoiGianLam = 0;
}

class NhanVien {
	public $MaNV = "";
	public $TenNV = "";
	public $MaNhomNV = "";
	public $MaTrungTam = "";
	public $GhiChuDichVu = "";
	public $MaVanTay = "";
	public $LuongCoBan = 0;
	public $LuongPhuCap = 0;
	public $SoNgayLamViec = 28;
}

class SPA {
	
	/* Properties */
    private $conn;

    /* Get database access */
    public function __construct(\PDO $dbCon) {
        $this->conn = $dbCon;
    }
    //
    //-----UPDATE: 15/09/2021
    //
    public function getDataSource($sql)
    {
    	try 
		{			
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_BOTH );
		
			return $rs;
		}
		catch ( PDOException $error)
		{
			echo $error->getMessage();
		}
    }

    public function getTrungTam(&$count = NULL) {

		$sql = "SELECT * from [tblDMTrungTam] Order by CoSoHienTai Desc";
		try 
		{
			$stmt = $this->conn->prepare( $sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$count = (int) $stmt->rowCount();
			
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		
			return $rs;
		}
		catch ( PDOException $error )
		{
			echo $error->getMessage();
		}
	}

	public function getKhu($chinhanh, &$count = NULL) {
		if($chinhanh == "" || $chinhanh == "all") $chinhanh = "%%";

		$sql = "SELECT  MaKhu, MoTa, SUBSTRING(MaKhu,4,10) as MK from [tblDMKhu] Where MaTrungTam like '$chinhanh' AND MaKhu in (Select MaKhu from tblDMBan) order by MoTa";
		try 
		{
			$stmt = $this->conn->prepare( $sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$count = (int) $stmt->rowCount();
			
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		
			return $rs;
		}
		catch ( PDOException $error )
		{
			echo $error->getMessage();
		}
	}

	public function getKhuCha($chinhanh, &$count = NULL) {
		if($chinhanh == "" || $chinhanh == "all") $chinhanh = "%%";

		$sql = "SELECT  MaKhu, MoTa from tblDMKhu Where MaTrungTam like '$chinhanh' AND MaKhuCha is NULL Group by MaKhu, MoTa";
		try 
		{
			$stmt = $this->conn->prepare( $sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$count = (int) $stmt->rowCount();
			
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		
			return $rs;
		}
		catch ( PDOException $error )
		{
			echo $error->getMessage();
		}
	}

	public function getKho($chinhanh, &$count = NULL) {
		if($chinhanh == "" || $chinhanh == "all") $chinhanh = "%%";

		$sql = "SELECT * from tblDMKho Where MaTrungTam like '$chinhanh' AND MaKho in (Select MaKho from tblTonKhoPhatSinh Group by MaKho) order by MaKho";
		try 
		{
			$stmt = $this->conn->prepare( $sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$count = (int) $stmt->rowCount();
			
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		
			return $rs;
		}
		catch ( PDOException $error )
		{
			echo $error->getMessage();
		}
	}

	public function getNhomKH(&$count = NULL) {

		$sql = "SELECT * from [tblDMNhomKH] Order by ThuTuHienThi";
		try 
		{
			$stmt = $this->conn->prepare( $sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$count = (int) $stmt->rowCount();
			
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		
			return $rs;
		}
		catch ( PDOException $error )
		{
			echo $error->getMessage();
		}
	}

	public function getLoaiTheVip(&$count = NULL) {

		$sql = "SELECT * from tblDMLoaiTheVip Order by ThuTuCap";
		try 
		{
			$stmt = $this->conn->prepare( $sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			$count = (int) $stmt->rowCount();
			
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		
			return $rs;
		}
		catch ( PDOException $error )
		{
			echo $error->getMessage();
		}
	}
	//
	//			BAO CAO SO LIEU 
	//------UPDATE: 15/09/2021
	//
	//
	//----------------END BAO CAO SO LIEU -----------------------------//
	//
	public function getDoanhThuHangBan($tungay, $denngay, $matrungtam, $manhomkh, $banchay, &$thanhtien = null, &$giamgia = null, &$thuctra = null)
	{
		//$tungay = "2022-05-29 00:00:00";
		//$denngay = "2022-05-29 23:00:00";
		//$matrungtam = "01";
		//$manhomkh = "";
		//$banchay = "";

		$sql = "EXEC spWeb_BaoCaoDoanhThuHangBan @TuNgay = ?,@DenNgay = ?,@MaTrungTam = ?,@MaNhomKH = ?,@BanChay = ?";

		$pro_param = array($tungay,$denngay,$matrungtam,$manhomkh,$banchay);

		try
		{
			$stmt = $this->conn->prepare( $sql);//, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute($pro_param);
		
			$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if($rs !== false)
			{
				$thanhtien = 0; $giamgia = 0; $thuctra = 0;
				foreach($rs as $r)
				{
					$thanhtien = $thanhtien + $r['ThanhTien'];
					$giamgia = $giamgia + $r['GiamGia'];
					$thuctra = $thuctra + $r['ThucTra'];
				}
			}
		
			return $rs;
		}
		catch ( PDOException $e ){
			$error = $e->getMessage();
			//echo $e->getMessage();
		}
	}

	public function getDoanhThuHoaDon_HangBan($tungay, $denngay, $matrungtam, &$thanhtien = null, &$giamgia = null, &$thuctra = null)
	{
		$sql = "EXEC spWeb_BaoCaoDoanhThuHoaDon_HangBan @TuNgay = ?,@DenNgay = ?,@MaTrungTam = ?";

		$pro_param = array($tungay,$denngay,$matrungtam);

		try
		{
			$stmt = $this->conn->prepare( $sql);//, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute($pro_param);
		
			$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if($rs !== false)
			{
				$thanhtien = 0; $giamgia = 0; $thuctra = 0;
				foreach($rs as $r)
				{
					$thanhtien = $thanhtien + $r['ThanhTien'];
					$giamgia = $giamgia + $r['GiamGia'];
					$thuctra = $thuctra + $r['ThucTra'];
				}
			}
		
			return $rs;
		}
		catch ( PDOException $e ){
			$error = $e->getMessage();
			//echo $e->getMessage();
		}
	}

	public function getDoanhThuNhomHangBan($tungay, $denngay, $matrungtam, &$thanhtien = null, &$giamgia = null, &$thuctra = null)
	{
		$sql = "EXEC spWeb_BaoCaoDoanhThuNhomHangBan @TuNgay = ?,@DenNgay = ?,@MaTrungTam = ?";

		$pro_param = array($tungay,$denngay,$matrungtam);

		try
		{
			$stmt = $this->conn->prepare( $sql);//, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute($pro_param);
		
			$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if($rs !== false)
			{
				$thanhtien = 0; $giamgia = 0; $thuctra = 0;
				foreach($rs as $r)
				{
					$thanhtien = $thanhtien + $r['ThanhTien'];
					$giamgia = $giamgia + $r['GiamGia'];
					$thuctra = $thuctra + $r['ThucTra'];
				}
			}
		
			return $rs;
		}
		catch ( PDOException $e ){
			$error = $e->getMessage();
			//echo $e->getMessage();
		}
	}

	public function getChiTietThuChi($tungay, $denngay, &$tongthu = null, &$tongchi = null)
	{
		$sql = "SELECT tc.MaPhieu, tc.LoaiPhieu, tc.NgayLap, tc.LyDo,lp.TenLoaiPhieu,case when tc.LoaiPhieu like '%T%' then tc.TongTien else 0 end as TongThu, case when tc.LoaiPhieu like '%C%' then tc.TongTien else 0 end as TongChi,nv.MaNV as MaNVLap, nv.TenNV AS TenNVLap, khncc.GhiChu, tc.MaKHNCC, tc.TenKHNCC, case when tc.IsChuyenKhoan = 1 then N'Chuyển khoản' else N'Tiền mặt' end as HTTT FROM tblPhieuThuChi tc
                     LEFT JOIN tblDMKHNCC khncc ON khncc.MaDoiTuong= tc.MaKHNCC
                     INNER JOIN tblDMNhanVien nv ON  tc.MaNVLap=nv.MaNV 
                     INNER JOIN tblDMLoaiPhieu lp ON tc.LoaiPhieu = lp.LoaiPhieu 
                     LEFT JOIN dbo.tblDMNhanVien nv1 ON tc.MaNVSua = nv1.MaNV
                     LEFT JOIN dbo.tblDMTrungTam TT ON LEFT(MaPhieu, 2) = TT.MaTrungTam
                     where Convert(varchar,tc.NgayLap,120) >= '$tungay' and Convert(varchar,tc.NgayLap,120) <= '$denngay'";

		try
		{

			//$stmt = $this->conn->prepare( $sql);//, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			//$stmt->execute();
			//$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC); 
			
			if($rs !== false)
			{
				$tongthu = 0; $tongchi = 0;
				foreach($rs as $r)
				{
					$tongthu = $tongthu + $r['TongThu'];
					$tongchi = $tongchi + $r['TongChi'];
				}
			}
		
			return $rs;
		}
		catch ( PDOException $e ){
			$error = $e->getMessage();
			//echo $e->getMessage();
		}
	}
	
	public function getTotalProfit($chinhanh, $tungay, $denngay, $tugio, $dengio, &$totalSale, &$totalReceipt, &$totalOtherPayment, &$totalTIPPayment) {

		if($chinhanh == "" || $chinhanh == "all") $chinhanh = "%%";

		$sql_1 = "SELECT SUM(CASE WHEN 1=1 THEN 1 ELSE 0 END) as TongSoHoaDon, ISNULL(SUM(TongTien),0) as TongTien, ISNULL(SUM(TienThucTra-TienGio),0) as TienThucTra, ISNULL(SUM(TienDichVu),0) as TienDichVu, ISNULL(SUM(TienGio),0) as TienKhachTip, ISNULL(SUM(TienGiamGia),0) as TienGiamGia FROM tblLichSuPhieu a Where PhieuHuy = 0 and DaTinhTien = 1 and ThoiGianDongPhieu is not null and TienThucTra > 0 and Len(Malichsuphieu) = 18 and Left(MaLichSuphieu,2) like '$chinhanh' and 
				substring( Convert(varchar,isnull(ThoiGianDongPhieu,getdate()),126),0,17 ) BETWEEN '{$tungay}T{$tugio}' AND '{$denngay}T{$dengio}'";

		$sql_2 = "SELECT ISNULL(sum(TongTien),0) as TotalMoney 
		 		FROM tblPhieuThuChi a WHERE LoaiPhieu like '%-T%' and ISNULL(GhiNo,0) = 0 and MaTrungTam like '$chinhanh' and 
				substring( Convert(varchar,isnull(NgayLap,getdate()),126),0,17 ) BETWEEN '{$tungay}T{$tugio}' AND '{$denngay}T{$dengio}'";

		$sql_3 = "SELECT ISNULL(sum(TongTien),0) as TotalMoney 
		 		FROM tblPhieuThuChi a WHERE LoaiPhieu like '%-C%' and LoaiPhieu not like 'CHH' and ISNULL(GhiNo,0) = 0 and MaTrungTam like '$chinhanh' and 
				substring( Convert(varchar,isnull(NgayLap,getdate()),126),0,17 ) BETWEEN '{$tungay}T{$tugio}' AND '{$denngay}T{$dengio}'";

		$sql_4 = "SELECT ISNULL(sum(TongTien),0) as TotalMoney 
		 		FROM tblPhieuThuChi a WHERE LoaiPhieu like 'CHH' and MaTrungTam like '$chinhanh' and 
				substring( Convert(varchar,isnull(NgayLap,getdate()),126),0,17 ) BETWEEN '{$tungay}T{$tugio}' AND '{$denngay}T{$dengio}'";
		
		try
		{
			$rs_1 = $this->conn->query($sql_1)->fetch(PDO::FETCH_ASSOC);
			if($rs_1 !== false)
				$totalSale = $rs_1['TienThucTra'];
			
			$rs_2 = $this->conn->query($sql_2)->fetch(PDO::FETCH_ASSOC);
			if($rs_2 !== false)
				$totalReceipt = $rs_2['TotalMoney'];

			$rs_3 = $this->conn->query($sql_3)->fetch(PDO::FETCH_ASSOC);
			if($rs_3 !== false)
				$totalOtherPayment = $rs_3['TotalMoney'];

			$rs_4 = $this->conn->query($sql_4)->fetch(PDO::FETCH_ASSOC);
			if($rs_4 !== false)
				$totalTIPPayment = $rs_4['TotalMoney'];
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getRevenueOfSale($chinhanh, $tungay, $denngay, $tugio, $dengio) {

		if($chinhanh == "" || $chinhanh == "all") $chinhanh = "%%";

		$sql_1 = "SELECT SUM(CASE WHEN 1=1 THEN 1 ELSE 0 END) as TongSoHoaDon, ISNULL(SUM(TongTien),0) as TongTien, ISNULL(SUM(TienThucTra),0) as TienThucTra, ISNULL(SUM(TienDichVu),0) as TienDichVu, ISNULL(SUM(TienGio),0) as TienKhachTip, ISNULL(SUM(TienGiamGia),0) as TienGiamGia, a.MaKhu, b.MaQuay, b.MoTa FROM tblLichSuPhieu a, tblDMKhu b where a.MaKhu = b.MaKhu and PhieuHuy = 0 and DaTinhTien = 1 and ThoiGianDongPhieu is not null and TienThucTra > 0 and Len(Malichsuphieu) = 18 and Left(MaLichSuphieu,2) like '$chinhanh' and substring( Convert(varchar,isnull(ThoiGianDongPhieu,getdate()),126),0,17 ) BETWEEN '{$tungay}T{$tugio}' AND '{$denngay}T{$dengio}' group by a.MaKhu, b.MaQuay, b.MoTa Order by b.MaQuay, a.MaKhu";
	
		try
		{
			$rs_1 = $this->conn->query($sql_1)->fetchAll(PDO::FETCH_ASSOC);
			return $rs_1;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getBillOfSale($chinhanh, $tungay, $denngay, $tugio, $dengio) {

		if($chinhanh == "" || $chinhanh == "all") $chinhanh = "%%";

		$sql_1 = "select b.MoTa as TenKhu, TenKhachHang, MaTheVip, MaLichSuPhieu, Substring(Convert(varchar,isnull(GioVao,getdate()),8),1,5) as GioVao, isnull(GioTra,ThoiGianDongPhieu) as GioTra, NVTinhTienMaNV, MaBan, TongTien,TienGiamGia,TienGio, TienThucTra, TienDichVu, PhieuHuy, GhiChu from tblLichSuPhieu a, tblDMKhu b where ThoiGianDongPhieu is not null and a.MaKhu = b.MaKhu and TienThucTra > 0 and Len(Malichsuphieu) = 18 and Left(MaLichSuphieu,2) like '$chinhanh' and substring( Convert(varchar,isnull(ThoiGianDongPhieu,getdate()),126),0,17 ) BETWEEN '{$tungay}T{$tugio}' AND '{$denngay}T{$dengio}' Order by MaLichSuPhieu, b.MoTa";
	
		try
		{
			$rs_1 = $this->conn->query($sql_1)->fetchAll(PDO::FETCH_ASSOC);
			return $rs_1;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getProductOfSale($matrungtam, $tungay, $denngay, $tugio, $dengio) {

		if($matrungtam == "" || $matrungtam == "all") $matrungtam = "%%";

		$sql_1 = "select a.MaLichSuPhieu, a.MaHangBan, a.TenHangBan, a.SoLuong, a.ThanhTien, a.LyDo, b.PhieuHuy from tblLSPhieu_HangBan a, tblLichSuPhieu b where a.MaLichSuPhieu = b.MaLichSuPhieu and Len(a.Malichsuphieu) = 18 and b.ThoiGianDongPhieu is not null and Left(b.MaLichSuphieu,2) like '$matrungtam' and substring( Convert(varchar,isnull(b.ThoiGianDongPhieu,getdate()),126),0,17 ) BETWEEN '{$tungay}T{$tugio}' AND '{$denngay}T{$dengio}' order by a.MaLichSuPhieu, a.MaHangBan";
	
		try
		{
			$rs_1 = $this->conn->query($sql_1)->fetchAll(PDO::FETCH_ASSOC);
			return $rs_1;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getTopTenItems($chinhanh, $tungay, $denngay, $tugio, $dengio)
	{
		if($chinhanh == "" || $chinhanh == "all") $chinhanh = "%%";
		
		$sql = "SELECT Top 10 * FROM (SELECT distinct TenHangBan, MaDVT, DonGia, TongSoLuong = sum(SoLuong) 
				over (Partition by TenHangBan), ThanhTien = 
				DonGia * sum(SoLuong) over (Partition by TenHangBan)
				FROM tblLSPhieu_HangBan a, tblLichSuPhieu b where a.MaLichSuPhieu = b.MaLichSuPhieu and b.DaTinhTien = 1 and b.PhieuHuy = 0 and b.ThoiGianDongPhieu is not null and Left(a.MaLichSuPhieu,2) like '$chinhanh' and substring(Convert(varchar,isnull(b.ThoiGianDongPhieu,getdate()),126),0,17 ) BETWEEN '{$tungay}T{$tugio}' AND '{$denngay}T{$dengio}') t1 WHERE TongSoLuong > 0 ORDER BY TongSoLuong DESC";
		try {
			$stmt = $this->conn->query($sql);
			$rowset =  array();
			if($stmt !== false)
			{
				do {

			    $rowset[] = $stmt->fetchAll(PDO::FETCH_ASSOC);

				} while ($stmt->nextRowset());
			}

			return $rowset;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getSaledItemsDetails($chinhanh, $tungay, $denngay, $tugio, $dengio, &$totalQty, &$totalMoney ) {

		if($chinhanh == "" || $chinhanh == "all") $chinhanh = "%%";

		$sql = "SELECT  a.TenHangBan, a.MaDVT, a.DonGia, sum(a.SoLuong) as SoLuong, sum(a.ThanhTien) as ThanhTien FROM tblLSPhieu_HangBan a, tblLichSuPhieu b where a.MaLichSuPhieu = b.MaLichSuPhieu and b.DaTinhTien = 1 and b.PhieuHuy = 0 and b.ThoiGianDongPhieu is not null and Left(a.MaLichSuPhieu,2) like '$chinhanh' and substring(Convert(varchar,isnull(b.ThoiGianDongPhieu,getdate()),126),0,17 ) BETWEEN '{$tungay}T{$tugio}' AND '{$denngay}T{$dengio}' Group By TenHangBan, MaDVT, DonGia having sum(a.SoLuong) > 0";

		$sql_1 = "SELECT isnull( sum(a.SoLuong), 0 ) as TotalQty, isnull( sum(a.ThanhTien), 0 ) as TotalMoney 
					FROM tblLSPhieu_HangBan a, tblLichSuPhieu b where a.MaLichSuPhieu = b.MaLichSuPhieu and b.DaTinhTien = 1 and b.PhieuHuy = 0 and b.ThoiGianDongPhieu is not null and Left(a.MaLichSuPhieu,2) like '$chinhanh' and substring(Convert(varchar,isnull(b.ThoiGianDongPhieu,getdate()),126),0,17 ) BETWEEN '{$tungay}T{$tugio}' AND '{$denngay}T{$dengio}'";

		try{

			$rs_1 = $this->conn->query($sql_1)->fetch(PDO::FETCH_ASSOC);
			$totalQty = $rs_1['TotalQty'];
			$totalMoney = $rs_1['TotalMoney'];
			
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getTopTenClients($chinhanh, $tungay, $denngay, $tugio, $dengio)
	{
		if($chinhanh == "" || $chinhanh == "all") $chinhanh = "%%";

		$sql = "SELECT Top 10 * FROM (
				SELECT distinct MaKhachHang, TenDoiTuong, DiaChi, DienThoai, NgayQuanHe, TenNV,
				TongTien = SUM(TienThucTra) OVER (Partition By MaKhachHang)
				FROM tblLichSuPhieu a JOIN tblDMKHNCC b ON a.MaKhachHang = b.MaDoiTuong
		 		LEFT JOIN tblDMNhanVien c ON b.MaNhanVien1 = c.MaNV
		 		WHERE Left(MaLichSuPhieu,2) like '$chinhanh' and 
				substring( Convert(varchar,isnull(ThoiGianDongPhieu,getdate()),126),0,17 ) BETWEEN '{$tungay}T{$tugio}' AND 
				'{$denngay}T{$dengio}'
				And a.TienThucTra > 0) t1 Order by TongTien Desc";

		try{

			$stmt = $this->conn->query($sql);
			$rowset =  array();

			do {

			    $rowset[] = $stmt->fetchAll(PDO::FETCH_ASSOC);

			} while ($stmt->nextRowset());

			return $rowset;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getSalesByClient($chinhanh, $tungay, $denngay, $tugio, $dengio, $khachhang = NULL) {
		if($chinhanh == "" || $chinhanh == "all") $chinhanh = "%%";

			$tungay = $tungay."T".$tugio;
			$denngay = $denngay."T".$dengio;
			$sql = "EXEC spWeb_ListLichSuSuDung @MaTrungTam = ?, @TuNgay = ?, @DenNgay = ?, @KhachHang = ?";
			$pro_param = array($chinhanh,$tungay,$denngay,$khachhang);

		try{

			$stmt = $this->conn->prepare($sql);
			$stmt->execute($pro_param);

			$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getSalesByCashier($chinhanh, $tungay, $denngay, $tugio, $dengio) {
		if($chinhanh == "" || $chinhanh == "all") $chinhanh = "%%";

		$sql = "select distinct a.MaNV, TenNV, a.TenNhomNV, DoanhThu = SUM(TienThucTra) OVER (PARTITION BY NVTinhTienMaNV) FROM (select c.*,d.Ten as TenNhomNV from tblDMNhanVien c, tblDMNhomNhanVien d Where c.NhomNhanVien = d.Ma) a INNER JOIN tblLichSuPhieu b ON a.MaNV = b.NVTinhTienMaNV
				AND Left(b.MaLichSuPhieu,2) like '$chinhanh' AND 
				substring( Convert(varchar,isnull(ThoiGianDongPhieu,getdate()),126),0,17 ) BETWEEN '{$tungay}T{$tugio}' AND 
				'{$denngay}T{$dengio}' ORDER BY DoanhThu DESC";

		try{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getSalesByConsultant($chinhanh, $tungay, $denngay, $tugio, $dengio) {
		if($chinhanh == "" || $chinhanh == "all") $chinhanh = "%%";

		$sql = "select distinct a.MaNV, TenNV, a.TenNhomNV, b.MaHangBan, b.TenHangBan, SoLuong = SUM(SoLuong) OVER (PARTITION By MaHangBan), DoanhThu = SUM(ThanhTien) OVER (PARTITION BY MaHangBan) FROM (select c.*,d.Ten as TenNhomNV from tblDMNhanVien c, tblDMNhomNhanVien d Where c.NhomNhanVien = d.Ma) a INNER JOIN tblLSPhieu_HangBan b ON a.MaNV = b.MaNVPhucVu Where b.MaNVPhucVu is not null AND b.MaNVPhucVu <> '' AND Left(b.MaLichSuPhieu,2) like '$chinhanh' AND 
				substring( Convert(varchar,isnull(ThoiGianBan,getdate()),126),0,17 ) BETWEEN '{$tungay}T{$tugio}' AND 
				'{$denngay}T{$dengio}' ORDER BY DoanhThu DESC";

		try {
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getSalesByPartner($chinhanh, $tungay, $denngay, $tugio, $dengio) {
		if($chinhanh == "" || $chinhanh == "all") $chinhanh = "%%";

		$sql = "select distinct a.MaDoiTuong, a.TenDoiTuong, a.DienThoai, a.DienThoaiDD, a.DiaChi, a.Email, a.TenNhomKH, DoanhThu = SUM(TienThucTra) OVER (PARTITION BY DoiTacGioiThieu) FROM (select c.*,d.Ten as TenNhomKH from tblDMKHNCC c, tblDMNhomKH d Where c.MaNhomKH = d.Ma) a INNER JOIN tblLichSuPhieu b ON a.MaDoiTuong = b.DoiTacGioiThieu AND Left(b.MaLichSuPhieu,2) like '$chinhanh' AND 
				substring( Convert(varchar,isnull(ThoiGianDongPhieu,getdate()),126),0,17 ) BETWEEN '{$tungay}T{$tugio}' AND 
				'{$denngay}T{$dengio}' ORDER BY DoanhThu DESC";

		try {
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}
	//
	//----------------END BAO CAO SO LIEU -----------------------------//
	//
	public function countOccupiedTables( $date, $ma_khu = NULL )  {
		if ( $ma_khu == NULL Or $ma_khu == 'all')
		{
			$sql = "SELECT count(*) FROM [tblLichSuPhieu] where [ThoiGianDongPhieu] IS NULL and substring( Convert(varchar,[GioVao],111),0,11 ) = '$date'";
		}
		else {
			$sql = "SELECT count(*) FROM
			( SELECT a.MaBan, b.[MaKhu]  FROM [tblLichSuPhieu] a Left join
				 [tblDMBan] b ON a.MaBan=b.MaBan Left join
				 [tblDMKhu] c ON b.MaKhu=c.MaKhu where [ThoiGianDongPhieu] IS NULL and substring( Convert(varchar,[GioVao],111),0,11 ) = '$date' and  b.[MaKhu]='$ma_khu' ) t1";
		}
		try 
		{
			$nRows = $this->conn->query($sql)->fetchColumn(); 
			return $nRows;

		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function countTotalTables( $ma_khu = NULL )  {
		if ( $ma_khu == NULL Or $ma_khu == 'all' )
		{
			$sql = "SELECT count(*) FROM [tblDMBan]";
		}
		else
		{
			 $sql = " SELECT count(*) from ( SELECT * FROM [tblDMBan] where MaKhu ='$ma_khu' ) t1 ";

		}
		try 
		{
			$nRows = $this->conn->query($sql)->fetchColumn(); settype($nRows,'int');
			return $nRows;

		}
		catch ( PDOException $error )
		{
			echo $error->getMessage();
		}
	}

	public function getTotalTablesWithBills( $tungay, $denngay, $tugio, $dengio, $ma_khu = NULL)  {
		if( $ma_khu == NULL Or $ma_khu == 'all')
		{
			$sql = "SELECT count(*) FROM
		 	 ( SELECT MaBan, count(*) as SoLuong FROM [tblLichSuPhieu] where Convert(varchar,isnull(ThoiGianDongPhieu,getdate()),111) >= '$tungay' and Convert(varchar,isnull(ThoiGianDongPhieu,getdate()),111) <= '$denngay' 	and Substring(Convert(varchar,isnull(ThoiGianDongPhieu,getdate()),8),1,5) >= '$tugio' and Substring(Convert(varchar,isnull(ThoiGianDongPhieu,getdate()),8),1,5) <= '$dengio' group by MaBan ) t1
			";
		}
		else
		{
			$sql = "SELECT count(*) FROM
		 	( SELECT a.MaBan, count(*) as SoLuong FROM [tblLichSuPhieu] a Left join
			 [tblDMBan] b ON a.MaBan=b.MaBan Left join
			 [tblDMKhu] c ON b.MaKhu=c.MaKhu
  			 where Convert(varchar,isnull(ThoiGianDongPhieu,getdate()),111) >= '$tungay' and Convert(varchar,isnull(ThoiGianDongPhieu,getdate()),111) <= '$denngay' 	and Substring(Convert(varchar,isnull(ThoiGianDongPhieu,getdate()),8),1,5) >= '$tugio' and Substring(Convert(varchar,isnull(ThoiGianDongPhieu,getdate()),8),1,5) <= '$dengio' and b.[MaKhu]='$ma_khu' group by a.MaBan) t1
			";
		}
		try 
		{
			$nRows = $this->conn->query($sql)->fetchColumn(); 
			return $nRows;
		}
		catch ( PDOException $error )
		{
			echo $error->getMessage();
		}
	}

	public function getClientNoByWeek( $from ) {
		 $sql = "DECLARE @StartDate AS VARCHAR(100)='$from'
 
			SELECT CONVERT(INT, SUM(CASE WHEN substring(Convert(varchar,[NgayQuanHe],111),0,11) 
			= @StartDate Then 1 Else 0 END) ) as T2,
			CAST( SUM(CASE WHEN substring(Convert(varchar,[NgayQuanHe],111),0,11) 
			=  DATEADD(DAY, 1, @StartDate) Then 1 Else 0 END) As Int) as T3,
			CAST( SUM(CASE WHEN substring(Convert(varchar,[NgayQuanHe],111),0,11) 
			=  DATEADD(DAY, 2, @StartDate) Then 1 Else 0 END)  As Int) as T4,
			CAST( SUM(CASE WHEN substring(Convert(varchar,[NgayQuanHe],111),0,11) 
			=  DATEADD(DAY, 3, @StartDate) Then 1 Else 0 END)  As Int) as T5,
			CAST( SUM(CASE WHEN substring(Convert(varchar,[NgayQuanHe],111),0,11) 
			=  DATEADD(DAY, 4, @StartDate) Then 1 Else 0 END)  As Int) as T6,
			CAST( SUM(CASE WHEN substring(Convert(varchar,[NgayQuanHe],111),0,11) 
			=  DATEADD(DAY, 5, @StartDate) Then 1 Else 0 END)  As Int) as T7,
			CAST( SUM(CASE WHEN substring(Convert(varchar,[NgayQuanHe],111),0,11) 
			=  DATEADD(DAY, 6, @StartDate) Then 1 Else 0 END)  As Int) as CN
			FROM [tblDMKHNCC]";

		try 
			{
				$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC); 
				return $rs;

			}
			catch ( PDOException $error )
			{
				echo $error->getMessage();
			}
	}

	public function getClientNoByMonth(  $date_range, $datediff ) {
		$sql = "";
		$sql .= "SELECT ";

		$i = 1;
		foreach ($date_range as $dt) {
		    $sql .= "SUM(CASE WHEN substring(convert(varchar, NgayQuanHe, 126),0,11) ='" . $dt->format("Y-m-d") . "' 
		    Then 1 Else 0 END) As Day_";
		    $sql .= ($i <= 9) ? "0" . $i : $i;
		    
		    if ( $i < $datediff) $sql .= ",";
		    $i++;
		}

		$sql .= "
		    FROM tblDMKHNCC
		";


		try 
		{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC); 
			return $rs;

		}
		catch ( PDOException $error )
		{
			echo $error->getMessage();
		}
	}

	function getClientNoByYear( $month_range, $month_diff ) {
		$sql = "";
		$sql .= "SELECT ";

		$i = 1;
		foreach ($month_range as $dt) {
		    $sql .= "SUM(CASE WHEN substring(convert(varchar, NgayQuanHe, 126),0,8) ='" . $dt->format("Y-m") . "' 
		    Then 1 Else 0 END) As " . $dt->format("M_Y");
		    
		    if ( $i < $month_diff) $sql .= ",";
		    $i++;
		}

		$sql .= "
		    FROM tblDMKHNCC
		";


		try 
		{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC); 
			return $rs;

		}
		catch ( PDOException $error )
		{
			echo $error->getMessage();
		}
	}

	public function getClientRevByWeek( $from ) {
		$sql = "";
		$sql = "DECLARE @StartDate AS VARCHAR(100)='$from' 
		SELECT CONVERT(INT, SUM(CASE WHEN substring(Convert(varchar,[GioVao],126),0,11) 
		= @StartDate Then TienThucTra Else 0 END) ) as T2,
		CAST( SUM(CASE WHEN substring(Convert(varchar,[GioVao],111),0,11) 
		=  DATEADD(DAY, 1, @StartDate) Then TienThucTra Else 0 END) As Int) as T3,
		CAST( SUM(CASE WHEN substring(Convert(varchar,[GioVao],111),0,11) 
		=  DATEADD(DAY, 2, @StartDate) Then TienThucTra Else 0 END)  As Int) as T4,
		CAST( SUM(CASE WHEN substring(Convert(varchar,[GioVao],111),0,11) 
		=  DATEADD(DAY, 3, @StartDate) Then TienThucTra Else 0 END)  As Int) as T5,
		CAST( SUM(CASE WHEN substring(Convert(varchar,[GioVao],111),0,11) 
		=  DATEADD(DAY, 4, @StartDate) Then TienThucTra Else 0 END)  As Int) as T6,
		CAST( SUM(CASE WHEN substring(Convert(varchar,[GioVao],111),0,11) 
		=  DATEADD(DAY, 5, @StartDate) Then TienThucTra Else 0 END)  As Int) as T7,
		CAST( SUM(CASE WHEN substring(Convert(varchar,[GioVao],111),0,11) 
		=  DATEADD(DAY, 6, @StartDate) Then TienThucTra Else 0 END)  As Int) as CN
		FROM  tblLichSuPhieu Where MaTheVip = '' or MaTheVip IS  NULL
	
		SELECT CONVERT(INT, SUM(CASE WHEN substring(Convert(varchar,[GioVao],126),0,11) 
		= @StartDate Then TienThucTra Else 0 END) ) as T2,
		CAST( SUM(CASE WHEN substring(Convert(varchar,[GioVao],111),0,11) 
		=  DATEADD(DAY, 1, @StartDate) Then TienThucTra Else 0 END) As Int) as T3,
		CAST( SUM(CASE WHEN substring(Convert(varchar,[GioVao],111),0,11) 
		=  DATEADD(DAY, 2, @StartDate) Then TienThucTra Else 0 END)  As Int) as T4,
		CAST( SUM(CASE WHEN substring(Convert(varchar,[GioVao],111),0,11) 
		=  DATEADD(DAY, 3, @StartDate) Then TienThucTra Else 0 END)  As Int) as T5,
		CAST( SUM(CASE WHEN substring(Convert(varchar,[GioVao],111),0,11) 
		=  DATEADD(DAY, 4, @StartDate) Then TienThucTra Else 0 END)  As Int) as T6,
		CAST( SUM(CASE WHEN substring(Convert(varchar,[GioVao],111),0,11) 
		=  DATEADD(DAY, 5, @StartDate) Then TienThucTra Else 0 END)  As Int) as T7,
		CAST( SUM(CASE WHEN substring(Convert(varchar,[GioVao],111),0,11) 
		=  DATEADD(DAY, 6, @StartDate) Then TienThucTra Else 0 END)  As Int) as CN
		FROM  tblLichSuPhieu Where MaTheVip <> '' or MaTheVip IS NOT NULL";

		try 
			{
				$stmt = $this->conn->query($sql);

			  	$rowset =  array();

				do {

				    $rowset[] = $stmt->fetchAll(PDO::FETCH_ASSOC);
				    
				} while ($stmt->nextRowset());

				return $rowset;

			}

		catch ( PDOException $error )
			{
				echo $error->getMessage();
			}
	}

	public function getClientRevByMonth(  $date_range, $datediff ) {
		$sql = "";
		$sql .= "SELECT ";

		$i = 1;
		foreach ($date_range as $dt) {
		    $sql .= "SUM(CASE WHEN substring(convert(varchar, GioVao, 126),0,11) ='" . $dt->format("Y-m-d") . "' 
		    Then TienThucTra Else 0 END) As '" . $dt->format("Y-m-d") . "'";
		    
		    if ( $i < $datediff) $sql .= ",";
		    $i++;
		}

		$sql .= "
		   FROM  tblLichSuPhieu Where MaTheVip = '' or MaTheVip IS  NULL 

		";

		$sql .= "SELECT ";
		$i = 1;
		foreach ($date_range as $dt) {
		    $sql .= "SUM(CASE WHEN substring(convert(varchar, GioVao, 126),0,11) ='" . $dt->format("Y-m-d") . "' 
		    Then TienThucTra Else 0 END) As '" . $dt->format("Y-m-d") . "'";
		    
		    if ( $i < $datediff) $sql .= ",";
		    $i++;
		}

		 $sql .= "
		   FROM  tblLichSuPhieu Where MaTheVip <> '' or MaTheVip IS NOT NULL
		";

		try 
		{
			$stmt = $this->conn->query($sql);

		  	$rowset =  array();

			do {

			    $rowset[] = $stmt->fetchAll(PDO::FETCH_ASSOC);
			    
			} while ($stmt->nextRowset());

			return $rowset;

		}
		catch ( PDOException $error )
		{
			echo $error->getMessage();
		}
	}

	public function getClientRevByYear(  $month_range, $month_diff ) 
	{
		$sql = "";
		$sql .= "SELECT ";

		$i = 1;
		foreach ($month_range as $dt) {
		    $sql .= "SUM(CASE WHEN substring(convert(varchar, GioVao, 126),0,8) ='" . $dt->format("Y-m") . "' 
		    Then TienThucTra Else 0 END) As '" . $dt->format("Y-m") . "'";
		    
		    if ( $i < $month_diff) $sql .= ",";
		    $i++;
		}

		$sql .= "
		   FROM  tblLichSuPhieu Where MaTheVip = '' or MaTheVip IS  NULL 

		";

		$sql .= "SELECT ";
		$i = 1;
		foreach ($month_range as $dt) {
		    $sql .= "SUM(CASE WHEN substring(convert(varchar, GioVao, 126),0,8) ='" . $dt->format("Y-m") . "' 
		    Then TienThucTra Else 0 END) As '" . $dt->format("Y-m") . "'";
		    
		    if ( $i < $month_diff) $sql .= ",";
		    $i++;
		}

		 $sql .= "
		   FROM  tblLichSuPhieu Where MaTheVip <> '' or MaTheVip IS NOT NULL
		";

		try 
		{
			$stmt = $this->conn->query($sql);

		  	$rowset =  array();

			do {

			    $rowset[] = $stmt->fetchAll(PDO::FETCH_ASSOC);
			    
			} while ($stmt->nextRowset());

			return $rowset;

		}
		catch ( PDOException $error )
		{
			echo $error->getMessage();
		}
	}
	//
	//----------KHACH HANG -------------------//
	//
	public function getKhachHang($makh,$mathevip = NULL){
		$kh = new KhachHang();
		$sql = "select a.MaDoiTuong, a.TenDoiTuong, a.MaNhomKH, a.DienThoai, a.DienThoaiDD, a.DiaChi, a.Email, a.GhiChu, b.MaTheVip, b.LoaiTheVip,ISNULL(SoDiem,0) as SoDiem, ISNULL(TongTien,0) as TongTien from tblDMKHNCC a LEFT JOIN tblKhachHang_TheVip b ON a.MaDoiTuong = b.MaKhachHang Where a.MaDoiTuong like '$makh'";
		if($mathevip != NULL)
			$sql = $sql." and b.MaTheVip like '".$mathevip."'";

		try 
		{
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			
			$rs = $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
			if($rs !== false)
			{
				$kh->MaKH = $rs['MaDoiTuong'];
				$kh->TenKH = $rs['TenDoiTuong'];
				$kh->MaNhomKH = $rs['MaNhomKH'];
				$kh->DienThoai = $rs['DienThoai'];
				$kh->DienThoaiDD = $rs['DienThoaiDD'];
				$kh->DiaChi = $rs['DiaChi'];
				$kh->Email = $rs['Email'];
				$kh->GhiChu = $rs['GhiChu'];
				$kh->MaTheVip = $rs['MaTheVip'];
				$kh->LoaiTheVip = $rs['LoaiTheVip'];
				$kh->SoDiem = $rs['SoDiem'];
				$kh->TongTien = $rs['TongTien'];
			}

			return $kh;
		}
		catch ( PDOException $error )
		{
			echo $error->getMessage();
		}
	}

	public function updateKhachHang(KhachHang $kh,$makhcu, $daco) {
		$sql = "EXEC spWeb_Update_ThongTinKhachHang @MaDoiTuong = ?,@TenDoiTuong = ?,@MaNhomKH = ?,
		@DiaChi = ?,@Email = ?,@DienThoai = ?,@DienThoaiDD = ?,@NguoiGioiThieu = ?,@GhiChu = ?,@MaNhanVien = ?,@MaTrungTam = ?,@GioiTinhNam = ?,@DaCo = ?,@MaKHCu = ?";
		try
		{
			$stmt = $this->conn->prepare( $sql);//, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

			$pro_param = array($kh->MaKH,$kh->TenKH,$kh->MaNhomKH,$kh->DiaChi,$kh->Email,
				$kh->DienThoai,$kh->DienThoaiDD, $kh->NguoiGioiThieu, $kh->GhiChu,
				$kh->MaNhanVien,$kh->MaTrungTam, $kh->GioiTinhNam,$daco,$makhcu);

			$stmt->execute($pro_param);
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function deleteKhachHang($makh) {
		$sql = "Delete from tblDMKHNCC Where MaDoiTuong like '$makh'";
		try
		{
			$stmt = $this->conn->prepare( $sql);
			$stmt->execute();
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getClientsWithCard($khachhang, $manhomkh, $maloaithe, &$totalKH = null)
	{
		$sql = "EXEC spWeb_ListKhachHang_TheVip @Text = ?,@MaNhomKH = ?,@MaLoaiThe = ?";	
		
		try
		{
			$stmt = $this->conn->prepare( $sql);//, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			//$stmt->bindValue(':Text', $khachhang);
			//$stmt->bindValue(':MaNhomKH', $manhomkh);
			//$stmt->bindValue(':MaLoaiThe', $maloaithe);

			$stmt->bindParam(1, $khachhang);
			$stmt->bindParam(2, $manhomkh);
			$stmt->bindParam(3, $maloaithe);

			$stmt->execute();
			
			$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$totalKH = count($rs);
		
			return $rs;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getClientAppointments( $tungay, $denngay, $tugio, $dengio )
	{
		  $sql = " SELECT a.*, b.* FROM [tblKhachHangBooking] a JOIN tblDMNhanVien b ON a.MaNV = b.MaNV
			Where substring( Convert(varchar,isnull(GioBatDau,getdate()),126),0,17 ) BETWEEN '{$tungay}T{$tugio}' AND 
				'{$denngay}T{$dengio}'";

		try
		{

			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getPrepaidCard($loaitheghino, $khachhang) {

		$sql = "EXEC spWeb_ListTheGhiNo @LoaiTheGhiNo = ?, @KhachHang = ?";
		$pro_param = array($loaitheghino,$khachhang);

		try{

			$stmt = $this->conn->prepare($sql);
			$stmt->execute($pro_param);

			$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}
	//
	//------------HANG BAN --------------------//
	//
	public function getNhomHangBan($nhomhangban,&$totalNhomHB)
	{
		$nhomhangban = "%".$nhomhangban."%";

		$sql = "Select * from tblDMNhomHangBan Where (Ma like N'$nhomhangban' OR Ten like N'$nhomhangban') AND Ma IN (Select MaNhomHangBan from tblDMHangBan Group by MaNhomHangBan) Order by ThuTuTrinhBay";
		
		try
		{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			$totalNhomHB = count($rs);
			return $rs;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getDonViTinh()
	{
		$sql = "Select * from tblDMDonViTinh Order by TenDVT";
		
		try
		{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getHangBan($mahangban){
		$hb = new HangBan();
		$sql = "select c.ID as IdGiaBan, c.Gia, c.MaKhu, a.* from tblDMHangBan a LEFT JOIN tblDMNhomHangBan b ON a.MaNhomHangBan = b.Ma LEFT JOIN tblGiaBanHang c ON a.MaHangBan = c.MaHangBan Where a.MaHangBan like '$mahangban'";

		try 
		{
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			
			$rs = $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
			if($rs !== false)
			{
				$hb->MaHangBan = $rs['MaHangBan'];
				$hb->TenHangBan = $rs['TenHangBan'];
				$hb->MaDVT = $rs['MaDVTCoBan'];
				$hb->MaNhomHB = $rs['MaNhomHangBan'];
				$hb->ThuTuHienThi = $rs['ThuTuTrinhBay'];
				$hb->ChoPhepSuaGia = $rs['IsSuaGia'];
				$hb->IdGiaBan = $rs['IdGiaBan'];
				$hb->GiaBan = $rs['Gia'];
				$hb->MaKhuApDung = $rs['MaKhu'];
				$hb->ThoiGianLam = $rs['ThoiGianLam'];
			}

			return $hb;
		}
		catch ( PDOException $error )
		{
			echo $error->getMessage();
		}
	}

	public function updateHangBan(HangBan $hb,$mahangbancu,$matrungtam) {
		$sql = "EXEC spWeb_Update_HangBan @MaTrungTam = ?, @MaHangBan = ?,@TenHangBan = ?, @MaDVT = ?,@MaNhomHB = ?,@ThuTuTrinhBay = ?,@IsSuaGia = ?,@IdGiaBan = ?,@GiaBan = ?,@MaKhu = ?,@MaHangBanCu = ?";
		try
		{
			$stmt = $this->conn->prepare( $sql);

			$pro_param = array($matrungtam,$hb->MaHangBan,$hb->TenHangBan,$hb->MaDVT,$hb->MaNhomHB,$hb->ThuTuHienThi,$hb->ChoPhepSuaGia,$hb->IdGiaBan,$hb->GiaBan, $hb->MaKhuApDung,$mahangbancu);
			$stmt->execute($pro_param);
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function deleteHangBan($mahangban) {
		$sql = "Delete from tblDMHangBan Where MaHangBan like '$mahangban'";
		try
		{
			$stmt = $this->conn->prepare( $sql);
			$stmt->execute();
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getDanhSachHangBan($hangban, $manhomhb, &$totalHB)
	{
		$hangban = "%".$hangban."%";
		if($manhomhb == "" || $manhomhb == "all")
			$manhomhb = "%%";

		$sql = "Select * from (Select ROW_NUMBER() OVER (ORDER BY a.MaNhomHangBan, a.ThuTuTrinhBay) as rowNum, a.MaHangBan, a.TenHangBan, a.DanhDauXoa, a.ThuTuTrinhBay, a.MaNhomHangBan, b.Ten as TenNhomHB, c.Gia, c.MaKhu, a.IsSuaGia FROM tblDMHangBan a LEFT JOIN tblDMNhomHangBan b ON a.MaNhomHangBan = b.Ma LEFT JOIN tblGiaBanHang c On a.MaHangBan = c.MaHangBan group by a.MaHangBan, a.TenHangBan, a.DanhDauXoa, a.ThuTuTrinhBay, a.MaNhomHangBan, b.Ten, c.Gia, c.MaKhu, a.IsSuaGia) sub Where MaHangBan not like '!%' AND DanhDauXoa = 0 AND ISNULL(MaNhomHangBan,'') like '$manhomhb' AND TenHangBan like N'$hangban'";
		//" AND rowNum > '$startRow' and rowNum <= '$endpoint'";
		
		try
		{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			$totalHB = count($rs);
			return $rs;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getLichSuBanHang($mahangban)
	{
		$sql = "Select * from tblLSPhieu_HangBan Where MaHangban like '$mahangban'";
	
		try
		{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			if($rs !== false)
				$totalHB = count($rs);
			else
				$totalHB = 0;
			return $totalHB;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getStock($tungay,$denngay,$makho, $manhomhb,$hangban,&$totalRecord) {
		if($manhomhb == "all") $manhomhb = "";

		$sql = "EXEC spWeb_TinhTonKhoThucTe @strTuNgay = ?,@strDenNgay = ?,@MaKho = ?,@NhomHang = ?, @MaTen = ?";
		$pro_param = array($tungay,$denngay,$makho,$manhomhb,$hangban);

		try{

			$stmt = $this->conn->prepare($sql);
			$stmt->execute($pro_param);
			unset($stmt);

			$sql = "Select * from tblBaoCaoTonKho_Temp";
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			if($rs !== false)
				$totalRecord = count($rs);
			else 
				$totalRecord = 0;
			return $rs;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}
	//
	//-------------NHAN VIÊN --------------------//
	//
	public function getNhomNhanVien()
	{
		$sql = "Select * from tblDMNhomNhanVien Order by Ten";
		
		try
		{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getUserByNhanVien($manhanvien)
	{
		$sql = "Select * from tblDSNguoiSD Where MaNhanVien like '$manhanvien'";
		
		try
		{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			if($rs !== false)
				return count($rs);
			else
				return 0;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getDanhSachNhanVien($nhanvien, $manhomnv, $ktv, $chinhanh, &$totalNV)
	{
		if($manhomnv == "all")
			$manhomnv = "";
		if($chinhanh == "all")
			$chinhanh = "";

		$sql = "EXEC spWeb_ListNhanVien @NhanVien = ?, @MaNhomNV = ?, @LaKTV = ?, @MaTrungTam = ?";
		$pro_param = array($nhanvien,$manhomnv,$ktv,$chinhanh);
		
		try
		{
			$stmt = $this->conn->prepare($sql);
			$stmt->execute($pro_param);
			$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

			if($rs !== false)
				$totalNV = count($rs);
			else 
				$totalNV = 0;
			return $rs;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getNhanVien($manhanvien){
		$nv = new NhanVien();
		$sql = "select b.Ten as TenNhomNV, a.* from tblDMNhanVien a LEFT JOIN tblDMNhomNhanVien b ON a.NhomNhanVien = b.Ma Where a.MaNV like '$manhanvien'";

		try 
		{
			$stmt = $this->conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->execute();
			
			$rs = $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
			if($rs !== false)
			{
				$nv->MaNV = $rs['MaNV'];
				$nv->TenNV = $rs['TenNV'];
				$nv->MaNhomNV = $rs['NhomNhanVien'];
				$nv->MaTrungTam = $rs['MaTrungTam'];
				$nv->GhiChuDichVu = $rs['GhiChuDichVu'];
				$nv->MaVanTay = $rs['MaVanTay'];
				$nv->LuongCoBan = $rs['LuongCoBan'];
				$nv->LuongPhuCap = $rs['LuongPhuCap'];
				$nv->SoNgayLamViec = $rs['SoNgayLamViec'];
			}

			return $nv;
		}
		catch ( PDOException $error )
		{
			echo $error->getMessage();
		}
	}

	public function updateNhanVien(NhanVien $nv,$manhanviencu,$matrungtam) {
		$sql = "EXEC spWeb_Update_NhanVien @MaTrungTam = ?, @MaNV = ?,@TenNV = ?, @MaNhomNV = ?,@GhiChuDichVu = ?,@MaVanTay = ?,@LuongCoBan = ?,@LuongPhuCap = ?,@SoNgayLamViec = ?,@MaNhanVienCu = ?";
		try
		{
			$stmt = $this->conn->prepare( $sql);

			$pro_param = array($matrungtam,$nv->MaNV,$nv->TenNV,$nv->MaNhomNV,$nv->GhiChuDichVu,$nv->MaVanTay,$nv->LuongCoBan,$nv->LuongPhuCap, $nv->SoNgayChuan,$manhanviencu);
			$stmt->execute($pro_param);
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function deleteNhanVien($manv) {
		$sql = "Delete from tblDMNhanVien Where MaNV like '$manv'";
		try
		{
			$stmt = $this->conn->prepare( $sql);
			$stmt->execute();
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}
	//
	//-------------------TOUR KY THUAT VIEN ---------------------//
	//
	public function getTongHopTour($matrungtam, $tungay, $denngay, $tugio, $dengio, $manv, &$tongSoTour) {

		if($matrungtam == "" || $matrungtam == "all") $matrungtam = "%%";

		$sql_1 = "select a.MaNV, b.TenNV, COUNT(*) as SoTour, SUM(TongTien) as TienHoaHong, Sum(TienHangBan) as DoanhSo from tblPhieuThuChi a, tblDMNhanVien b  
Where a.MaNV = b.MaNV and MaLichSuPhieu in (Select MaLichSuPhieu from tblLichSuPhieu where DaTinhTien = 1 and PhieuHuy = 0 
and ThoiGianDongPhieu is not null and Left(MaLichSuphieu,2) like '01') and LoaiPhieu like 'CHH' and substring( Convert(varchar,isnull(NgayLap,getdate()),126),0,17 ) BETWEEN '{$tungay}T{$tugio}' AND '{$denngay}T{$dengio}'";
		
		if($manv != "")
		{
			$sql_1 = $sql_1." AND a.MaNV like '$manv'";
		}
		
		$sql_1 = $sql_1." group by a.MaNV, b.TenNV";
	
		try
		{
			$rs_1 = $this->conn->query($sql_1)->fetchAll(PDO::FETCH_ASSOC);
			if($rs_1 !== false)
			{
				foreach($rs_1 as $r)
				{
					$tongSoTour = $tongSoTour + intval($r['SoTour']);
				}
			}
			else
			{
				$tongSoTour = 0;
			}
			return $rs_1;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}

	public function getChiTietTour($matrungtam, $kythuatvien, $tungay, $denngay, $tugio, $dengio) {

		if($matrungtam == "" || $matrungtam == "all") $matrungtam = "%%";

		if($kythuatvien == "" || $kythuatvien == "all") $kythuatvien = "%%";

	$sql_1="Select Convert(varchar,a.Ngay,111) as Ngay, Convert(varchar,a.GioThucHien,108) as GioThucHien,
Convert(varchar,a.GioKetThuc,108) as GioKetThuc, a.MaNV, a.TenNV, a.MaBanPhong, a.MaHangBan, a.TenHangBan, a.GiaHangBan, d.MaLichSuPhieu, 
a.SoLuongHangBan, a.ThoiGianLam, d.MaNVLap, b.TenNV as NVTinhTienTenNV, d.TongTien as TienHoaHong 
FROM tblPhieuThuChi d left join tblTheoDoiPhucVuSpa_ChiTiet a ON d.MaNV = a.MaNV and d.MaHangBan = a.MaHangBan and d.MaLichSuPhieu = a.MaPhieuDieuTour,
tblDMNhanVien b  
WHERE d.MaNVLap = b.MaNV and substring( Convert(varchar,isnull(a.GioThucHien,getdate()),126),0,17 ) BETWEEN '{$tungay}T{$tugio}' AND '{$denngay}T{$dengio}' and a.MaNV like '$kythuatvien' Group by a.Ngay, a.GioThucHien, a.GioKetThuc, a.MaNV, a.TenNV, a.MaBanPhong, a.MaHangBan, a.TenHangBan, 
a.GiaHangBan, d.MaLichSuPhieu, a.SoLuongHangBan, a.ThoiGianLam, d.MaNVLap, b.TenNV, d.TongTien Order by a.TenNV";
	
		try
		{
			$rs_1 = $this->conn->query($sql_1)->fetchAll(PDO::FETCH_ASSOC);
			return $rs_1;
		}
		catch ( PDOException $error ){
			echo $error->getMessage();
		}
	}
}

