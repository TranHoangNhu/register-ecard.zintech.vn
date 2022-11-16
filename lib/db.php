<?php

ini_set('mssql.charset', 'UTF-8');

$conn = new PDO('odbc:Driver=FreeTDS; Server=14.241.251.3; Port=14335; Database=DEMO_ECARD; TDS_Version=8.0; Client Charset=UTF-8', 'sa', 'P@ssw0rd12345');

//$dbCon_2 = new PDO('odbc:Driver=FreeTDS; Server=14.161.35.228; Port=14331; Database=MASSAGE_TOKYOQ10; TDS_Version=8.0; Client Charset=UTF-8', 'sa', 'P@ssw0rd123');

//$dbCon_3 = new PDO('odbc:Driver=FreeTDS; Server=14.161.35.228; Port=14331; Database=MASSAGE_LANQUEPHUONG; TDS_Version=8.0; Client Charset=UTF-8', 'sa', 'P@ssw0rd123');

//$machinhanh2 = "04";
//$machinhanh3 = "05";
//$machinhanh4 = "06";
?>