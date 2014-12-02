<?php

include('includes/db_Mylib2.php');

$myIniFile = parse_ini_file("includes/idb.ini", TRUE);
$Myconfig2 = new Myconfig2($myIniFile['IDBMYSQL']['server'], $myIniFile['IDBMYSQL']['login'], $myIniFile['IDBMYSQL']['password'], $myIniFile['IDBMYSQL']['database']);
$Mydb2 = new Mydb2($Myconfig2);
$MyCLink = $Mydb2->openConnection();
?>