<?php
class clsOrder {

	/* Properties */
    private $conn;

    /* Get database access */
    public function __construct(\PDO $dbCon) {

        $this->conn = $dbCon;

	}

	function order_chitiet( $orderID )
	{
		$sql = "SELECT  * FROM tblOrderChiTiet where OrderID='$orderID'";
		try
		{
			$rs = sqlsrv_query($this->conn, $sql);
			return $rs;
		}
		catch( Exception $e )
		{
			echo $e->getMessage();
		}
	}

	function order_in_process(){
		$sql = "SELECT  * FROM [tblOrder] WHERE TrangThai = 0  ORDER BY OrderID ASC";
		try
		{
			$rs = sqlsrv_query($this->conn, $sql, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
			return $rs;
			sqlsrv_free_stmt( $rs);
		}
		catch( Exception $e )
		{
			echo $e->getMessage();
		}
	} 

	function list_items_in_order( $orderID){
		$sql = "SELECT  * FROM [tblOrderChiTiet] WHERE OrderID = '$orderID' ORDER BY OrderID DESC";
		try
		{
			$rs = sqlsrv_query($this->conn, $sql, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
			return $rs;
			sqlsrv_free_stmt( $rs);
		}
		catch( Exception $e )
		{
			echo $e->getMessage();
		}
	} 
}