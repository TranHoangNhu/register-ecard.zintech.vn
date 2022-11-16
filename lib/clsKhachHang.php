<?php
class clsKhachHang {

	/* Properties */
    private $conn;

    /* Get database access */
    public function __construct(\PDO $dbCon) {

        $this->conn = $dbCon; 

	}

	public function getCustomersList()
	{
		$sql = "SELECT * FROM tblDMKHNCC WHERE LaKH = 1 ";
		try
		{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		catch( Exception $e )
		{
			echo $e->getMessage();	
		}
	}

	public function searchCustomer( $client_code, $client_name, $client_tel )
	{	
		$sql = "SELECT a.*, b.MaTheVip, b.IsGhiNoDV, b.IsGhiNoTT FROM tblDMKHNCC a left join tblKhachHang_TheVip b On a.MaDoiTuong = b.MaKhachHang WHERE 1 = 1";
		
		$filter = "";
		if($client_code != NULL && $client_code != "")
		{
			$filter = " AND (MaDoiTuong like '".$client_code."%'";
		}
		//
		//----------ten khach hang -------------//
		//
		if($client_name != NULL && $client_name != "")
		{
			if($filter != "")
			{
				$filter = $filter." OR TenDoiTuong like N'%".$client_name."%'";
			}
			else
			{
				$filter = " AND (TenDoiTuong like N'%".$client_name."%'";
			}
		}
		//
		//----------dien thoai ----------------//
		//
		if($client_tel != NULL && $client_tel != "")
		{
			if($filter != "")
			{
				$filter = $filter." OR DienThoai like '".$client_tel."%'";
			}
			else
			{
				$filter = " AND (DienThoai like '".$client_tel."%'";
			}
		}

		if($filter != "")
		{
			$sql = $sql.$filter.")";
		}
		
		try
		{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		catch( Exception $e )
		{
			echo $e->getMessage();
		}
	}


	public function insertNewClient( $client_name, $client_address, $client_tel)
	{	
		$stt = 0;
		$sql = "SELECT max(substring(MaDoiTuong,11,5)) FROM [tblDMKHNCC]";
		$r = $this->conn->query($sql)->fetch();
		//$r = $rs->fetch();//sqlsrv_fetch_array($rs);
		$stt = ++$r[0];

		$date = date("yy-m");//2020-11
		$date = substr($date,0,4) . substr($date,5,2);
		$ma_doi_tuong =  $_SESSION['MaTrungTam'] . "1" . $date . "-" . $stt;

		$ten_doi_tuong = htmlentities(trim(strip_tags($client_name)),ENT_QUOTES,'utf-8');
		$dia_chi = htmlentities(trim(strip_tags($client_address)),ENT_QUOTES,'utf-8');
		$dien_thoai = htmlentities(trim(strip_tags($client_tel)),ENT_QUOTES,'utf-8');

		$sql_1 = "INSERT INTO [tblDMKHNCC] ( MaDoiTuong, TenDoiTuong, DiaChi, DienThoai	) VALUES( '$ma_doi_tuong', N'$ten_doi_tuong', N'$dia_chi', '$dien_thoai' )  ";
		try
		{
			$rs_1 = $this->conn->query($sql_1);//->fetchAll(PDO::FETCH_ASSOC);//sqlsrv_query($this->conn, $sql_1);

			if( !$rs_1 ){
				$_SESSION['insert_error'] = "Insert failed...";
			}
			else
			{
				$_SESSION['insert_success'] = "Inserted successfully!";
			}
			
		}
		catch( Exception $e )
		{
			echo $e->getMessage();
		}
	}

	public function getClientInfo( $ma_doi_tuong )
	{
		$sql = "with tkt as (select ROW_NUMBER() OVER(PARTITION BY a1.MaTheVip 
                                 ORDER BY ConLai DESC) AS tt, ConLai, TenHangBan, a1.MaTheVip, LoaiTheVip, NgayKetThuc, IsGhiNoDV, IsGhiNoTT, MaKhachHang from tblKhachHang_TheVip a1, tblTheVip_GhiNoDV a2 
                                 where a1.MaTheVip = a2.MaTheVIP 
union Select ROW_NUMBER() OVER(PARTITION BY b1.MaTheVip 
                                 ORDER BY ConLai DESC) AS tt, ConLai,'' as TenHangBan, b1.MaTheVip, LoaiTheVip, NgayKetThuc, IsGhiNoDV, IsGhiNoTT, MaKhachHang from tblKhachHang_TheVip b1, tblTheVip_GhiNoTT b2 
                                 where b1.MaTheVip = b2. MaTheVIP) 
SELECT MaDoiTuong, TenDoiTuong, DienThoai, DiaChi, ISNULL(MaTheVip,'') as MaTheVip, ISNULL(LoaiTheVip,'') as LoaiTheVip, NgayKetThuc, ISNULL(IsGhiNoDV,0) as IsGhiNoDV, ISNULL(IsGhiNoTT,0) as IsGhiNoTT, ISNULL(ConLai,0) as ConLai  
FROM [tblDMKHNCC] a 
LEFT JOIN (Select * from tkt where tt = 1) b ON a.MaDoiTuong = b.MaKhachHang 
Where  LaKH = 1 AND MaDoiTuong='$ma_doi_tuong'";
		try
		{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		catch( Exception $e )
		{
			echo $e->getMessage();
		}
	}

	public function getClientInfo_LSPhieu( $malichsuphieu )
	{
		$sql = "with tkt as (select ROW_NUMBER() OVER(PARTITION BY a1.MaTheVip 
                                 ORDER BY ConLai DESC) AS tt, ConLai, MaHangBan, a1.MaTheVip, MaKhachHang from tblKhachHang_TheVip a1, tblTheVip_GhiNoDV a2 
                                 where a1.MaTheVip = a2.MaTheVIP 
union Select ROW_NUMBER() OVER(PARTITION BY b1.MaTheVip 
                                 ORDER BY ConLai DESC) AS tt, ConLai,'' as MaHangBan, b1.MaTheVip, MaKhachHang from tblKhachHang_TheVip b1, tblTheVip_GhiNoTT b2 
                                 where b1.MaTheVip = b2. MaTheVIP) 
SELECT a.MaKhachHang, a.TenKhachHang, b.DienThoai, b.DiaChi, b.MaTheVip, b.LoaiTheVip, b.NgayApDung, b.NgayKetThuc, 
b.IsGhiNoDV, b.IsGhiNoTT, ISNULL(tkt.ConLai,0) as ConLai FROM tblLichSuPhieu a 
left join ( Select e.MaDoiTuong, e.DienThoai, e.DiaChi, f.MaTheVip, f.NgayApDung, f.NgayKetThuc, f.NgungThe, f.LoaiTheVip, 
f.IsGhiNoDV, f.IsGhiNoTT from tblDMKHNCC e 
left join tblKhachHang_TheVip f On e.MaDoiTuong = f.MaKhachHang) b On a.MaKhachHang = b.MaDoiTuong and a.MaTheVIP = b.MaTheVip 
left join tkt On a.MaTheVIP = tkt.MaTheVip and a.MaKhachHang = tkt.MaKhachHang and tkt.tt = 1
Where a.MaKhachHang is not null and a.MaKhachHang <> '' and b.MaTheVip is not null and b.MaTheVip <> '' and a.MaLichSuPhieu like '$malichsuphieu' 
Group by a.MaKhachHang, a.TenKhachHang, b.DienThoai, b.DiaChi, b.MaTheVip, b.LoaiTheVip, b.NgayApDung, 
b.NgayKetThuc, b.IsGhiNoDV, b.IsGhiNoTT, tkt.ConLai ";
		//echo $sql;
		try
		{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		catch( Exception $e )
		{
			echo $e->getMessage();
		}
	}

	public function updateClient( $client_id, $client_name, $client_address, $client_tel)
	{	
		$ma_doi_tuong = htmlentities(trim(strip_tags($client_id)),ENT_QUOTES,'utf-8');
		$ten_doi_tuong = htmlentities(trim(strip_tags($client_name)),ENT_QUOTES,'utf-8');
		$dia_chi = htmlentities(trim(strip_tags($client_address)),ENT_QUOTES,'utf-8');
		$dien_thoai = htmlentities(trim(strip_tags($client_tel)),ENT_QUOTES,'utf-8');

		$sql_1 = "UPDATE [tblDMKHNCC] SET  MaDoiTuong = '$ma_doi_tuong', TenDoiTuong = N'$ten_doi_tuong', DiaChi = '$dia_chi', DienThoai = '$dien_thoai'	WHERE [MaDoiTuong] = '$ma_doi_tuong' ";
		try
		{
			$rs_1 = $this->conn->query($sql_1);//->fetchAll(PDO::FETCH_ASSOC);//sqlsrv_query($this->conn, $sql_1);

			if( !$rs_1 ){
				$_SESSION['update_error'] = "Update failed...";
			}
			else
			{
				$_SESSION['update_success'] = "Update successfully!";
			}
			
		}
		catch( Exception $e )
		{
			echo $e->getMessage();
		}
	}

	public function deleteClient( $client_id )
	{	
		$sql_1 = "DELETE FROM [tblDMKHNCC] WHERE [MaDoiTuong] = '$client_id' ";
		try
		{
			$rs_1 = $this->conn->query($sql_1);//->fetchAll(PDO::FETCH_ASSOC);//sqlsrv_query($this->conn, $sql_1);

			if( !$rs_1 ){
				$_SESSION['delete_error'] = "Delete failed...";
			}
			else
			{
				$_SESSION['delete_success'] = "Delete successfully!";
			}
			
		}
		catch( Exception $e )
		{
			echo $e->getMessage();
		}
	}

	public function getClientList()
	{
		$sql="select a.MaDoiTuong, a.TenDoiTuong, a.DienThoai, a.DiaChi, a.MaNhomKH, a.GhiChu from tblDMKHNCC a left join tblDMNhomKH b on a.MaNhomKH = b.Ma Order by a.MaDoiTuong";
		try
		{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);//sqlsrv_query($this->conn, $sql, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));

			return $rs;
			
		}
		catch( Exception $e )
		{
			echo $e->getMessage();
		}
	}

	public function getBillHistory( $client_id )
	{
		$sql = "SELECT  MaLichSuPhieu, substring( Convert(varchar,GioVao,105),0,11 ) as GioVao, TienThucTra FROM [tblLichSuPhieu] WHERE MaKhachHang = '$client_id' ORDER BY substring( Convert(varchar,GioVao,105),0,11 ) DESC";
		try
		{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);//sqlsrv_query($this->conn, $sql, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
			return $rs;
			//sqlsrv_free_stmt( $rs);
		}
		catch( Exception $e )
		{
			echo $e->getMessage();
		}
	}

	public function getClientGroup()
	{
		$sql="select Ma, Ten from tblDMNhomKH";
		try
		{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		catch( Exception $e )
		{
			echo $e->getMessage();
		}
	}

	public function getVipGroup()
	{
		$sql="select MaLoaiThe, TenLoaiThe from tblDMLoaiTheVip";
		try
		{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		catch( Exception $e )
		{
			echo $e->getMessage();
		}
	}

	public function getAllClients()
	{

		$sql="with t1 as ( select 
				b.MaDoiTuong, TenDoiTuong, a.MaLichSuPhieu, a.TienThucTra, 
				a.GioVao, b.MaNhomKH, b.DienThoai, b.DiaChi, b.GhiChu, b.MaNhanVien, c.Ten as TenNhomKH, d.MaTheVip, d.IsGhiNoDV, d.IsGhiNoTT, d.TenLoaiThe 
				from tblDMKHNCC b left join tblLichSuPhieu a on a.MaKhachHang = b.MaDoiTuong		
				left join tblDMNhomKH c on b.MaNhomKH = c.Ma 
				left join (select e.MaTheVip, e.MaKhachHang, e.IsGhiNoDV, e.IsGhiNoTT, f.TenLoaiThe from tblKhachHang_TheVip e, tblDMLoaiTheVip f where e.LoaiTheVip = f.MaLoaiThe) d On b.MaDoiTuong = d.MaKhachHang 
				)
				SELECT * from t1";
		try
		{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);//sqlsrv_query($this->conn, $sql, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
			return $rs;
			//sqlsrv_free_stmt( $rs);
		}
		catch( Exception $e )
		{
			echo $e->getMessage();
		}
	}

	public function getTheGhiNoDV( $vipcode )
	{
		$sql = "SELECT  MaTheVip, TenHangBan, TongSL as TongGiaTri, DaSuDung, ConLai FROM tblTheVip_GhiNoDV Where MaTheVip like '$vipcode'";
		try
		{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		catch( Exception $e )
		{
			echo $e->getMessage();
		}
	}

	public function getTheGhiNoTT( $vipcode )
	{
		$sql = "SELECT MaTheVip, '' as TenHangBan, TongGiaTri, DaSuDung, ConLai FROM tblTheVip_GhiNoTT Where MaTheVip like '$vipcode'";
		try
		{
			$rs = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		catch( Exception $e )
		{
			echo $e->getMessage();
		}
	}
}