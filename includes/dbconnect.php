<?php 
//SQL request for MySQL
$myIniFile = parse_ini_file("includes/idb.ini", TRUE);
// create the MySQL connection
$Myconfig  = new Myconfig($myIniFile['IDBMYSQL']['server'], $myIniFile['IDBMYSQL']['login'], $myIniFile['IDBMYSQL']['password'], $myIniFile['IDBMYSQL']['database'], $myIniFile['IDBMYSQL']['extension'], $myIniFile['IDBMYSQL']['mysqlformat']);
$Mydb      = new Mydb($Myconfig);
$Mydb->openConnection();

//Load the branch table
//several old branches can map to 1 current branch therefore old column must be unique
//$branchlist = $Mydb->load_values('branch');

$myIniFile = parse_ini_file("includes/idb.ini", TRUE);
$Ifxconfig = new Ifxconfig($myIniFile['IDBIFX']['odbc'], $myIniFile['IDBIFX']['login'], $myIniFile['IDBIFX']['password']);
$Ifxdb     = new Ifxdb($Ifxconfig);
?>