<?php
session_start(); 
$SESSION['myIniFile'] = parse_ini_file("includes/idb.ini", TRUE);
?>