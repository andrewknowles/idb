<?php 

require('includes/table_lib.php');
include('includes/db_Mylib.php');

$myIniFile = parse_ini_file("includes/idb.ini", TRUE);

// create and open the MySQL connection
$Myconfig  = new Myconfig($myIniFile['IDBMYSQL']['server'], $myIniFile['IDBMYSQL']['login'], $myIniFile['IDBMYSQL']['password'], $myIniFile['IDBMYSQL']['database'], $myIniFile['IDBMYSQL']['extension'], $myIniFile['IDBMYSQL']['mysqlformat']);
$Mydb      = new Mydb($Myconfig);
$Mydb->openConnection();

$Mysql1 = $Mydb->query1('select * from idb_query order by qry_type, qry_order');

$tbl2 = new HTML_Table('', 'QueryList', 1, array('cellpadding'=>4, 'cellspacing'=>0) );
$tbl2->addCaption('<b>Query List</b>', 'cap', array('id'=> 'tblCap') );
$tbl2->addRow();
// arguments: cell content, class, type (default is 'data' for td, pass 'header' for th)
// can include associative array of optional additional attributes
$tbl2->addCell('Id');
$tbl2->addCell('Title');
$tbl2->addCell('Query');
$tbl2->addCell('Query2');
$tbl2->addCell('Query3');
$tbl2->addCell('Type');
$tbl2->addCell('Order');
$tbl2->addCell('Link');
$tbl2->addCell('Detail');

foreach($Mysql1 as $dataline) {
	
	$tbl2->addRow();
	$tbl2->addCell ('<a href="query_edit2.php?id='. $dataline['qry_id'] .'">'.$dataline['qry_id'].'</a>');
	$tbl2->addCell ($dataline['qry_title']);
	$tbl2->addCell ($dataline['qry_qry']);
	$tbl2->addCell ($dataline['qry_qry2']);
	$tbl2->addCell ($dataline['qry_qry3']);
	$tbl2->addCell ($dataline['qry_type']);
	$tbl2->addCell ($dataline['qry_order']);
	$tbl2->addCell ($dataline['qry_link']);
	$tbl2->addCell ($dataline['qry_detail']);
}

echo $tbl2->display();

?>
<button type="button" onClick="window.location='index.php';"> HOME </button>