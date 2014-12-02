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
/*Created by Almondway Consulting
 *Detail of issues
 */
session_start();
include('includes/Myconnect.php');
include('includes/Ifconnect.php');
require('includes/table_lib.php');
include('includes/validation.php');
set_time_limit(0);

//Retrieve required query by query number
$qryno = addslashes($_GET['qry']);
//validate $qryno - must be numeric and within value limits fixed in validatequeryno()
validatequeryno($qryno);

if ($_SESSION['branch'] <> 'allbr')
  {
    $Mysql1 = $Mydb2->idbquerybyno($qryno);
    foreach ($Mysql1 as $dataline1)
      {
        $qry1  = $dataline1['qry_qry'] . ' ' . $dataline1['qry_qry2'];
        $title = $dataline1['qry_title'];
      }
    $Ifxsql1 = $Ifxdb2->query1($qry1, $_SESSION['branch']);
    //number of columns returned by query
    $numcols = odbc_num_fields($Ifxsql1);
    $collist = array();
    //create array with the column headers
    for ($i = 1; $i < ($numcols + 1); $i++)
      {
        array_push($collist, ucfirst(odbc_field_name($Ifxsql1, $i)));
      }
    
    if ($_SESSION['error_flag'] == 1)
      {
        echo '<h2>Critical IDB Error No. 3 Program Halted</h2>';
        $_SESSION['error_flag'] = 0;
        exit;
      }
  }
else
  {
    //  	$cpy = "'".$_SESSION['cpy']."'";
    $Mysql1 = $Mydb2->idbquerybyno($qryno);
    foreach ($Mysql1 as $dataline1)
      {
        $qry1 = $dataline1['qry_qry'] . ' ' . $dataline1['qry_qry3'];
      }
    $Ifxsql1 = $Ifxdb2->query1($qry1, $_SESSION['cpy']);
    
    //number of columns returned by query
    $numcols = odbc_num_fields($Ifxsql1);
    $collist = array();
    //create array with the column headers
    for ($i = 1; $i < ($numcols + 1); $i++)
      {
        array_push($collist, ucfirst(odbc_field_name($Ifxsql1, $i)));
      }
    
    if ($_SESSION['error_flag'] == 1)
      {
        echo '<h2>Critical IDB Error No. 3 Program Halted</h2>';
        $_SESSION['error_flag'] = 0;
        exit;
      }
  }

//generate table with results of Informix query
$tbl2 = new HTML_Table('TableData', 'demoTbl2', 1, array(
    'cellpadding' => 4,
    'cellspacing' => 0
));
$tbl2->addCaption('<h1><b>' . $title . '</b></h1>', 'cap', array(
    'id' => 'tblCap'
));
$tbl2->addRow();
//loop through number of columns to create headers
for ($ii = 0; $ii < ($numcols); $ii++)
  {
    $tbl2->addCell($collist[$ii], '', 'header');
  }

//loop thorugh odbc result
while (odbc_fetch_row($Ifxsql1))
  {
    //loop through number of columns
    $tbl2->addRow();
    for ($x = 1; $x < ($numcols + 1); $x++)
      {
        $tbl2->addCell(odbc_result($Ifxsql1, $x));
      }
    
  }
?>

<div id="menutable">
<BR><BR>
<?php
echo $tbl2->display();

?>
<!--  <button id="btnExport" onclick="ExportToExcel('TableData');"> EXPORT </button>
<button type="button" onClick="window.location='quick_status.php';"> RETURN </button>
<button type="button" style="background:url(images/gohome.png) no-repeat; width:75; height:75;" onClick="window.location='index.php';"> HOME </button>-->
</div>
</div>
</body>
</html>