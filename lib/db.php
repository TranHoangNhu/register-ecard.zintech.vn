<?php

ini_set('mssql.charset', 'UTF-8');
	$conn = new PDO("odbc:Driver={SQL Server}; Server=LAPTOP-8E0SI58J\SQLEXPRESS; Database=DEMO_ECARD; Client Charset=UTF-8, Uid=sa;Pwd=123456;");

	$conn->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
	$conn->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$conn->setAttribute( PDO::ODBC_ATTR_ASSUME_UTF8, true );
