ini_set('mssql.charset', 'UTF-8');

$conn = new PDO('odbc:Driver=FreeTDS; Server=14.241.251.3; Port=14335; Database=DEMO_ECARD; TDS_Version=8.0; Client Charset=UTF-8', 'sa', 'P@ssw0rd12345');

?>
