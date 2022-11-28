<?php
function customizeArrayKTV( array $ktvlist ) 
{	
	//var_dump($clients);die;

	foreach( $ktvlist as &$ktv )
	{
	    $ktv['MaPhieuDieuTour'] = array($ktv['MaPhieuDieuTour']);
	    $ktv['MaBanPhong'] = array($ktv['MaBanPhong']);
	    $ktv['TenHangBan'] = array($ktv['TenHangBan']);
	    $ktv['GioThucHien'] = array($ktv['GioThucHien']);
	}
	unset($ktv);

	foreach( $ktvlist as &$ktv )
	{
	    $ktv = (object) $ktv;
	}

	unset($ktv);

	$result = array();
	//$i = 0;
	foreach($ktvlist as $ktv)
	{
	    if( !isset($result[$ktv->MaNV]) )
	    {
	        $result[$ktv->MaNV] = $ktv;
	    }
	    else
	    { 	//var_dump($client->GioVao[0]);die; 
	        $result[$ktv->MaNV]->MaPhieuDieuTour[] = implode("",$ktv->MaPhieuDieuTour);
	        $result[$ktv->MaNV]->MaBanPhong[] = implode("",$ktv->MaBanPhong);
	        $result[$ktv->MaNV]->TenHangBan[] = implode("",$ktv->TenHangBan);
	        $result[$ktv->MaNV]->GioThucHien[] =  $ktv->GioThucHien[0];
	    }
	}

	return $result;

}

function customizeArrayKH( array $clientlist ) 
{	
	foreach( $clientlist as &$client )
	{
	    $client['MaLichSuPhieu'] = array($client['MaLichSuPhieu']);
	    $client['TienThucTra'] = array($client['TienThucTra']);
	    $client['GioVao'] = array($client['GioVao']);
	}
	unset($client);

	foreach( $clientlist as &$client )
	{
	    $client = (object) $client;
	}

	unset($client);

	$result = array();
	//$i = 0;
	foreach($clientlist as $client)
	{
	    if( !isset($result[$client->MaDoiTuong]) )
	    {
	        $result[$client->MaDoiTuong] = $client;
	    }
	    else
	    { 	
	        $result[$client->MaDoiTuong]->MaLichSuPhieu[] = implode("",$client->MaLichSuPhieu);
	        $result[$client->MaDoiTuong]->TienThucTra[] = implode("",$client->TienThucTra);
	        $result[$client->MaDoiTuong]->GioVao[] =  $client->GioVao[0];
	    }
	}

	//var_dump($result);die;

	return $result;

}

function customizeArrayKH2( array $clientlist ) 
{	
	foreach( $clientlist as &$client )
	{
	    $client = (object) $client;
	}

	unset($client);

	$result = array();
	//$i = 0;
	foreach($clientlist as $client)
	{
	    if( !isset($result[$client->MaKH]) )
	    {
	        $result[$client->MaKH] = $client;
	    }
	}

	//var_dump($result);die;

	return $result;

}

function pr($array = null) { echo "<pre>" . print_r($array, true) . "</pre>"; } 