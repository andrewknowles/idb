<?php
include('includes/db_Mylib.php');

$myIniFile = parse_ini_file("includes/idb.ini", TRUE);

// create and open the MySQL connection
$Myconfig  = new Myconfig($myIniFile['IDBMYSQL']['server'], $myIniFile['IDBMYSQL']['login'], $myIniFile['IDBMYSQL']['password'], $myIniFile['IDBMYSQL']['database'], $myIniFile['IDBMYSQL']['extension'], $myIniFile['IDBMYSQL']['mysqlformat']);
$Mydb      = new Mydb($Myconfig);
$Mydb->openConnection();

//Retrieve required queries
$Mysql = $Mydb->idbquery(1);
foreach($Mysql as $titleline) {
	$qry1 = $titleline['qry_qry']."('XXX')";
	echo $qry1;
}


?>