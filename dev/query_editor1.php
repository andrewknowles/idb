<?php

include('includes/db_Mylib.php');
include('includes/parse.php');
$myIniFile = parse_ini_file("includes/idb.ini", TRUE);

// create and open the MySQL connection
$Myconfig  = new Myconfig($myIniFile['IDBMYSQL']['server'], $myIniFile['IDBMYSQL']['login'], $myIniFile['IDBMYSQL']['password'], $myIniFile['IDBMYSQL']['database'], $myIniFile['IDBMYSQL']['extension'], $myIniFile['IDBMYSQL']['mysqlformat']);
$Mydb      = new Mydb($Myconfig);
$Mydb->openConnection();

$selectedquery =$_GET['q'];
$selectedquery = str_replace("'", "", $selectedquery);

$Mysql1 = $Mydb->query('select * from idb_query where qry_id = '.$selectedquery);
//$Mysql1 = $Mydb->query('select * from idb_query where qry_id = 2');
foreach($Mysql1 as $dataline1) {
	$id = $dataline1['qry_id'];
	$title = $dataline1['qry_title'];
	$qry =  $dataline1['qry_qry'];
	$link =  $dataline1['qry_link'];
}

if(isset($_POST['update']))
{
	echo $POST['title'];
	exit;
	$Mysql1 = $Mydb->query("update idb_query set qry_title = ".$_POST['title'].", qry_qry = ".$_POST['query'].", qry_link = ".$_POST['link']); 			
}
else
{
	?>
<html>
<form method="post" action="<?php $_PHP_SELF ?>">
<table width="400" border="0" cellspacing="1" cellpadding="2">
<tr>
<td width="100">Title</td>
<td><input name="title" type="text" id="title" value=" <?php echo  $title; ?>" ></input></td>
</tr>
<tr>
<td width="100">Query</td>
<td><textarea rows="4" cols="150" name="query" id="query"><?php echo  $qry; ?></textarea></td>
</tr>
<tr>
<td width="100">Link </td>
<td><input name="link" type="text" id="link" value=" <?php echo  $link; ?>" ></input> </td>
</tr>
<tr>
<td width="100"> </td>
<td>
<input name="update" type="submit" id="update" value="Update">
</td>
</tr>
</table>
</form>
</html>
<?php
}
?>