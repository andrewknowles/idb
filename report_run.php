<?php
include('includes/Ifconnect.php');
include('includes/Myconnect.php');
include('includes/table_lib.php');

$selectedrpt    = $_POST['idb_part_report'];
$selectedbranch = $_POST['branches'];

$arrlength = count($selectedrpt);
echo $arrlength . '</BR>';
var_dump($selectedrpt) . '</BR>';
for ($x = 0; $x <= $arrlength; $x++)
  {
  	echo 'report no'.$x;
    $val = $selectedrpt[$x];
    echo $val . '</BR>';
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
    $collist        = array();
    //create array with the column headers
    for ($i = 1; $i < ($numcols + 1); $i++)
      {
        array_push($collist, ucfirst(odbc_field_name($Ifxsql1, $i)));
      }
    
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
    for ($ii = 0; $ii < ($numcols); $ii++)
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
        
      }
    
    $tbl2->addRow();
    $tbl2->addCell('Row Count');
    $tbl2->addCell($rowcount);
    
  }
echo $tbl2->display();
$Mydb2->closeConnection();
$Ifxdb2->closeConnection();

?>
