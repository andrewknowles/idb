<?php

include('includes/db_Ifxlib2.php');

$myIniFile = parse_ini_file("includes/idb.ini", TRUE);

$Ifxconfig2 = new Ifxconfig2($myIniFile['IDBIFX']['odbc'], $myIniFile['IDBIFX']['login'], $myIniFile['IDBIFX']['password']);
$Ifxdb2 = new Ifxdb2($Ifxconfig2);
$IfCLink = $Ifxdb2->openConnection();

?>