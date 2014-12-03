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
    <style type="text/css" media="all">@import "css/idbmaster.css";</style> 

<script type="text/javascript">
function ExportToExcel(mytblId){
       var htmltable= document.getElementById('TableData');
       var html = htmltable.outerHTML;
       window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
    }
</script>

</head>
<body>
<div id="page-container">

    <div id="main-nav">
   		 <dl>
			<dt id="about"><a href="#">About</a></dt>
			<dt id="services"><a href="#">Services</a></dt>
			<dt id="portfolio"><a href="#">Portfolio</a></dt>
			<dt id="contact"><a href="#">Contact Us</a></dt>
		</dl>
	</div>

    <div id="header">
		<!--  <h1><img src="images/almonddway1.png" 
		width="600" height="64" alt="Almondway Consulting" border="0" /></h1>-->
	</div>

	<div id="sidebar-a">
	</BR></BR></BR>

	<button type="button" style="width:75px; height:75px" onClick="window.location='index.php';"> HOME </button></BR></BR>
	<button type="button" style="width:75px; height:75px" onClick="window.location='quick_status.php';"> RETURN </button></BR></BR>
    <button type="button" style="width:75px; height:75px" onclick="ExportToExcel('TableData');"> EXPORT </button></BR>		
         </div>

<?php
include('includes/Ifconnect.php');
include('includes/Myconnect.php');
include('includes/table_lib.php');

//$selectedrports    = $_POST['idb_part_report'];
$selectedbranch = $_POST['branches'];
$reports_to_run = count($_POST['idb_part_report']);
//echo 'how many reports'.$reports_to_run . '</BR>';
//var_dump($_POST['idb_part_report']) . '</BR>';

for ($reports_select = 0; $reports_select <$reports_to_run; $reports_select++)
  {
//  	echo 'report no'.$reports_select;
    $val = $_POST['idb_part_report'][$reports_select];
    echo 'report no'.$val . '</BR>';
    $Mysql1 = $Mydb2->idbquerybyno($val);
    foreach ($Mysql1 as $dataline1)
      {
        $qry1  = $dataline1['qry_qry'] . $dataline1['qry_qry2'];
        $title = $dataline1['qry_title'];
      }
    $selectedbranch = str_replace("'", "", $selectedbranch);
    $Ifxsql1        = $Ifxdb2->query1($qry1, $selectedbranch);
    //number of columns returned by query
    $numcols        = odbc_num_fields($Ifxsql1);
//    echo 'how many cols ? '.$numcols;
    $collist        = array();
    
    //create array with the column headers
    for ($i = 1; $i <= $numcols; $i++)
      {
        array_push($collist, ucfirst(odbc_field_name($Ifxsql1, $i)));
      }
//      var_dump($collist);
    //generate table with results of Informix query
    $tbl2 = new HTML_Table('TableData', 'demoTbl2', 1, array(
        'cellpadding' => 4,
        'cellspacing' => 0
    ));
    $tbl2->addCaption('<b>' . $title . '</b>', 'cap', array(
        'id' => 'tblCap'
    ));
    
    $tbl2->addRow();
    //loop through number of columns to create headers
    for ($ii = 0; $ii <$numcols; $ii++)
      {
        $tbl2->addCell($collist[$ii], '', 'header');
      }
    
    $rowcount = 0;
    
    while (odbc_fetch_row($Ifxsql1))
      {
        //loop through number of columns
        $tbl2->addRow();
        for ($x = 1; $x < ($numcols + 1); $x++)
          {
            $tbl2->addCell(odbc_result($Ifxsql1, $x));
          }
       $rowcount++; 
      }
    
    $tbl2->addRow();
    $tbl2->addCell('Row Count');
    $tbl2->addCell($rowcount);
    echo $tbl2->display();
//    echo '$x is now' .$reports_select;
  }


$Mydb2->closeConnection();
$Ifxdb2->closeConnection();

?>
<!--  <button id="btnExport" onclick="ExportToExcel('TableData');"> EXPORT </button>
<button type="button" onClick="window.location='quick_status.php';"> RETURN </button>
<button type="button" style="background:url(images/gohome.png) no-repeat; width:75; height:75;" onClick="window.location='index.php';"> HOME </button>-->
</div>
</div>
</body>
</html>