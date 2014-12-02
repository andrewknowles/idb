<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
<title>Dashboard - Home Page</title>
<meta http-equiv="Content-Language" content="en-us" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="MSSmartTagsPreventParsing" content="true" />
<meta name="description" content="Description" />
<meta name="keywords" content="Keywords" />
<meta name="author" content="Fred" />
<style type="text/css" media="all">
@import "css/idbmaster.css";
</style>
</head>
<body>
      <?php
         /*Created by Almondway Consulting
          *Top level parts view to highlight issues that need to be resolved
         */
      function array_push_assoc($array, $key, $value){
      	$array[$key] = $value;
      	return $array;
      }
         session_start();
         include('includes/Myconnect.php');
         include('includes/Ifconnect.php');
         require('includes/table_lib.php');
         include('includes/validation.php');
         set_time_limit(0);
//strip out quotes - these cause a problem in the prepared query parameters
         $_SESSION['branch'] = addslashes(str_replace("'","",$_GET['q']));

         validatebranch($_SESSION['branch']);
         
         if ($_SESSION['error_flag'] ==1)
         {
         	echo '<h2>Critical IDB Error No. 3 Program Halted</h2>';
         	unset($_SESSION['error_flag']);
         	exit;
         }

//this array holds the title and result of all queries in the MySQL query idb_query where idb_query.qry_type = 0 (all these queries return only a count(*) value)
         $result_array = array();
//this array holds the title and the query number for the detail report idb_query.qry_detail
         $result_array1 = array();
//select on the idb_query table to select all type 0 queries (Quick Status queries)
         $Mysql1 = $Mydb2->idbquerybytype(0);
         foreach($Mysql1 as $dataline1) {
//if a single branch is selected
         	if ($_SESSION['branch'] <> 'allbr')
         	{
         		$qry1 = $dataline1['qry_qry'].' '.$dataline1['qry_qry2'];
         		$Ifxsql1 = $Ifxdb2->query1($qry1, $_SESSION['branch']);
         		
         		if ($_SESSION['error_flag'] ==1)
         		{
         			echo '<h2>Critical IDB Error No. 3 Program Halted</h2>';
         			$_SESSION['error_flag']=0;
         			exit;
         		}
         		while(odbc_fetch_row($Ifxsql1)){
//fill the title and count array
         			$result_array = array_push_assoc($result_array, $dataline1['qry_title'], odbc_result($Ifxsql1, 1));
//fill the title and link to detail query
         			$result_array1 = array_push_assoc($result_array1, $dataline1['qry_title'], $dataline1['qry_detail']);
         		}
         	} 
         	else 
         	{
//all branches selected
         		$qry1 = $dataline1['qry_qry'].' '.$dataline1['qry_qry3'];
         		$Ifxsql1 = $Ifxdb2->query1($qry1, $_SESSION['cpy']);
         		if ($_SESSION['error_flag'] ==1)
         		{
         			echo '<h2>Critical IDB Error No. 3 Program Halted</h2>';
         			$_SESSION['error_flag']=0;
         			exit;
         		}       		 
         		while(odbc_fetch_row($Ifxsql1)){
//fill the title and count array
         			$result_array = array_push_assoc($result_array, $dataline1['qry_title'], odbc_result($Ifxsql1, 1));
//fill the title and link to detail query
         			$result_array1 = array_push_assoc($result_array1, $dataline1['qry_title'], $dataline1['qry_detail']);
         	}
         }
         }

         //generate table with results of Informix query
         if ($_SESSION['branch'] == 'allbr')
         {
         	echo '<h2>Selected branch is - All Branches</h2>';
         } else {
         echo '<h2>Selected branch is - '.$_SESSION['branches'][str_replace("'", "", $_SESSION['branch'])].'</h2>';
         }
         echo '<h2>Quick Status Indicators</h2>';
         $tbl2 = new HTML_Table('', 'demoTbl2', 1, array('cellpadding'=>1, 'cellspacing'=>0) );
         $tbl2->addCaption('', 'cap', array('id'=> 'tblCap') );
         $tbl2->addRow();
         // arguments: cell content, class, type (default is 'data' for td, pass 'header' for th)
         // can include associative array of optional additional attributes
         $tbl2->addCell('Issue','','header');
         $tbl2->addCell('Result','','header');
         
           foreach($result_array as $x=>$x_value) {
//generate the link string
//eg. '<a href="quick_status_detail.php?qry=5">Parts Lines On Wait</a>'

           	$pagelink = '<a href="quick_status_detail.php?qry='.$result_array1[$x].'">'.$x.'</a>';
				$tbl2->addRow();
				$tbl2->addCell($pagelink);
				$tbl2->addCell($x_value);
				}
						
?>
      <div id="page-container">
		<div id="menutable">
			<BR> <BR>
            <?php 
               echo $tbl2->display();
               ?>
         </div>
	</div>
</body>
</html>